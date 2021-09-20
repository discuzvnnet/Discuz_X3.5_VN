## Hiện tại, người dùng thông thường không nên tải mã chi nhánh này xuống
## Người dùng không có khả năng kỹ thuật đặc biệt khuyến cáo không sử dụng 3.5 trong môi trường không thử nghiệm! ! !
#### Sử dụng mù quáng và cập nhật Discuz trong môi trường sản xuất! X3.5 (phiên bản đang được phát triển) có thể gây ra
#### - Lỗi cấu trúc cơ sở dữ liệu gây mất dữ liệu
#### - Một số lỗi chức năng khiến trang web không chạy được
#### - Lỗ hổng bảo mật khiến máy chủ bị xâm nhập
#### Vui lòng xác nhận rằng khả năng kỹ thuật của bạn đủ để điều khiển 3.5 trước khi sử dụng nó!

## Cấu trúc cơ sở dữ liệu của 3.5 sẽ được cập nhật bất cứ lúc nào.



### **3.5 ghi chú phát hành** 

So với phiên bản 3.4, những thay đổi sau đã được thực hiện:

#### 1. Các thay đổi liên quan đến cơ sở dữ liệu

Phiên bản 3.5 hỗ trợ hai công cụ cơ sở dữ liệu InnoDB và MyISAM. Dưới cả hai công cụ, cơ sở dữ liệu không còn hỗ trợ mã hóa utf8 mà thay vào đó hỗ trợ mã hóa utf8mb4.

##### 1.1 Các thay đổi đối với cấu trúc bảng cơ sở dữ liệu:

Tham khảo [scheme-change-without-data-loss.sql](https://gitee.com/oldhuhu/DiscuzX34235/blob/master/scheme/scheme-change-without-data-loss.sql)
  * Đã sửa đổi tất cả các địa chỉ IP và thay đổi thành loại varchar (45);
  * Ở tất cả những nơi ghi địa chỉ IP, bản ghi số cổng được thêm vào;
  * Trong bảng pre_common_banned, hai trường VARBINARY (16), upperip và lowerip, được thêm vào để ghi lại phạm vi địa chỉ IP bị cấm tối đa và tối thiểu
  * Thay đổi một số trường thành "lớn", chẳng hạn như INT thành BIGINT, TEXT thành MEDIUMTEXT, v.v.
  * Để hỗ trợ IPv6, tất cả các định nghĩa trường của IP1/IP2/IP3/IP4 đã bị xóa, hãy tham khảo [scheme-change-drop-columns.sql](https://gitee.com/oldhuhu/DiscuzX34235/blob/master/scheme/scheme-change-drop-columns.sql)

##### 1.2 Để hỗ trợ các thay đổi liên quan đến InnoDB

Đối với công cụ cơ sở dữ liệu InnoDB, các thay đổi sau cũng sẽ được thực hiện, tham khảo [scheme-change-innodb.sql](https://gitee.com/oldhuhu/DiscuzX34235/blob/master/scheme/scheme-change-innodb.sql)
  * Để hỗ trợ InnoDB, một chỉ mục đã được thêm vào bảng pre_common_member_grouppm
  * Để hỗ trợ InnoDB, trong bảng pre_forum_post, thuộc tính auto_increment của vị trí bị hủy

Trong tệp cấu hình, mục cấu hình liên quan mới được giới thiệu và mục cấu hình này phải được đặt chính xác. Đặc biệt là đối với những người dùng đã nâng cấp, nếu không sẽ khiến chức năng đăng bài hoạt động không bình thường.

```
$_config['db']['common']['engine'] = 'innodb';
```


##### 1.3 Để hỗ trợ các thay đổi liên quan đến utf8mb4

Đối với công cụ MyISAM, do giới hạn độ dài chỉ mục là 1000 byte, một số chỉ mục cần được xác định lại, tham khảo [scheme-change-myisam-utf8mb4.sql](https://gitee.com/oldhuhu/DiscuzX34235/blob/master/scheme/scheme-change-myisam-utf8mb4.sql)

Cho dù đó là InnoDB hay MyISAM, tất cả các bảng đều sử dụng mã hóa utf8mb4 và utf8mb4_unicode_ci, tham khảo [scheme-change-charset.sql](https://gitee.com/oldhuhu/DiscuzX34235/blob/master/scheme/scheme-change-charset.sql)


#### 2. Các thay đổi liên quan đến IP

Trong phiên bản 3.5, để hỗ trợ IPv6, các thay đổi sau đã được thực hiện

##### 2.1 Thư viện địa chỉ IP

Hệ thống hiện hỗ trợ nhiều thư viện địa chỉ, có thể được chọn thông qua các mục cấu hình sau trong tệp cấu hình:

```
$_config['ipdb']['setting']['fullstack'] = '';	// Thư viện IP toàn ngăn xếp được hệ thống sử dụng, với mức độ ưu tiên cao nhất
$_config['ipdb']['setting']['default'] = '';	// Thư viện IP mặc định được hệ thống sử dụng, có mức ưu tiên thấp nhất
$_config['ipdb']['setting']['ipv4'] = 'tiny';	// Thư viện IPv4 mặc định được hệ thống sử dụng, hãy để trống để sử dụng thư viện mặc định
$_config['ipdb']['setting']['ipv6'] = 'v6wry'; // Thư viện IPv6 mặc định được hệ thống sử dụng, hãy để trống để sử dụng thư viện mặc định
```

地址库对应的class为 `ip_<地址库名称>` ，位于 `source/class/ip` 下面。系统会根据配置自动加载相应的class，相应的class也可以有自己的配置项，其规则为：

```
 * $_config['ipdb']下除setting外均可用作自定义扩展IP库设置选项，也欢迎大家PR自己的扩展IP库。
 * 扩展IP库的设置，请使用格式：
 * 		$_config['ipdb']['扩展ip库名称']['设置项名称'] = '值';
 * 比如：
 * 		$_config['ipdb']['redis_ip']['server'] = '172.16.1.8';
```

系统现在内置一个IPv4库，一个IPv6库

##### 2.2 IP封禁

现在IP地址封禁，不再使用 `*` 作为通配符，而是使用[子网掩码(CIDR)](https://cloud.tencent.com/developer/article/1392116)的方式来指定要封禁的地址范围。

IP封禁的配置，现在保存在pre_common_banned表中，**每次**用户访问的时候，都会触发检查。现在的检查效率较高，每次只会产生一个带索引的SQL查询（基于VARBINARY类型的大小比较）。对于一般的站点性能不会带来问题。另外可以启用Redis缓存，来进一步提高性能。另外还有一个配置项可关闭此功能，使用外部的防火墙等来进行IP封禁管理：

```
$_config['security']['useipban'] = 1; // 是否开启允许/禁止IP功能，高负载站点可以将此功能疏解至HTTP Server/CDN/SLB/WAF上，降低服务器压力
```

##### 2.3 IP地址获取

IP地址获取，现在默认只信任REMOTE_ADDR，其它的因为太容易仿造，默认禁止。获取的方式也可以扩展，在配置文件中增加了以下配置项

```
/**
 * IP获取扩展
 * 考虑到不同的CDN服务供应商提供的判断CDN源IP的策略不同，您可以定义自己服务供应商的IP获取扩展。
 * 为空为使用默认体系，非空情况下会自动调用source/class/ip/getter_值.php内的get方法获取IP地址。
 * 系统提供dnslist(IP反解析域名白名单)、serverlist(IP地址白名单，支持CIDR)、header扩展，具体请参考扩展文件。
 * 性能提示：自带的两款工具由于依赖RDNS、CIDR判定等操作，对系统效率有较大影响，建议大流量站点使用HTTP Server
 * 或CDN/SLB/WAF上的IP黑白名单等逻辑实现CDN IP地址白名单，随后使用header扩展指定服务商提供的IP头的方式实现。
 * 安全提示：由于UCenter、UC_Client独立性及扩展性原因，您需要单独修改相关文件的相关业务逻辑，从而实现此类功能。
 * $_config['ipgetter']下除setting外均可用作自定义IP获取模型设置选项，也欢迎大家PR自己的扩展IP获取模型。
 * 扩展IP获取模型的设置，请使用格式：
 * 		$_config['ipgetter']['IP获取扩展名称']['设置项名称'] = '值';
 * 比如：
 * 		$_config['ipgetter']['onlinechk']['server'] = '100.64.10.24';
 */
$_config['ipgetter']['setting'] = '';
$_config['ipgetter']['header']['header'] = 'HTTP_X_FORWARDED_FOR';
$_config['ipgetter']['iplist']['header'] = 'HTTP_X_FORWARDED_FOR';
$_config['ipgetter']['iplist']['list']['0'] = '127.0.0.1';
$_config['ipgetter']['dnslist']['header'] = 'HTTP_X_FORWARDED_FOR';
$_config['ipgetter']['dnslist']['list']['0'] = 'comsenz.com';
```

#### 3. 缓存

3.5非常大的增强了对Redis缓存的支持，在使用了Redis的情况下，完全消除了对内存表的使用。包括：

* 所有的原session内存表相关的功能，全部由Redis实现
* setting不再一次性加载，而是分批按需加载
* 对IP封禁的检测结果进行缓存

推荐所有的站配置并启用Redis缓存。

由于memcached的功能限制，以上的增强对memcached无效。

**提示：由于 PHP 认为实现了 ArrayAccess 接口的对象并非完全等同于数组，因此原有依赖 array_key_exists 的插件或二次开发站点应取消对其的依赖。**

#### 4. 支持包括论坛在内在所有功能开关

3.5现在支持几乎所有功能的开关，管理员甚至可以关闭论坛，只使用门户。相关的修改请点击 [PR291](https://gitee.com/Discuz/DiscuzX/pulls/291)


#### 5. 其它改动

* 增加了一个测试框架，可在后台运行，代码位于 `upload/tests` 下，测试用例可在 `upload/tests/class` 下添加。欢迎大家通过Pull Request提交测试用例
* 修改了安装程序最后一步的日志输出方式，现在整个创建数据库的过程日志都可实时显示
* 不再使用mysql驱动，只使用mysqli
* 内置了function_debug.php文件，通过 `$_config['debug'] = 1` 打开

#### 6. 最低运行环境要求

**安全提示：我们强烈建议您使用仍在开发团队支持期内的操作系统、Web服务器、PHP、数据库、内存缓存等软件，超出支持期的软件可能会对您的站点带来未知的安全隐患。**
**性能提示：当 MySQL < 5.7 或 MariaDB < 10.2 时， InnoDB 性能下降较为严重，因此在生产系统上运行的站点应升级版本至 MySQL >= 5.7 或 MariaDB >= 10.2 以避免此问题。**

| 软件名称 | 最低要求   | 推荐版本     | 其他事项                                                        |
| ------- | ---------- | ----------- | -------------------------------------------------------------- |
| PHP     | >= 5.6.0   | 7.3 - 8.0   | 依赖 XML 扩展、 JSON 扩展、 GD 扩展 >= 1.0 ，PHP 8.0 为测试性支持 |
| MySQL   | >= 5.5.3   | 5.7 - 8.0   | 如使用 MariaDB ，推荐版本为 >= 10.2                              |

### **简介** 

Discuz! X 官方 Git (https://gitee.com/Discuz/DiscuzX) ，简体中文 UTF8 版本

### **声明**
您可以 Fork 本站代码，但未经许可 **禁止** 在本产品的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于 **重新分发** 

### **DxGit Forker 交流群**
参与本项目PR的小伙伴，可以私信 [@zoewho](https://gitee.com/zoewho) 、[@DiscuzX](https://gitee.com/3dming)，提供QQ，加入DxGit Forker QQ群交流。

[点击查看如何提交代码到本项目](https://gitee.com/Discuz/DiscuzX/wikis/%E6%8F%90%E4%BA%A4%E4%BB%A3%E7%A0%81%E5%88%B0%E6%9C%AC%E9%A1%B9%E7%9B%AE?sort_id=3466289)

### **发布版下载**
[点击下载发布版](https://gitee.com/Discuz/DiscuzX/attach_files) 
|
[备用下载地址](https://www.dismall.com/thread-73-1-1.html)

*感谢 [DiscuzFans](https://gitee.com/3dming/DiscuzL/attach_files) 提供简体GBK、简体UTF8、繁体UTF8的打包版*

### **免费协助安装** 

为方便站长基于 Discuz! X 搭建网站，[Discuz! 应用中心](https://addon.dismall.com/) 为站长提供免费安装 Discuz! X  的服务，详情咨询QQ  1453650


### **安装、升级教程**
使用发布版的用户，查阅安装包中的 readme.html 文件，使用码云原版的用户，查看：[安装教程](https://gitee.com/Discuz/DiscuzX/wikis/%E5%AE%89%E8%A3%85%E6%95%99%E7%A8%8B?sort_id=3466132)、[升级教程](https://gitee.com/Discuz/DiscuzX/wikis/%E5%8D%87%E7%BA%A7%E6%96%B9%E6%B3%95?sort_id=9978)


### **相关网站**
 
[Discuz! X 官方论坛](https://www.discuz.net/) 
|
[Discuz! 应用中心](https://addon.dismall.com/) 
|
[Discuz! 开放平台](https://open.dismall.com/) 
|
[Discuz! 开发文档](https://open.dismall.com/?ac=document&page=dev) 

 
[Discuz! Q 官方网站](https://discuz.com/) 
|
[Discuz! Q 官方论坛](https://discuz.chat/)
|
[DNSPod](https://www.dnspod.cn/)
|
[商标注册](https://tm.cloud.tencent.com/)
|
[域名注册](https://dnspod.cloud.tencent.com/)

### **感谢 Fans**

[DiscuzFans](https://gitee.com/sinlody/DiscuzFans)  [DiscuzLite](https://gitee.com/3dming/DiscuzL)

### **每日构建下载**

Discuz! X提供3.4(稳定版)和正在开发中的3.5(不稳定版本)的每日构建，在有提交的第二天早上，可以下载到简体GBK、简体UTF8、繁体BIG5、繁体UTF8的打包版本。

[点击打开](https://www.discuz.net/daily/)

### **友情提示**
- 本站不再发布其他编码的版本，请下载后自行通过[转码工具](https://gitee.com/Discuz/DiscuzX/attach_files)转码，或者下载本站授权的[打包版](https://gitee.com/3dming/DiscuzL/attach_files)
- Git 版的 Release 版本号不再更新，但 DiscuzFans 的打包版会更新
- 由于 X3.2、X3.3 已停更，X3.4 漏洞和相关修补同样适用于 X3.2、X3.3 版本，请随时关注[更新列表](https://gitee.com/Discuz/DiscuzX/commits/master)，您可进行手动修补，让自己的站点时刻保持最安全的状态!

### 截图
![系统信息](./readme/screenshot.png "系统信息截图")
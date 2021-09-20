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

`source/class/ip` :

```
 * Tất cả các mục dưới $_config['ipdb'] có thể được sử dụng làm tùy chọn cài đặt thư viện IP mở rộng.
 * Để mở rộng cài đặt thư viện IP, vui lòng sử dụng định dạng:
 * Ví dụ:
 * 	$_config['ipdb']['redis_ip']['server'] = '172.16.1.8';
```

Hệ thống hiện có thư viện IPv4 tích hợp sẵn và thư viện IPv6

##### 2.2 Cấm IP

Giờ đây, địa chỉ IP đã bị cấm, `*` không còn được sử dụng làm ký tự đại diện nữa mà sử dụng [Subnet Mask (CIDR)](https://cloud.tencent.com/developer/article/1392116)

```
$_config['security']['useipban'] = 1; // Cho dù bật/tắt chức năng IP, các trang web tải cao có thể bỏ chặn chức năng này với Máy chủ HTTP/CDN/SLB/WAF để giảm áp lực máy chủ
```

##### 2.3 Mua lại địa chỉ IP

Việc mua lại địa chỉ IP, giờ đây chỉ REMOTE_ADDR được tin cậy theo mặc định và các địa chỉ khác bị cấm theo mặc định vì chúng quá dễ bắt chước.

```
/**
 * Phần mở rộng chuyển đổi IP
 * Đối với cài đặt của mô hình thu nhận IP mở rộng, vui lòng sử dụng định dạng:
 * Ví dụ:
 * 	$_config['ipgetter']['onlinechk']['server'] = '100.64.10.24';
 */
$_config['ipgetter']['setting'] = '';
$_config['ipgetter']['header']['header'] = 'HTTP_X_FORWARDED_FOR';
$_config['ipgetter']['iplist']['header'] = 'HTTP_X_FORWARDED_FOR';
$_config['ipgetter']['iplist']['list']['0'] = '127.0.0.1';
$_config['ipgetter']['dnslist']['header'] = 'HTTP_X_FORWARDED_FOR';
$_config['ipgetter']['dnslist']['list']['0'] = 'comsenz.com';
```

#### 3. Các thay đổi khác

* Khung thử nghiệm đã được thêm vào, có thể chạy ở chế độ nền. Mã nằm trong phần `upload/tests` và các trường hợp thử nghiệm có thể được thêm vào trong phần 'upload/tests/class`.
* Không sử dụng trình điều khiển mysql nữa, chỉ sử dụng mysqli
* Tệp function_debug.php tích hợp sẵn, mở nó bằng `$_config['debug'] = 1`

#### 4. Yêu cầu môi trường hoạt động tối thiểu

**Mẹo bảo mật: Chúng tôi đặc biệt khuyên bạn nên sử dụng hệ điều hành, máy chủ web, PHP, cơ sở dữ liệu, bộ nhớ đệm và phần mềm khác vẫn còn trong thời gian hỗ trợ của nhóm phát triển. Phần mềm vượt quá thời hạn hỗ trợ có thể mang lại những rủi ro bảo mật chưa biết cho trang web của bạn .**
**Mẹo về hiệu suất: Khi MySQL <5.7 hoặc MariaDB <10.2, hiệu suất InnoDB giảm nghiêm trọng hơn. Do đó, các trang web chạy trên hệ thống sản xuất nên được nâng cấp lên MySQL> = 5.7 hoặc MariaDB> = 10.2 để tránh sự cố này.**

| Tên |Tối thiểu   | Đề xuất     | Khác                                                        |
| ------- | ---------- | ----------- | -------------------------------------------------------------- |
| PHP     | >= 5.6.0   | 7.3 - 8.0   | Tiện ích mở rộng XML, JSON, GD> = 1.0, PHP 8.0 thử nghiệm |
| MySQL   | >= 5.5.3   | 5.7 - 8.0   | Nếu bạn sử dụng MariaDB, phiên bản được đề xuất là >= 10.2                              |


### **Tải xuống bản dựng hàng ngày**

Discuz! X cung cấp các bản dựng hàng ngày gồm 3.4 (phiên bản ổn định) và 3.5 (phiên bản không ổn định) đang được phát triển.

[Bấm để mở](https://www.discuz.net/daily/)

### Ảnh chụp màn hình
![Thông tin hệ thống](./readme/screenshot.png "Ảnh chụp màn hình thông tin hệ thống")
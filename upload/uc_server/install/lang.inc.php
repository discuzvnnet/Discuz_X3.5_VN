<?php

define('UC_VERNAME', '中文版');

$lang = array(

	'SC_UTF8' => '简体中文 UTF8 版',
	'TC_UTF8' => '繁体中文 UTF8 版',
	'EN_UTF8' => 'ENGLIST UTF-8',

	'title_install' => 'Trình cài đặt '.SOFT_NAME.'',
	'agreement_yes' => 'Tôi đồng ý',
	'agreement_no' => 'Tôi không đồng ý',
	'notset' => 'không giới hạn',

	'message_title' => 'Thông tin nhanh chóng',
	'error_message' => 'Thông báo lỗi',
	'message_return' => 'Trở lại',
	'return' => 'Trở lại',
	'install_wizard' => 'Trình cài đặt',
	'config_nonexistence' => 'Tệp cấu hình không tồn tại',
	'nodir' => 'Thư mục không tồn tại',
	'short_open_tag_invalid' => 'Xin lỗi, vui lòng đặt short_open_tag trong php.ini thành Bật, nếu không quá trình cài đặt không thể tiếp tục.',
	'redirect' => 'Trình duyệt sẽ tự động chuyển đến trang mà không cần can thiệp thủ công.<br>Nếu trình duyệt của bạn không tự động chuyển hướng, vui lòng nhấp vào đây',

	'database_errno_2003' => 'Không thể kết nối với cơ sở dữ liệu, vui lòng kiểm tra xem cơ sở dữ liệu đã được khởi động chưa và địa chỉ máy chủ cơ sở dữ liệu có đúng không',
	'database_errno_1044' => 'Không thể tạo cơ sở dữ liệu mới, vui lòng kiểm tra xem tên cơ sở dữ liệu có đúng không',
	'database_errno_1045' => 'Không thể kết nối với cơ sở dữ liệu, vui lòng kiểm tra xem tên người dùng hoặc mật khẩu của cơ sở dữ liệu có đúng không',
	'database_errno_1064' => 'Lỗi cú pháp SQL',

	'dbpriv_createtable' => 'Không có quyền CREATE TABLE, không thể tiếp tục cài đặt',
	'dbpriv_insert' => 'Không có quyền INSERT, không thể tiếp tục cài đặt',
	'dbpriv_select' => 'Không có quyền SELECT, không thể tiếp tục cài đặt',
	'dbpriv_update' => 'Không có quyền UPDATE, không thể tiếp tục cài đặt',
	'dbpriv_delete' => 'Không có quyền DELETE, không thể tiếp tục cài đặt',
	'dbpriv_droptable' => 'Không có quyền DROP TABLE, không thể tiếp tục cài đặt',

	'db_not_null' => 'UCenter đã được cài đặt trong cơ sở dữ liệu. Nếu bạn tiếp tục cài đặt, dữ liệu gốc sẽ bị xóa.',
	'db_drop_table_confirm' => 'Tiếp tục cài đặt sẽ xóa tất cả dữ liệu gốc. Bạn có chắc chắn muốn tiếp tục không?',

	'writeable' => 'Ghi',
	'unwriteable' => 'Không thể ghi',
	'old_step' => 'Trước',
	'new_step' => 'Bước tiếp',

	'database_errno_2003' => 'Không thể kết nối với cơ sở dữ liệu, vui lòng kiểm tra xem cơ sở dữ liệu đã được khởi động chưa và địa chỉ máy chủ cơ sở dữ liệu có đúng không',
	'database_errno_1044' => 'Không thể tạo cơ sở dữ liệu mới, vui lòng kiểm tra xem tên cơ sở dữ liệu có đúng không',
	'database_errno_1045' => 'Không thể kết nối với cơ sở dữ liệu, vui lòng kiểm tra xem tên người dùng hoặc mật khẩu của cơ sở dữ liệu có đúng không',

	'step_env_check_title' => 'Bắt đầu cài đặt',
	'step_env_check_desc' => 'Kiểm tra quyền đối với môi trường và thư mục tệp',
	'step_db_init_title' => 'Cài đặt cơ sở dữ liệu',
	'step_db_init_desc' => 'Thực hiện cài đặt cơ sở dữ liệu',

	'step1_file' => 'Tệp danh mục',
	'step1_need_status' => 'Trạng thái mong muốn',
	'step1_status' => 'Tình trạng hiện tại',
	'not_continue' => 'Vui lòng sửa chữ thập đỏ ở trên và thử lại',

	'tips_dbinfo' => 'Điền thông tin cơ sở dữ liệu',
	'tips_dbinfo_comment' => '',
	'tips_admininfo' => 'Điền thông tin quản trị viên',
	'tips_admininfo_comment' => 'Vui lòng ghi nhớ mật khẩu của người sáng lập UCenter và đăng nhập vào UCenter bằng mật khẩu này.',
	'step_ext_info_title' => 'Cài đặt thành công ',
	'step_ext_info_desc' => 'Bấm để đăng nhập',

	'ext_info_succ' => 'Cài đặt thành công ',
	'install_locked' => 'Bản cài đặt bị khóa, đã được cài đặt rồi, nếu bạn chắc chắn muốn cài đặt lại, vui lòng xóa nó trên máy chủ<br /> '.str_replace(ROOT_PATH, '', $lockfile),
	'error_quit_msg' => 'Bạn phải giải quyết các vấn đề trên trước khi quá trình cài đặt có thể tiếp tục',

	'step_app_reg_title' => 'Thiết lập môi trường hoạt động',
	'step_app_reg_desc' => 'Phát hiện môi trường máy chủ và đặt UCenter',
	'tips_ucenter' => 'Vui lòng điền thông tin liên quan đến UCenter',
	'tips_ucenter_comment' => 'UCenter là chương trình dịch vụ cốt lõi của các sản phẩm Comsenz. Việc cài đặt và vận hành Discuz! Board phụ thuộc vào chương trình này. Nếu bạn đã cài đặt UCenter, vui lòng điền các thông tin sau. Nếu không, vui lòng truy cập <a href="http://www.discuz.com/" target="blank">Trung tâm sản phẩm Comsenz</a> để tải xuống và cài đặt, sau đó tiếp tục.',

	'advice_mysqli_connect' => 'Vui lòng kiểm tra xem mô-đun mysqli đã được tải đúng chưa',
	'advice_xml_parser_create' => 'Hàm này yêu cầu PHP hỗ trợ XML. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'advice_json_encode' => 'Hàm này yêu cầu PHP hỗ trợ JSON. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'advice_fsockopen' => 'Hàm này cần bật tùy chọn allow_url_fopen trong php.ini. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'advice_pfsockopen' => 'Hàm này cần bật tùy chọn allow_url_fopen trong php.ini. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'advice_stream_socket_client' => 'Hàm này cần được bật trong hàm stream_socket_client trong php.ini. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'advice_curl_init' => 'Hàm này yêu cầu phải bật hàm curl_init trong php.ini. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',

	'undefine_func' => 'Chức năng không tồn tại',
	'mysqli_unsupport' => 'Vui lòng kiểm tra xem mô-đun mysqli đã được tải đúng chưa',

	'ucurl' => 'UCenter URL',
	'ucpw' => 'UCenter password',

	'tips_siteinfo' => 'Vui lòng điền thông tin trang web',
	'sitename' => 'Tên trang web',
	'siteurl' => 'URL trang web',

	'forceinstall' => 'Cài đặt bắt buộc',
	'dbinfo_forceinstall_invalid' => 'Cơ sở dữ liệu hiện tại đã chứa các bảng dữ liệu có tiền tố bảng giống nhau. Bạn có thể sửa đổi "table prefix" để tránh xóa dữ liệu cũ hoặc chọn buộc cài đặt. Cài đặt cưỡng bức sẽ xóa dữ liệu cũ và không thể khôi phục',

	'click_to_back' => 'Nhấp để quay lại bước trước đó',
	'adminemail' => 'Hộp thư hệ thống Email',
	'adminemail_comment' => 'Được sử dụng để gửi báo cáo lỗi chương trình',
	'dbhost_comment' => 'Địa chỉ máy chủ cơ sở dữ liệu, thường là localhost',
	'tablepre_comment' => 'Khi chạy nhiều diễn đàn trong cùng một cơ sở dữ liệu, vui lòng sửa đổi tiền tố',
	'forceinstall_check_label' => 'Tôi muốn xóa dữ liệu và buộc cài đặt !!!',

	'uc_url_empty' => 'Bạn đã không điền vào URL của UCenter, vui lòng quay lại và điền vào',
	'uc_url_invalid' => 'URL không đúng định dạng',
	'uc_url_unreachable' => 'Địa chỉ URL của UCenter có thể không chính xác, vui lòng kiểm tra',
	'uc_ip_invalid' => 'Không thể phân giải tên miền, vui lòng điền vào IP của trang web',
	'uc_admin_invalid' => 'Mật khẩu người sáng lập UC bị sai, vui lòng điền lại',
	'uc_data_invalid' => 'Giao tiếp không thành công, vui lòng kiểm tra xem địa chỉ URL của UC có chính xác không ',
	'ucenter_ucurl_invalid' => 'URL của UC trống hoặc định dạng sai, vui lòng kiểm tra',
	'ucenter_ucpw_invalid' => 'Mật khẩu người sáng lập của UC trống hoặc định dạng sai, vui lòng kiểm tra',
	'siteinfo_siteurl_invalid' => 'URL trang web trống hoặc định dạng sai, vui lòng kiểm tra',
	'siteinfo_sitename_invalid' => 'Tên trang web trống hoặc định dạng sai, vui lòng kiểm tra',
	'dbinfo_dbhost_invalid' => 'Máy chủ cơ sở dữ liệu trống hoặc định dạng sai, vui lòng kiểm tra',
	'dbinfo_dbname_invalid' => 'Tên cơ sở dữ liệu trống hoặc định dạng sai, vui lòng kiểm tra',
	'dbinfo_dbuser_invalid' => 'Tên người dùng cơ sở dữ liệu trống hoặc định dạng sai, vui lòng kiểm tra',
	'dbinfo_dbpw_invalid' => 'Mật khẩu cơ sở dữ liệu trống hoặc định dạng sai, vui lòng kiểm tra',
	'dbinfo_adminemail_invalid' => 'Hộp thư hệ thống trống hoặc định dạng sai, vui lòng kiểm tra',
	'dbinfo_tablepre_invalid' => 'Tiền tố tên bảng không được chứa ký tự "." Và không được bắt đầu bằng số',
	'admininfo_username_invalid' => 'Tên người dùng quản trị viên trống hoặc định dạng sai, vui lòng kiểm tra',
	'admininfo_email_invalid' => 'Email quản trị viên trống hoặc định dạng sai, vui lòng kiểm tra',
	'admininfo_ucfounderpw_invalid' => 'Mật khẩu quản trị viên trống, vui lòng điền vào',
	'admininfo_ucfounderpw2_invalid' => 'Hai mật khẩu không nhất quán, vui lòng kiểm tra',

	'username' => 'Tài khoản quản trị',
	'email' => 'Email quản trị',
	'password' => 'Mật khẩu quản trị',
	'password_comment' => 'Mật khẩu quản trị không được để trống',
	'password2' => 'Lặp lại mật khẩu',

	'admininfo_invalid' => 'Thông tin quản trị viên không đầy đủ, vui lòng kiểm tra tài khoản quản trị viên, mật khẩu và địa chỉ email',
	'dbname_invalid' => 'Tên cơ sở dữ liệu trống, vui lòng điền vào tên cơ sở dữ liệu',
	'admin_username_invalid' => 'Tên người dùng bất hợp pháp, độ dài của tên người dùng không được vượt quá 15 ký tự và không được chứa các ký tự đặc biệt',
	'admin_password_invalid' => 'Mật khẩu không phù hợp với những điều trên, vui lòng nhập lại',
	'admin_email_invalid' => 'Địa chỉ email sai, địa chỉ email này đã được sử dụng hoặc định dạng không hợp lệ, vui lòng thay đổi địa chỉ khác',
	'admin_invalid' => 'Thông tin người quản lý thông tin của bạn chưa được điền đầy đủ, vui lòng điền cẩn thận từng mục',
	'admin_exist_password_error' => 'Người dùng đã tồn tại. Nếu bạn muốn đặt người dùng này làm quản trị viên của diễn đàn, vui lòng nhập chính xác mật khẩu của người dùng hoặc thay đổi tên của quản trị viên diễn đàn',

	'tagtemplates_subject' => 'Tiêu đề',
	'tagtemplates_uid' => 'User ID',
	'tagtemplates_username' => 'Poster',
	'tagtemplates_dateline' => 'ngày',
	'tagtemplates_url' => 'Địa chỉ chủ đề',

	'uc_version_incorrect' => 'Phiên bản máy chủ UCenter của bạn quá thấp, vui lòng nâng cấp máy chủ UCenter lên phiên bản mới nhất và nâng cấp, địa chỉ tải xuống: http://www.comsenz.com/.',
	'config_unwriteable' => 'Trình hướng dẫn cài đặt không thể ghi tệp cấu hình, vui lòng đặt thuộc tính chương trình config.inc.php thành có thể ghi được (777)',

	'install_in_processed' => 'Đang cài đặt...',
	'install_succeed' => 'Đã cài đặt thành công trung tâm người dùng, nhấp để vào bước tiếp theo',
	'copyright' => 'Copyright &copy; 2001-'.date('Y').' Tencent Cloud.',
	'license' => '<div class="license"><h1>Phiên bản tiếng Trung của thỏa thuận cấp phép áp dụng cho người dùng Trung Quốc</h1>

<p>版权所有 (c) 2001-'.date('Y').'，腾讯云计算（北京）有限责任公司(原北京康盛新创科技有限责任公司)保留所有权利。</p>

<p>感谢您选择 UCenter 产品。希望我们的努力能为您提供一个高效快速和强大的站点解决方案。</p>

<p>北京康盛新创科技有限责任公司为 UCenter 产品的开发商，依法独立拥有 UCenter 产品著作权。北京康盛新创科技有限责任公司网址为 http://www.comsenz.com，UCenter 官方网站网址为 http://www.discuz.com，UCenter 官方讨论区网址为 http://www.discuz.net。</p>

<p>UCenter 著作权已在中华人民共和国国家版权局注册，著作权受到法律和国际公约保护。使用者：无论个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，在理解、同意、并遵守本协议的全部条款后，方可开始使用 UCenter 软件。</p>

<p>本授权协议适用且仅适用于 UCenter 1.x 版本，北京康盛新创科技有限责任公司拥有对本授权协议的最终解释权。</p>

<h3>I. 协议许可的权利</h3>
<ol>
<li>您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途，而不必支付软件版权授权费用。</li>
<li>您可以在协议规定的约束和限制范围内修改 UCenter 源代码(如果被提供的话)或界面风格以适应您的网站要求。</li>
<li>您拥有使用本软件构建的网站中全部会员资料、文章及相关信息的所有权，并独立承担与文章内容的相关法律义务。</li>
<li>获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持期限、技术支持方式和技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。</li>
</ol>

<h3>II. 协议规定的约束和限制</h3>
<ol>
<li>未获商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目或实现盈利的网站）。购买商业授权请登陆http://www.discuz.com参考相关说明，也可以致电8610-51657885了解详情。</li>
<li>不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。</li>
<li>无论如何，即无论用途如何、是否经过修改或美化、修改程度如何，只要使用 UCenter 的整体或任何部分，未经书面许可，页面页脚处的 UCenter 名称和北京康盛新创科技有限责任公司下属网站（http://www.comsenz.com、http://www.discuz.com 或 http://www.discuz.net） 的链接都必须保留，而不能清除或修改。</li>
<li>禁止在 UCenter 的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。</li>
<li>如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。</li>
</ol>

<h3>III. 有限担保和免责声明</h3>
<ol>
<li>本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。</li>
<li>用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。</li>
<li>北京康盛新创科技有限责任公司不对使用本软件构建的网站中的文章或信息承担责任。</li>
</ol>

<p>有关 UCenter 最终用户授权协议、商业授权与技术服务的详细内容，均由 UCenter 官方网站独家提供。北京康盛新创科技有限责任公司拥有在不事先通知的情况下，修改授权协议和服务价目表的权力，修改后的协议或价目表对自改变之日起的新授权用户生效。</p>

<p>电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始安装 UCenter，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</p></div>',

	'uc_installed' => 'Bạn đã cài đặt UCenter rồi, nếu cần cài đặt lại, vui lòng xóa tệp data/install.lock',
	'i_agree' => 'Tôi đã đọc kỹ và đồng ý với tất cả các nội dung trong các điều khoản trên',
	'supportted' => 'Hỗ trợ',
	'unsupportted' => 'không hỗ trợ',
	'max_size' => 'Hỗ trợ / Kích thước tối đa',
	'project' => 'Dự án',
	'ucenter_required' => 'UCenter yêu cầu cấu hình',
	'ucenter_best' => 'Trung tâm tốt nhất',
	'curr_server' => 'Máy chủ hiện tại',
	'env_check' => 'Kiểm tra môi trường',
	'os' => 'Hệ điều hành',
	'php' => 'Phiên bản PHP',
	'attachmentupload' => 'Cập nhật tệp',
	'unlimit' => 'không giới hạn',
	'version' => 'Phiên bản',
	'gdversion' => 'Thư viện GD',
	'allow' => 'cho phép ',
	'unix' => 'Unix',
	'diskspace' => 'Dung lượng đĩa',
	'priv_check' => 'Kiểm tra quyền thư mục và tệp',
	'func_depend' => 'Kiểm tra sự phụ thuộc chức năng',
	'func_name' => 'Tên chức năng',
	'check_result' => 'Kết quả kiểm tra',
	'suggestion' => 'Gợi ý',
	'advice_mysqli' => 'Vui lòng kiểm tra xem mô-đun mysqli đã được tải đúng chưa',
	'advice_fopen' => 'Hàm này cần bật tùy chọn allow_url_fopen trong php.ini. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'advice_file_get_contents' => 'Hàm này cần bật tùy chọn allow_url_fopen trong php.ini. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'advice_xml' => 'Hàm này yêu cầu PHP hỗ trợ XML. Vui lòng liên hệ với nhà cung cấp dịch vụ để đảm bảo rằng tính năng này đã được bật',
	'none' => 'Không',

	'dbhost' => 'Máy chủ cơ sở dữ liệu',
	'dbuser' => 'Tên người dùng sở dữ liệu',
	'dbpw' => 'Mật khẩu sở dữ liệu',
	'dbname' => 'Tên cơ sở dữ liệu',
	'tablepre' => 'Tiền tố bảng dữ liệu',

	'ucfounderpw' => 'Mật khẩu của người sáng lập',
	'ucfounderpw2' => 'Lặp lại mật khẩu của người sáng lập',

	'create_table' => 'Tạo bảng dữ liệu',
	'succeed' => 'Thành công ',
);
# composerEmail
本插件是基于PHPMailer 二次封装的插件，简单实用
## 安装
composer require quandi/email

## 使用
```php
use Quan\Email\QuanEmail;

//基于框架安装此处可以忽略
require_once './vendor/autoload.php';

$config = [
    'username' => '',   // 发件邮箱名称
    'password' => '',   // 发件邮箱密码
    'mailer' => 'smtp',                 // 邮件驱动, 支持 smtp|sendmail|mail 三种驱动
    'host' => 'smtp.qq.com',            // SMTP服务器地址
    'security' => 'ssl',                // 加密方式 null|ssl|tls, QQ邮箱必须使用ssl
    'port' => 465,                      // SMTP服务器端口号,一般为25
];
$login = QuanEmail::config($config)
    ->from('发送者账号','发送者名称')
    ->to('接收人账号','接收人名称')
    ->title('这是标题')
    ->text('这是纯文本')
	//->addAttachment('./ecfa8de79ef4dbb12af0523a00f44fcb.jpg')
	//->html('<h1 style="color: red;">嘿嘿，漂亮？</h1><img src="./ecfa8de79ef4dbb12af0523a00f44fcb.jpg" /><h1>哈哈哈</h1>')
    ->send();
	
var_dump($login);exit();

```
### 发给一人
```php
->to('接收人账号','接收人名称')
```
### 发给多人
```php
->to('接收人账号','接收人名称')
->to('接收人账号','接收人名称')
->to('接收人账号','接收人名称')
```
### 发送文本格式
```php
->text('这是纯文本')
```
### 发送html格式
```php
->html('<h1 style="color: red;">嘿嘿，漂亮？</h1><img src="./ecfa8de79ef4dbb12af0523a00f44fcb.jpg" /><h1>哈哈哈</h1>')
//注意文件路径需在服务器
```
### 发送附件
```php
->addAttachment('./ecfa8de79ef4dbb12af0523a00f44fcb.jpg')
//注意文件路径需在服务器
```

### 作者QQ：846951943  （如有需要可联系）

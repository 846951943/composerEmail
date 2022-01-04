<?php
use Quan\Email\QuanEmail;

require './vendor/autoload.php';

try {
    $config = [
        'username' => '', // 发件邮箱名称
        'password' => '',// 发件邮箱密码
        'mailer' => 'smtp',  // 邮件驱动, 支持 smtp|sendmail|mail 三种驱动
        'host' => 'smtp.qq.com',// SMTP服务器地址
        'security' => 'ssl', // 加密方式 null|ssl|tls, QQ邮箱必须使用ssl
        'port' => 465, // SMTP服务器端口号,一般为25
        'debug' => 2, //
    ];
    $send = QuanEmail::config($config)
        ->from('','嘿嘿')
        ->to('','我的')
        ->title('漂亮？')
        ->text('内容1')  //发送纯文本信息
        ->addAttachment('./包.mp4')  //发送纯文本信息
        ->addAttachment('./ecfa8de79ef4dbb12af0523a00f44fcb.jpg')  //发送纯文本信息
//        ->html('<h1 style="color: red;">嘿嘿，漂亮？</h1><img src="./ecfa8de79ef4dbb12af0523a00f44fcb.jpg" /><h1>哈哈哈</h1>')  //发送html信息
//        ->html('')  //发送html信息
        ->send();
    print_r($send);exit();

}catch (\Exception $e){
    print_r($e->getMessage());
}



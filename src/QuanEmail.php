<?php
namespace Quan\Email;

use Quan\Email\lib\PHPMailer ;
use Quan\Email\lib\Exception;
use Quan\Email\lib\SMTP;
class QuanEmail
{
    public $mail;
    public $username = '';
    public $config = [];

    public function __construct()
    {
        $mail = new PHPMailer(true);
        $this->mail = $mail;
    }

    /**
     * 设置配置
     * @param $options
     * @return static
     * User: wang
     * Date: 2022/1/4 16:21
     */
    public static function config($options){
        $obj = new static();
        $obj->config = $options;
        return $obj;
    }

    /**
     * 发送人信息
     * @param string $username 账号
     * @param string $name 昵称
     * @return $this
     * @throws Exception
     * User: wang
     * Date: 2022/1/4 14:57
     */
    public function from($username,$name = ''){
        if(!$username){
            $username = $this->username;
        }
        if($name){
            $this->mail->setFrom($username,$name);
        }else{
            $this->mail->setFrom($username);
        }
        return $this;
    }

    /**
     * 发送
     * @param string $username
     * @param string $name
     * @return $this
     * @throws Exception
     * User: wang
     * Date: 2022/1/4 15:17
     */
    public function to($username,$name = ''){
        if($name){
            $this->mail->addAddress($username,$name);
        }else{
            $this->mail->addAddress($username);
        }
        return $this;
    }

    /**
     * 标题
     * @param string $title 标题
     * @return $this
     * User: wang
     * Date: 2022/1/4 15:41
     */
    public function title($title){
        $this->mail->Subject = $title;
        return $this;
    }

    /**
     * 纯文本内容
     * @param $content
     * @return $this
     * User: wang
     * Date: 2022/1/4 15:42
     */
    public function text($content){
        $this->mail->isHTML(false);
        $this->mail->Body = $content;
        $this->mail->AltBody  = $content;
        return $this;
    }

    /**
     * 发送html内容
     * @param $html
     * @return $this
     * User: wang
     * Date: 2022/1/4 16:06
     */
    public function html($html){
        $this->mail->isHTML(true);
        $html = $this->checkHtml($html);
        $this->mail->Body = $html;
        $this->mail->AltBody = strip_tags($html);
        return $this;
    }

    /**
     * 将图片替换成指定格式
     * @param $html
     * @return string
     * @throws Exception
     * User: wang
     * Date: 2022/1/4 16:21
     */
    public function checkHtml($html){
        $resutl = preg_match_all('@<img src=.+? />@', $html, $matches);
        if(!$resutl) return $html;
        $trans = array();
        foreach ($matches[0] as $key => $img) {
            $id = 'img' . $key;
            preg_match('/src="(.*?)"/', $html, $path);
            if ($path[1]){
                $this->mail->addEmbeddedImage($path[1], $id);
                $trans[$img] = '<img src="cid:' . $id . '" />';
            }
        }
        $html = strtr($html, $trans);
        return $html;
    }

    /**
     * 发送附件
     * @param $url
     * @return $this
     * @throws Exception
     * User: wang
     * Date: 2022/1/4 16:21
     */
    public function addAttachment($url){
        $this->mail->addAttachment($url);
        return $this;
    }

    /**
     * 检测邮箱
     * @param $mailer
     * @throws Exception
     * User: wang
     * Date: 2022/1/4 15:49
     */
    public function cacheMailer($mailer){
        if(filter_var($mailer, FILTER_VALIDATE_EMAIL) === FALSE){
            return false;
        }
        return true;
    }

    /**
     * 发送配置
     * @return array
     * User: wang
     * Date: 2022/1/4 15:46
     */
    public function send(){
        $config = $this->config;
        $this->mail->SMTPDebug = 0;
        $this->mail->Mailer     = $config['mailer'];
        $this->mail->Host       = $config['host'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $config['username'];
        $this->mail->Password   = $config['password'];
        $this->mail->SMTPSecure = $config['security'];
        $this->mail->Port       = $config['port'];
        try {
            $result = $this->mail->send();
        }catch (\Exception $e){
            return ['status'=>-1,'msg'=>$e->getMessage()];
        }
        if($result == 1){
            return ['status'=>1,'msg'=>'发送成功'];
        }else{
            return ['status'=>-1,'msg'=>'发送失败'];
        }

    }


}
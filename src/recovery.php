<?php

namespace nsuki;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Recovery extends DbObject
{
    protected static $db_table = 'recovery';
    protected static $db_table_fields = array('hash','userid');
    protected static $URL = '';
    public $id;
    public $hash;
    public $userid;

    public function matchHash($id)
    {
        $result = User::findByID($id);
        if (!empty($result)) {
            $this->hash = self::generateHash();
            $this->userid = $result->id;
            $this->create();

            $mail = new PHPMailer(true);

            $mail->SMTPDebug = 0;                               
            $mail->isSMTP();            
            $mail->Host = "";
            $mail->SMTPAuth = true;                          
            $mail->Username = "";                 
            $mail->Password = "";                           
            $mail->SMTPSecure = "ssl";                           
            $mail->Port = 465;                                   

            $mail->From = "";
            $mail->FromName = "MyBlog";

            $mail->addAddress($result->email, "");

            $mail->isHTML(true);

            $mail->Subject = "Password Recovery";
            $mail->Body = "<a href='" . self::$URL . "admin/recovery/{$this->hash}'><i>" . self::$URL . "admin/recovery/{$this->hash}</i></a>";
            $mail->AltBody = self::$URL . "admin/recovery/" . $this->hash;
            try {
                $mail->send();
                echo "Recovery link has sent to your email, check your inbox.";
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
        } else {
            echo 'You can not create recovery hash for a non-existing account.';
        }
    }

    public static function resetPass()
    {
        global $db;
        if (isset($_POST['resetpass'])) {
            $email = $db->escapeString($_POST['email']);
            $user = User::findByQuery("SELECT * FROM users WHERE email='$email' LIMIT 1");
            if (!empty($user)) {
                $hash = new Recovery();
                $hash->matchHash($user[0]->id);
            } else {
                echo "We couldn't find a user with this email.";
            }
        }
    }

    public static function generateHash($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return md5($randomString);
    }

    public static function findByHash($hash){
        $theResultArray = self::findByQuery("SELECT * FROM " . static::$db_table . " WHERE hash='$hash' LIMIT 1");
        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }
}
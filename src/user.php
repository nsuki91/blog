<?php

namespace nsuki;

class User extends DbObject
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'email');
    protected static $whitelist = array('//index.php', '//post.php', '/admin/login.php');
    public $id;
    public $username;
    public $password;
    public $email;

    public static function verifyUser($username, $password)
    {
        global $db;
        $username = $db->escapeString($username);
        $password = hash('sha256', $db->escapeString($password));

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}'";
        $sql .= "AND password = '{$password}'";
        $sql .= "LIMIT 1";

        $theResultArray = self::findByQuery($sql);

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    public static function checkLogin()
    {
        if (isset($_POST['login'])) {
            global $db;
            $username = $db->escapeString($_POST['username']);
            $password = $db->escapeString($_POST['password']);
            $result = self::verifyUser($username, $password);
            if (!empty($result)) {
                $newUser = User::inst($result);
                $_SESSION['id'] = $newUser->id;
                echo $_SESSION['id'];
                header('Location: ../admin/');
            } else {
                echo 'This information does not match with a user.';
            }
        }
    }

    public static function checkPassword($logged)
    {
        if (isset($_POST['changePass'])) {
            global $db;
            $oldPass = hash('sha256', $db->escapeString($_POST['oldPass']));
            $newPass = hash('sha256', $db->escapeString($_POST['newPass']));
            if ($oldPass === $logged->password) {
                $logged->password = $newPass;
                $logged->save();
                echo "<p class='text-success'>Password changed</p>";
            } else {
                echo "<p class='text-danger'>Your current password doesnt match.</p>";
            }
        }
    }

    public static function checkRecovery($logged, $hash)
    {
        if (isset($_POST['recovery'])) {
            global $db;
            $pass1 = hash('sha256', $db->escapeString($_POST['pass1']));
            $pass2 = hash('sha256', $db->escapeString($_POST['pass2']));
            if ($pass1 === $pass2) {
                $logged->password = $pass1;
                $logged->save();
                echo "<p class='text-success'>Password changed.</p>";
                header('Location: ../../admin/');
                $hash->delete();
            } else {
                echo "<p class='text-danger'>Passwords don't match.</p>";
            }
        }
    }

    public static function checkRegister()
    {
        if (isset($_POST['register'])) {
            global $db;
            $username = $db->escapeString($_POST['username']);
            $email = $db->escapeString($_POST['email']);
            $password = hash('sha256', $db->escapeString($_POST['password']));
            $result = self::verifyUser($username, $password);
            $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
            if (empty(User::findByQuery($sql))) {
                $newUser = new User();
                $newUser->username = $username;
                $newUser->password = $password;
                $newUser->email = $email;
                $newUser->create();
                echo "<p class='text-success'>New user has been registered successfully.</p>";
            } else {
                echo "<p class='text-danger'>There is already a user with the same username.</p>";
            }
        }
    }

    public static function checkSession(){
        $path = dirname($_SERVER['PHP_SELF']) . '/' . basename($_SERVER['PHP_SELF']);
        if (!isset($_SESSION['id'])) {
            if (!in_array($path, Self::$whitelist)) {
                header('Location: ../admin/login');
            }
        } else {
            $logged = User::findByID($_SESSION['id']);
            return $logged;
        }
    }

    public static function logOut(){
        if (isset($_SESSION['id'])) {
            session_destroy();
            header('Location: ../admin/login');
        }
    }
}

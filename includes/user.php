<?php

class User extends DbObject
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'email');
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
                header('Location: ../admin');
            } else {
                echo 'This information does not match with a user.';
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
                echo 'User registered.';
            } else {
                echo 'There is already a user with this information.';
            }
        }
    }

    public static function checkSession(){
        if (!isset($_SESSION['id'])) {
            if (basename($_SERVER['PHP_SELF']) != 'login.php') {
                header('Location: login');
            }
        } else {
            if (basename($_SERVER['PHP_SELF']) == 'login.php') {
                header('Location: ../admin');
            }
            $logged = User::findByID($_SESSION['id']);
            return $logged;
        }
    }

    public static function logOut(){
        if (isset($_SESSION['id'])) {
            session_destroy();
            header('Location: login');
        }
    }
}

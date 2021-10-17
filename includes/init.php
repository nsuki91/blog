<?php

namespace nsuki;

define('__ROOT__', dirname(dirname(__FILE__)));
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __ROOT__.'/src/Exception.php';
require_once __ROOT__.'/src/PHPMailer.php';
require_once __ROOT__.'/src/SMTP.php';
require_once(__ROOT__.'/src/database.php');
require_once(__ROOT__.'/src/dbobject.php');
require_once(__ROOT__.'/src/post.php');
require_once(__ROOT__.'/src/user.php');
require_once(__ROOT__.'/src/recovery.php');

$db = new Database();
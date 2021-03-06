<?php
/*
- File ini untuk instalasi.
- Rename menjadi "install.php", letakkan di root situs anda kemudian buka http://(situsanda)/install.php
*/
session_start();
$step=isset($_SESSION['step']) ? $_SESSION['step'] : '';
require ('inc/function.php');
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><link rel="stylesheet" href="themes/wapkul/theme.css" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
<title>Wapkul - Install</title>
</head>
<body><div class="container">';
rt('tm');
echo '<div class="list-head"<h2>Wapkul</h2></div><div class="content">';
chmod('inc',0777);
chmod('uploads',0777);
if (file_exists('inc/db_connect.php'))
chmod('inc/db_connect.php',0777);
if (substr(sprintf('%o', fileperms('inc')), -3) != 777 && substr(sprintf('%o', fileperms('uploads')), -3) != 777) {
echo 'Instalasi tidak dapat dilanjutkan, mohon ubah hak akses (chmod) folder "inc" dan "uploads" ke 777 kemudian klik coba lagi.<br/><br/>' .
'<a href="install.php"><b>Coba lagi >></b></a></div>';
rb('b');
exit;
}
if (isset ($_POST['submit']) && $step=='2') {
require('inc/init.php');
$error='';
$username=isset($_POST['username']) ? trim($_POST['username']) : '';
$nick=isset($_POST['nick']) ? trim($_POST['nick']) : '';
$password=isset($_POST['password']) ? trim($_POST['password']) : '';
$confirm=isset($_POST['confirm']) ? trim($_POST['confirm']) : '';
if($password != $confirm)
$error='Password dan konfirmasi tidak sama';
if(!$password || !$confirm)
$error='Password tidak boleh kosong';
if(!$nick)
$error='Nick tidak boleh kosong';
if (preg_match('/[^a-zA-Z0-9]/', $username))
$error='Username hanya boleh huruf dan angka';
if (!$username)
$error='Username tidak boleh kosong';
if (!$error){
mysql_query("DROP TABLE IF EXISTS `user`");
mysql_query("CREATE TABLE `user` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`username` varchar(50) NOT NULL,
`password` varchar(50) NOT NULL,
`nick` varchar(50) NOT NULL,
`about` text,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");
mysql_query("insert into user set " .
"username='" . strtolower($username) . "'," .
"nick='" . mysql_real_escape_string($nick) . "'," .
"password='" . md5(md5(md5($password))) . "'");
unset($_SESSION['step']);
$_SESSION['username']=strtolower($username);
$_SESSION['password']=md5(md5(md5($password)));
chmod('inc/db_connect.php',0644);
chmod('inc',0755);
chmod('.htaccess',0644);
unlink('install.php');
$_SESSION['success_install']='Instalasi selesai';
header('location:admin-panel');
exit;
}
if (isset($error) && $error)
echo '<div class="list-warning">' . $error . '</div><br/>';
echo '<form action="install.php" method="post">Username: <small>(Digunakan pada saat login)</small><br/><input type="text" name="username" value="' . $username . '"><br/><small>Hanya huruf dan angka</small><hr/>' .
'Nick: <small>(Nama panggilan anda di blog)</small><br/><input type="text" name="nick" value="' . $nick . '"><hr/>' .
'Password:<br/><input type="password" name="password" value=""><hr/>' .
'Konfirmasi password:<br/><input type="password" name="confirm" value=""><hr/>' .
'<input type="submit" name="submit" value="Lanjut"></form></div>';
rb('b');
exit;
}else if (isset ($_POST['submit']) && !$step) {
$error='';
$db_name = isset ($_POST['db_name']) ? trim($_POST['db_name']) : '';
$db_username = isset ($_POST['db_username']) ? trim($_POST['db_username']) : '';
$db_password = isset ($_POST['db_password']) ? trim($_POST['db_password']) : '';
$db_host = isset ($_POST['db_host']) ? trim($_POST['db_host']) : '';

if (!mysql_connect($db_host, $db_username, $db_password))
$error='Koneksi ke database gagal.';
if (!mysql_select_db($db_name))
$error='Koneksi ke database gagal.';

if(!$error){
$blogurl = 'http://' . $_SERVER['SERVER_NAME'] . str_replace('/install.php', '', $_SERVER['PHP_SELF']);
$str = "<?php\r\n" .
"define('db_host', '" . $db_host . "');\r\n" .
"define('db_name', '" . $db_name . "');\r\n" .
"define('db_username', '" . $db_username . "');\r\n" .
"define('db_password', '" . $db_password . "');\r\n" .
"?>";

if (!file_put_contents('inc/db_connect.php', $str)) {
echo '<div class="list-warning">Tidak bisa membuat file db_connect.php</div><br/>' .
'Proses instalasi tidak bisa dilanjutkan.';
} else {
mysql_query("DROP TABLE IF EXISTS `blogroll`");
mysql_query("CREATE TABLE `blogroll` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`url` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

mysql_query("DROP TABLE IF EXISTS `category`");
mysql_query("CREATE TABLE `category` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`url` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

mysql_query("DROP TABLE IF EXISTS `comment`");
mysql_query("CREATE TABLE `comment` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`post_id` int(11) NOT NULL,
`name` varchar(40) NOT NULL,
`content` text NOT NULL,
`website` text,
`time` int(11) NOT NULL,
`isread` int(11) NOT NULL DEFAULT '0',
`adm` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

mysql_query("DROP TABLE IF EXISTS `post`");
mysql_query("CREATE TABLE `post` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` text NOT NULL,
`content` text NOT NULL,
`permalink` text NOT NULL,
`author` int(11) NOT NULL DEFAULT '1',
`createtime` int(11) NOT NULL DEFAULT '0',
`modtime` int(11) NOT NULL DEFAULT '0',
`category` int(11) NOT NULL DEFAULT '1',
`draft` int(11) NOT NULL DEFAULT '0',
`nocomment` int(11) NOT NULL DEFAULT '0',
`view` int(11) NOT NULL DEFAULT '0',
`comment` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

mysql_query("DROP TABLE IF EXISTS `setting`");
mysql_query("CREATE TABLE `setting` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`value` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");


mysql_query("INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'blogurl', '$blogurl'),
(2, 'blogname', 'Pojokeblog'),
(3, 'blogdescription', 'Just Another Blog'),
(4, 'timeshift', '7'),
(5, 'list', '10'),
(6, 'theme', 'wapkul'),
(7, 'nocomment', '0'),
(8, 'noblogroll', '0'),
(9, 'nocategory', '0'),
(10, 'norelated', '0'),
(11, 'norecentcomment', '0'),
(12, 'noprofile', '0'),
(13, 'metadescription', ''),
(14, 'metakeyword', '')");

mysql_query("INSERT INTO `category` (`id`, `name`, `url`) VALUES (1, 'General', 'general')");
mysql_query("INSERT INTO `blogroll` (`id`, `name`, `url`) VALUES (1, 'Wapkul', 'wapkul.tk')");
mysql_query("INSERT INTO `blogroll` (`id`, `name`, `url`) VALUES (2, 'Pojokeblog', 'pojokeblog.tk')");
$baseurl=str_replace('install.php', '', $_SERVER['PHP_SELF']);
$htaccess = "Options -Indexes\r\n" .
"ErrorDocument 500 " . $baseurl . "notfound.php\r\n" .
"ErrorDocument 402 " . $baseurl . "notfound.php\r\n" .
"ErrorDocument 403 " . $baseurl . "notfound.php\r\n" .
"ErrorDocument 404 " . $baseurl . "notfound.php\r\n" .

"<IfModule mod_rewrite.c>\r\n" .
"RewriteEngine On\r\n" .
"RewriteBase " . $baseurl . "\r\n" .
"RewriteCond %{REQUEST_FILENAME} !-f\r\n" .
"RewriteCond %{REQUEST_FILENAME} !-d\r\n" .
"RewriteRule ^([A-Za-z0-9-_]+)/?$ index.php?post=$1 [L]\r\n" .
"RewriteRule ^([A-Za-z0-9-_]+)/c([0-9])?$ index.php?post=$1&commentpage=$2 [L]\r\n" .
"RewriteRule ^p/([0-9])/?$ index.php?page=$1 [L]\r\n" .
"RewriteRule ^category/([A-Za-z0-9-_]+)/?$ category/index.php?category=$1 [L]\r\n" .
"RewriteRule ^category/([A-Za-z0-9-_]+)/p([0-9])?$ category/index.php?category=$1&page=$2 [L]\r\n" .
"RewriteRule ^comment/p([0-9])?$ comment/index.php?page=$1 [L]\r\n" .
"RewriteRule ^sitemap.xml$ sitemap.php [L]\r\n" .
"</IfModule>";

if (!file_put_contents('.htaccess', $htaccess)){
echo '<div class="list-warning">Tidak bisa membuat file .htaccess</div><br/>' .
'Silahkan copy kode dibawah ini kemudian simpan dengan nama ".htaccess" dan lanjutkan proses instalasi.<br/>' .
'<textarea rows="6">' . $htaccess . '</textarea><br/>';
}
$_SESSION['step']='2';
echo '<form action="install.php" method="post">Username:<small>(Digunakan pada saat login)</small><br/><input type="text" name="username" value="admin"><br/><small>Hanya huruf dan angka</small><hr/>' .
'Nick:<small>(Nama panggilan anda di blog)</small><br/><input type="text" name="nick" value="Admin"><hr/>' .
'Password:<br/><input type="password" name="password" value=""><hr/>' .
'Konfirmasi password:<br/><input type="password" name="confirm" value=""><hr/>' .
'<input type="submit" name="submit" value="Lanjut"></form>';
}
echo '</div>';
rb('b');
exit;
}
}
if (isset($_SESSION['step'])) unset($_SESSION['step']);
if (isset($error) && $error)
echo '<div class="list-warning">' . $error . '</div><br/>';
echo '<form action="install.php" method="post">Nama Database:<br/><input type="text" name="db_name" value="' . (isset($db_name) ? $db_name : 'pojokeblog') . '"><hr/>' .
'Username MySQL:<br/><input type="text" name="db_username" value="' . (isset($db_username) ? $db_username : 'root') . '"><hr/>' .
'Password MySQL:<br/><input type="password" name="db_password" value="' . (isset($db_password) ? $db_password : '') . '"><hr/>' .
'Host MySQL:<br/><input type="text" name="db_host" value="' . (isset($db_host) ? $db_host : 'localhost') . '"><hr/>' .
'<input type="submit" name="submit" value="Mulai Instalasi"></form>';
rb('b');
echo '</div></body></html>'

?>

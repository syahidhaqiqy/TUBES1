<?php
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
ob_start(ob_gzhandler);
else ob_start();
echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN"
"http://www.wapforum.org/DTD/xhtml-mobile10.dtd">' .
'<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' .
'<meta name="description" content="' . get_setting('metadescription') . '" />' .
'<meta name="keyword" content="' . get_setting('metakeyword') . '" />' .
'<meta name="generator" content="Pojokeblog - http://pojokeblog.tk" />' .
'<link rel="alternate" type="application/rss+xml" title="' . get_setting('blogname') . ' - RSS News" href="' . get_setting('blogurl') . '/feed" />' .
'<link rel="stylesheet" href="' . get_setting('blogurl') . '/themes/' . get_setting('theme') . '/theme.css" type="text/css" />' .
'<link rel="shortcut icon" href="' . get_setting('blogurl') . '/favicon.ico" />' .
'<title>' . (isset ($title) ? ($title . ' - ') : '') . get_setting('blogname') . (!isset ($title) && get_setting('blogdescription') ? (' - ' . get_setting('blogdescription')) : '') . '</title></head><body>' .
'<div class="header"><h1><a href="' . get_setting('blogurl') . '">' . get_setting('blogname') . '</a></h1>' .
get_setting('blogdescription');

echo '<table class="topnav"><tr><td class="' . (isset ($home) ? 'on' : 'off') . '"><a title="Home" href="' . get_setting('blogurl') . '"><img src="' . get_setting('blogurl') . '/images/home.png" alt="Home"/></a></td>';

echo '<td class="' . (strpos($_SERVER['PHP_SELF'], 'category/') ? 'on' : 'off') . '"><a title="Categori" href="' . get_setting('blogurl') . '/category"><img src="' . get_setting('blogurl') . '/images/category.png" alt="Category"/></a></td>';

if (!get_setting('norecentcomment')) {
echo '<td class="' . (strpos($_SERVER['PHP_SELF'], 'comment/') ? 'on' : 'off') . '"><a title="Recent comment" href="' . get_setting('blogurl') . '/comment"><img src="' . get_setting('blogurl') . '/images/comments.png" alt="Recent comment"/></a></td>';
}

if (!get_setting('noprofile')) {
echo '<td class="' . (strpos($_SERVER['PHP_SELF'], 'about/') ? 'on' : 'off') . '"><a title="About author" href="' . get_setting('blogurl') . '/about"><img src="' . get_setting('blogurl') . '/images/user.png" alt="About author"/></a></td>';
}
echo '<td class="off"><a title="RSS Feed" href="' . get_setting('blogurl') . '/feed"><img src="' . get_setting('blogurl') . '/images/feed.png" alt="Feed"/></a></td>';

echo '</tr></table>';

echo '</div>' .
'<div class="search"><form action="' . get_setting('blogurl') . '" method="get">' .
'<table style="width:100%;">' .
'<tr><td valign="center"><input type="text" value="" name="s" style="width:100%;"/></td>' .
'<td style="width:30px;"><input type="submit" value="Search"/></td></tr>' .
'</table></form></div><div class="container">';
rt('t');
echo '<div class="content">';
include ('date.php');
include ('ucapan.php');
echo'</div>';
rb('b');
if ($isadmin && !isset($_GET['readcomment'])) {
$ncek = mysql_num_rows(mysql_query("select * from comment where isread='0'"));
if ($ncek)
show_notif('<a href ="' . get_setting('blogurl') . '/admin-panel?readcomment">You have ' . $ncek . ' new comment(s).</a>');
}
?>

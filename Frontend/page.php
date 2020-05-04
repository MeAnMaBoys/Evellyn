<?php
if (!isset($_GET['path']))
	$path = 'index.html';
else
	$path = $_GET['path'];

if (!file_exists($path))
die('Invalid page '.$path);

$page = file_get_contents('header.html') . file_get_contents($path) . file_get_contents('footer.html');

echo $page;

?>
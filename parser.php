<?php

	echo "333";

	require_once 'function.php';
	require_once 'simple_html_dom.php';

	//$domain = trim($_GET["val"]);

	$domain = '';

	if (!isset($_GET["val"]) || $domain == '' ) {
		echo 'Нет данных';
		return;
	}

	if (!file_exists('sitemap.xml')) {
		$bd = 'sitemap.xml';
		file_put_contents($bd, '');
	}

	$file = 'sitemap.xml';


?>
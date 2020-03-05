<?php

	echo "333";

	require_once 'function.php';
	require_once 'simple_html_dom.php';

	set_time_limit(15);

	if (!isset($_GET["val"]) || $_GET["val"] == '' ) {
		echo 'Нет данных';
		return;
	}

	$domain = trim($_GET["val"]);

	if (!file_exists('sitemap.txt')) {
		$xml = 'sitemap.txt';
		file_put_contents($xml, '');
	}

	$file = 'sitemap.txt';
	$res = file($file);
	$count = count($res);

	var_dump(count($res));

	if ($count < 1) {
		$href_f = $domain;
	}else{
		$href_f = $res[$count -1];
	}

	echo $href_f.'<br>';

	$html = getHome($domain);
	//echo $html;
	$html = str_get_html($html);
	$a = $html->find("a");

	foreach ($a as $key => $value) {
		$href = $value->href;
		$path_info = pathinfo($value->href);

		if (strlen($path_info["dirname"]) <= 1) {
			$href = $domain;
		}
		elseif ($path_info["basename"] == '' || strlen($path_info["basename"]) == 1) {
			return;
		}

		var_dump($path_info);
		writeHrefToFile($href);
	}

?>
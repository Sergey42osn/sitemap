<?php

	require_once 'function.php';
	require_once 'simple_html_dom.php';

	set_time_limit(15);

	$href_arr = [];

	if ($_GET["val"] == '' ) {
		echo 'Нет данных';
		return;
	}else{
		$domain = trim($_GET["val"]);
		$domain_pars = parse_url($domain);
		$domain_host = $domain_pars["host"];
		$domain = $domain_pars["scheme"].'://'.$domain_host;
	}

	//echo 'host='.$domain.'<br>';

	if (!file_exists('sitemap.txt')) {
		$txt = 'sitemap.txt';
		file_put_contents($txt, '');
	}

	if (!file_exists('tmp_sitemap.txt')) {
		$txt = 'tmp_sitemap.txt';
		file_put_contents($txt, '');
	}

	if (!file_exists('houme_sitemap.txt')) {
		$txt = 'houme_sitemap.txt';
		file_put_contents($txt, '');

		$href_f = getHrefTmp($domain);
		//echo $href_f.'<br>';

		$html = getHome($href_f);

		$res = addHrefArray($href_f, $html, $domain, $domain_pars);

		foreach ($res as $value) {
	       $res = writeHrefToFile($value, 'houme_sitemap.txt');
	    }

	    echo "Главная загружена";



	}else{

		$href_tmp = getHrefs('tmp_sitemap.txt');
		$href_houme = getHrefs('houme_sitemap.txt');

		//var_dump($href_houme);

		foreach ($href_houme as $value) {
			//var_dump($value);
			if ($value != $href_tmp[count($href_tmp)-1]) {
	

				$html = getHome($value);
				echo $html;

				$res = addHrefArray($href_f = '', $html, $domain, $domain_pars);

				foreach ($res as $key => $value) {
			       $res = writeHrefToFile($value, 'sitemap.txt');
			    }	
			}
		}

		$href_f = getHrefTmp($domain);
		//echo $href_f.'<br>';

		$html = getHome($href_f);

		$href_array = addHrefArray($href_f, $html, $domain, $domain_pars);

		var_dump($href_array);

		if ($href_array) {

		    foreach ($href_array as $key => $value) {
		       $res = writeHrefToFile($value, 'sitemap.txt');
		    }

		    if ($res) {
		        writeHrefToFile($href_f, 'tmp_sitemap.txt');
		    }

			$file = 'sitemap.txt';
			$hrefs = getHrefs($file);
			//var_dump($hrefs);

			foreach ($hrefs as $href) {
				//var_dump($hrefs);
				$href_tmp = getHrefTmp();


				$html = getHome($href);
			}
		}
	}



	//$href_arr[] = $domain;

	//writeHrefToFile($href_f, 'tmp_sitemap.txt');

?>
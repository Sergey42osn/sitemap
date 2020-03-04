<?php

	require_once 'function.php';
	require_once 'simple_html_dom.php';

	set_time_limit(15);

	if (!file_exists('bd.txt')) {
		$bd = 'bd.txt';
		file_put_contents($bd, '');
	}

	$file = 'bd.txt';

	$res = file($file);

	foreach ($res as $value) {		
		$res = explode(";", $value);
		$href_f = $res[0];
		echo 'href_f='.$href_f.'<br>';
	}

	//$res = file_get_contents($file);

	//$url = 'https://tandyr.pro/catalog/13-tandyr-tair-slonovaya-kost';

	//$html = getHome($url);

	//$html = str_get_html($html);

	//$wr = writeImage($html, 'data');	

	//$attrpage = getAttrProductPage($html, 'product_page');

	$html = getHome('https://tandyr.pro/catalog');

    $html = str_get_html($html);

    $cards_a = $html->find(".card .fullsized");

    $do = 0;

    foreach($cards_a as $a){
    	$href = 'https://tandyr.pro'.$a->href.'';
    	echo 'href='.$href.'<br>';

    	if ($href_f == $href) {
    		$do = 1;
    		sendDataWrite($href, $data  = 0);
    	}elseif ($href_f == '') {
    		sendDataWrite($href, $data  = 1);
    		$do = 1;
    	}elseif ($do == 1 ) {
    		sendDataWrite($href, $data  = 1);
    		$do = 1;
    	}
      }

      function sendDataWrite($href, $data)
      {
      	$html = getHome($href);
    	$html = str_get_html($html);
    	$attrpage = writeAttrProductPage($html, $href, $data, 'product');
    	return $attrpage;
      }

    $html->clear();
	unset($html);


?>
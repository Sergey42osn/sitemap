<?php

	require_once 'function.php';
	require_once 'simple_html_dom.php';

	if (!file_exists('bd.txt')) {
		$bd = 'bd.txt';
		file_put_contents($bd, '');
	}

	$file = 'sitemap.xml';



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Создание XML файла</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>
<body>
	<div class="con">
		<div class="row">
			<div class="col">
				<h1 class="aligen_centr">Создание файла XML онлайн</h1>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="col-con">
					<div class="col-con-box aligen_centr">
						<div class="col-con-box_h">
							<h3 class="aligen_centr box_h_3">Введите адрес сайта</h3>
						</div>
						<div class="col-con-box_form">
							<div class="box_form_input">
								<input id="domain" class="domain" type="text" required="" placeholder="Введите адрес сайта">
							</div>
							<div class="box_form_input">
								<input type="submit" value="Отправить">
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
</body>
</html>
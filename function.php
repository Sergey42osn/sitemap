<?php

    function getHome($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0" );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $res = curl_exec($ch);

        curl_close($ch);

        return $res;

    }


    function writeImage($html, $folder)
    {
        $images = $html->find('img');

        foreach($images as $k => $img){

            //echo $k.'<br>';
            $path_info = pathinfo($img->src);
            $name_img = $path_info['basename'];
            $path_img = $folder.'/'.$name_img;

            if (!file_exists($path_img)) {

                $ch = curl_init('https://tandyr.pro/'.$img->src);
                $fp = fopen($folder.'/'.$name_img, 'w');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                //curl_setopt($ch,CURLOPT_TIMEOUT,20);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $img = curl_exec($ch);
            
            }

        }

        return $img;

    }

    function writeHrefToFile($href, $file){

            //echo $href.'<br>';

           // $file = 'sitemap.txt';
            // Открываем файл для получения существующего содержимого
            $current = file_get_contents($file);
            // Добавляем нового человека в файл
            //$current .= "$href;$product_name;$price_prod\n";
            $current = "$href\n";
            // Пишем содержимое обратно в файл
            $res = file_put_contents($file, $current,FILE_APPEND);

            if ($res) {
                return true;
            }

    }

    function addHrefArray($href_f = '', $html, $domain, $domain_pars){

        $href_arr = [];

        $html = str_get_html($html);
        $a = $html->find("a");

        foreach ($a as $key => $value) {
            $href = $value->href;

            $path_info = parse_url($value->href);
            $scema = $path_info["scheme"];
            $host = $path_info["host"];
            
            if (strlen($href) >3) {
                if ($host == $domain_pars["host"] && $path_info["path"] != '') {                
                    if (strlen($path_info["path"]) > 2 ) {
                        //echo $path_info["path"].'<br>';
                        //$path = $href;
                        //$path = $href;
                        $path = $href;
                    }
                }elseif ($host == '') {
                    //echo $path_info["path"].'<br>';
                    if (strrpos($path_info["path"], '@') === false) {
                        if (strpos($path_info["path"], "..") === false) {
                            $path = $domain.$path_info["path"];
                        }
                    }
                }
                if (!in_array($path, $href_arr)) {
                    $href_arr[] = $path;
                }
            }
        }

        return $href_arr;
    }

    function getHrefs($file){

        $res = file($file);
       //href $count = count($res);
        //var_dump($res[$count - 1]);

        return $res;
    }

    function getHrefTmp($domain = ''){

        $file = 'tmp_sitemap.txt';
        $res = file($file);
        $count = count($res);

        //var_dump(count($res));

        if ($count < 1) {
            $href_f = $domain;
        }else{
            $href_f = $res[$count -1];
        }

         writeHrefToFile($href_f, 'tmp_sitemap.txt');

        return $href_f;
    }

    ?>
<?php
$data = date('Y-M-D');
echo $data;
$file = fopen('store.txt','a');
fwrite($file,$data."\r\n");
fclose($file);
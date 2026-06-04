<?php

require_once 'vendor/autoload.php';

$image = new \Libs\imagen\imageThumb();
var_dump($image);

$financiera = new \Libs\matematica\finaciera();
var_dump($financiera);

$crypt = new \Libs\seguridad\encriptacion();
var_dump($crypt);

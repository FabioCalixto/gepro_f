<?php
session_start();
ob_start();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('Africa/Luanda');

define('URL', 'http://localhost/Gepro/');
define('URLADM', 'http://localhost/Gepro/');

define('CONTROLER', 'Home');
define('METODO', 'index');

//Credenciais de acesso ao BD
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'gepro');

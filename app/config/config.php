<?php

date_default_timezone_set('America/Bogota');
setlocale(LC_MONETARY, 'es_CO');
error_reporting(E_ERROR);
ini_set('ignore_repeated_errors',FALSE);
ini_set('display_errors',TRUE);
ini_set('log_errors',TRUE);
ini_set('error_log','logs/general_log.txt');

define('URL', 'http://143.110.145.74/');
define('APP_NAME', 'Total Solution');
define('DB_ENGINE', 'mysql');
define('HOST', 'db');
define('DB', 'total_solution');
define('USER', 'root');
define('PASSWORD', 'Salo2022.');
define('CHARSET', 'utf8');

define('HOST_SMTP', 'smtp.gmail.com');
define('USER_SMTP', 'joansalomon@gmail.com');
define('PASS_SMTP', 'jksnextezrzzaiyf');
define('PORT_SMTP', 465);
define('SSL_SMTP', 'ssl');
define('MAIL_FROM', 'noreply@totalsolution.com.co')
?>

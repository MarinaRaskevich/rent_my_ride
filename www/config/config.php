<?php
define('DSN', 'mysql:host=database;dbname=rentmyride;charset=utf8');
define('USERNAME', 'root');
define('PASSWORD', 'example');

//REGEX
define('REGEX_MILEAGE', '^\d+$');
define('REGEX_REGISTRATION', '^[0-9A-Za-z-]{0,10}$');
define('MAX_SIZE', 2 * 1024 * 1024);

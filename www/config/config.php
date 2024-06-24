<?php
define('DSN', 'mysql:host=database;dbname=rentmyride;charset=utf8');
define('USERNAME', 'root');
define('PASSWORD', 'example');

//REGEX
define('REGEX_MILEAGE', '^\d+$');
define('REGEX_REGISTRATION', '^[0-9A-Za-z-]{0,10}$');
define('MAX_SIZE', 2 * 1024 * 1024);

define('REGEX_NAME', '^[a-zA-Z0-9 éèàêîôù\-]*$');
define('REGEX_PHONE', '^(?:\+33|0)[1-9](?:(?:\d{2}){4}|\d{8})$');
define('REGEX_ZIPCODE', '^\d{5}$');
define('REGEX_BIRTHDATE', '^(?:\d{4}-\d{2}-\d{2})$');

<?php
require_once "vendor/autoload.php";
require_once "app/functions.php";
require_once "app/cryptocurrency.php";

set_time_limit( 600 );

$pages = 14;
update( $pages );

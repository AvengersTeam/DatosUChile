<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
ini_set('display_startup_errors',1);
require( '../include/templateLib.php' );
require( '../include/func.php' );

session_start();

$PAR = array();
if( isset( $_REQUEST['r'] ) ) $PAR = preg_split( '/\//', trim( $_REQUEST['r'] ), -1, PREG_SPLIT_NO_EMPTY );  


<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
ini_set('display_startup_errors',1);
require( '../include/templateLib.php' );
require( '../include/func.php' );

session_start();

/* cosas iniciales aqui... como el tener variables "globales" */
$puede_ver = TRUE; //Ejemplo
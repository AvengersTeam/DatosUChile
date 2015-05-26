<?php
require( 'config.php' );
$cache = '../template/tmp/cache.data';
$posibles = file_exists( $cache ) ? unserialize( file_get_contents( $cache ) ) : array();;



include( template( '../template/head.html' ) );
include( template( '../template/index.html' ) );
include( template( '../template/foot.html' ) );

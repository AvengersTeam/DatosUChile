<?php
require( 'config.php' );
if ( ! $PAR || count( $PAR ) < 2 || count( $PAR ) > 4 ) {
  echo 'error con la url';
  exit;
}

/*$tipos = array(
  'expresion' => 'frbrer:C1002',
  'manifestacion' => 'frbrer:C1003',
  'obra' => 'frbrer:C1001',
  'nacimiento' => 'bio:Birth',
  'muerte' => 'bio:Death'

);*/

$t = $PAR[1];
$id = isset( $PAR[2] ) ? $PAR[2] : '';
$format = isset( $PAR[3] ) ? urlencode( $PAR[3] ) : 'text/html';
$url = "http://datos.uchile.cl/recurso/$t/$id";

$sparql = urlencode( "
select ?a ?b ?c 
where { 
  ?a ?b ?c .
  filter regex( str( ?a ), '$url' )
}    
" ); 

$peti = wget( "http://datos.uchile.cl:9090/sparql?query=$sparql&format=$format" );


include( template( '../template/head.html' ) );
include( template( '../template/recurso.html' ) );
include( template( '../template/foot.html' ) );



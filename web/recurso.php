<?php
require( 'config.php' );

$_recurso = array();
if( isset( $_REQUEST['r'] ) ) {
  $_recurso = preg_split( '/\//', trim( $_REQUEST['r'] ), -1, PREG_SPLIT_NO_EMPTY );
}

if ( ! $_recurso || count( $_recurso ) != 2 ) {
  echo 'error con la url';
  exit;
}

/*
$tipos = array(
  'expresion' => 'frbrer:C1002',
  'manifestacion' => 'frbrer:C1003',
  'obra' => 'frbrer:C1001',
  'nacimiento' => 'bio:Birth',
  'muerte' => 'bio:Death'
);
 */
$formatos = array_flip( array(
  'text/html',
  'application/sparql-results+json',
  'application/javascript',
  'text/turtle',
  'text/plain',
  'application/sparql-results+xml',
  'text/csv',
  'text/tab-separated-values',
  'application/rdf+xml',
  'application/json'
) );

$tipo = $_recurso[0];
$id = isset( $_recurso[1] ) ? $_recurso[1] : '';
$format = trim( (string)$_REQUEST['format'] );
$url = "http://datos.uchile.cl/recurso/$tipo/$id";

$sparql = urlencode( "select distinct ?a ?b ?c where { ?a ?b ?c . filter regex( str( ?a ), '$url' ) }" ); 

$url_sparql = "http://datos.uchile.cl/sparql?query=$sparql&format=".urlencode( ! isset( $formatos[$format] ) ? "application/sparql-results+json" : $format );
$res = wget( $url_sparql );

//Se debe checkear la existencia de resultado
if( isset( $formatos[$format] ) ) {
  header( 'Content-type: '.$format );
  echo $res;
  exit;
}

$res = json_decode( $res, TRUE );
$nombre = "";
foreach( $res['results']['bindings'] as $v ) {
  if( preg_match( '/(title|name)$/', $v['b']['value'] ) ) $nombre = $v['c']['value']; 
}

//print_a( strcmp( $id, "201-0092260" ) );exit;
if( strcmp( $id, "201-0092260" ) === 0 ) {
  $sp = urlencode( "
prefix frbrer: <http://iflastandards.info/ns/fr/frbr/frbrer/>
prefix dct: <http://purl.org/dc/terms/>

select distinct ?a ?b ?c where { 
  ?a ?b ?c . 
  ?a a frbrer:C1001 . 
  ?a dct:creator ?m .
  filter( regex( str( ?m ), 'http://datos.uchile.cl/recurso/autoridad/201-0092260' ) ) .
  filter( regex( str( ?b ), 'http://purl.org/dc/elements/1.1/title' ) )
} limit 10  
" );
  $url2 = "http://datos.uchile.cl/sparql?query=$sp&format=".urlencode( 'application/sparql-results+json' );
  $obras = json_decode( wget( $url2 ), TRUE );
}

$require_base = TRUE; //hack for relative urls
include( template( '../template/head.html' ) );
include( template( '../template/ficha.html' ) );
include( template( '../template/foot.html' ) );

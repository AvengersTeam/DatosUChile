<?php
require( 'config.php' );
header( 'content-type: application/json; charset=utf-8' );

$q = (string) $_REQUEST['q'];
if( ! $q ) {
  echo json_encode( array() );
  exit;
}

$wget = wget( 'localhost:9200/repo/autoridad,obra/_search?size=5&q='.urlencode($q) );
if( ! $wget ) {
  echo json_encode( array() );
  exit;
}

$req = json_decode( $wget, TRUE );
$hits = array_map( function($a){return $a['_source'];}, (array)$req['hits']['hits'] );
echo json_encode( $hits );
exit;

<?php
require( 'config.php' );

$tags = array(); $aux = array();
$xml_str = file_get_contents( 'lista.xml' );
$xml = simplexml_load_string( $xml_str );
$parser = xml_parser_create();
xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
xml_parse_into_struct($parser, $xml_str, $tags);
xml_parser_free($parser);
foreach( $tags as $tag ) if( isset( $tag['attributes'] ) ) $aux[$tag['value']] = $tag['attributes']['tag'].'-'.$tag['attributes']['label']; 

$datos = json_decode( json_encode( $xml ), 1 );
foreach( $datos['authority'] as $k => $v ) foreach( $v['entries'] as $n => $mac ) {
  if( is_array( $mac ) ) foreach( $mac as $nk => $dd ) { 
    $datos['authority'][$k]['entries'][$n][$aux[$dd]] = $dd;
    unset( $datos['authority'][$k]['entries'][$n][$nk] );
  }
}

$posibles = array();
$url = "http://viaf.org/viaf/search?query=local.names+all+%22";
$autoridades = $datos['authority'];
foreach( $autoridades as $v ) {
  if( ! isset( $v['entries']['marcEntry']['100-Personal name'] ) ) continue;
  $pn = $v['entries']['marcEntry']['100-Personal name'];
  $url_pn = $url.urlencode( $pn )."%22";
  $html = wget( $url_pn );
  if( ! $html ) continue;

  $dom = new DOMDocument;
  libxml_use_internal_errors( TRUE );
  $dom->loadHTML( $html );
  $xpath = new DOMXpath( $dom );
  libxml_clear_errors();
  libxml_use_internal_errors( FALSE );

  $tables = $xpath->query( '//div[@id="resultsList"]/table[@cellspacing="0"]' );
  if( ! $tables->length ) continue;
  $table = $tables->item( 0 );
  $trs = $xpath->query( './/tr', $table );

  foreach( $trs as $tr ) {
    $tdtype = $xpath->query( './/td[@class="type"][text()="Personal"]', $tr );
    if( $tdtype->length > 0 ) $posibles[$pn][] = $xpath->query( './/td[@class="recName"]/a', $tr )->item(0)->attributes->item(0)->nodeValue;
  } 
}


file_put_contents( "../template/tmp/cache.data", serialize( $posibles ) );

include( template( '../template/head.html' ) );
include( template( '../template/index.html' ) );
include( template( '../template/foot.html' ) );

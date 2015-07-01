<?php

function wget( $url, $post = array() ) {
  $sess = isset( $_SESSION );
  if( $sess ) session_write_close();

  $cookies = array( session_name().'='.session_id() );
  foreach( $_COOKIE as $k => $v ) $cookies[] = $k.'='.$v;

  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt( $ch, CURLOPT_TIMEOUT,        100 );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
  curl_setopt( $ch, CURLOPT_HEADER,         0 );
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0 );
  curl_setopt( $ch, CURLOPT_COOKIE, implode( '; ', $cookies ) );
  curl_setopt( $ch, CURLOPT_URL, $url );
  if( ! empty( $post ) ) curl_setopt( $ch, CURLOPT_POSTFIELDS, $post );
  $res = curl_exec( $ch );
  curl_close( $ch );
  if( $sess ) session_start();

  return $res;
}

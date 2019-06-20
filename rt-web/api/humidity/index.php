<?php
$_tstat = '10.0.4.156';
function get_tstat( $url = '/tstat' )
{
  global $_tstat;
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, 'http://' . $_tstat . $url );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  $data = curl_exec( $ch );
  curl_close( $ch );
  return $data;
}
echo get_tstat('/tstat/humidity');
?>

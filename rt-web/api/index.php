<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

function post_tstat( $postdata, $url = '/tstat' )
{
  global $_tstat;
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, 'http://' . $_tstat . $url );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

  // Set HTTP Header for POST request 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
          'Content-Length: ' . strlen($postdata))
          );

  $result = curl_exec( $ch );
  return $result;
}

if( !empty( $_GET ) )
{
  $send_tstat = array();
  if( isset( $_GET['t_cool'] ) )
  {
    $send_tstat['t_cool'] = (float) $_GET['t_cool'];
  }
  if( isset( $_GET['t_heat'] ) )
  {
    $send_tstat['t_heat'] = (float) $_GET['t_heat'];
  }
  if( isset( $_GET['tmode'] ) )
  {
    $send_tstat['tmode'] = (float) $_GET['tmode'];
  }
  $send_json_tstat = json_encode( $send_tstat );
  echo post_tstat( $send_json_tstat );
}
else
{
  echo get_tstat();
}
?>

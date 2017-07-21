<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\DB;

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('foo', function () {
          return 'Hello World';
});

$app->get('get-last-notification', function () {
  $notif = collect(DB::table('notifications')->get())->last();

  $arr["response_msg"] = "success";
  $arr["response_value"] = json_decode($notif->response);

  return response() -> json($arr, 200); // Status code here
});

$app->post('notif-handler-v2', function () {
  $data = file_get_contents('php://input');

  DB::table('notifications')->insert(
      ['response' => $data]
  );

  return response() -> json([
      'resp_msg' => 'success'
  ], 200); // Status code here
});

$app->post('notif-handler', function () {
  $data = file_get_contents('php://input');
  return $data;
});

$app->post('notif-handler-with-hosting', function () {
  $data = file_get_contents('php://input');
  $ch = curl_init("https://jsonblob.com/api/jsonBlob");

  $headers = array();
  $headers[] = 'Accept: application/json';
  $headers[] = 'Content-Type: application/json';

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data))
  );

  $result = curl_exec($ch);

  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $header = substr($result, 0, $header_size);
  $body = substr($result, $header_size);

  foreach (explode("\r\n", $header) as $hdr) {
    if (strpos($hdr, "Location") !== false && strpos($hdr, "jsonblob.com") !== false) {
      $url = explode(" ", $hdr);
      $resp["data"] = $url[1];
      break;
    }
  }

  return json_encode($resp, JSON_PRETTY_PRINT);
});

<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class FirebaseController extends BaseController
{
    public function sendByToken($id, Request $request) {
        $fields = array(
            'to' => $id,
            'notification' => $request->all()
        );
        return response()->json([
            'success' => true,
            'message' => 'Sent successfully',
            'data' => $this->sendPushNotification($fields)
        ]);
    }

    public function sendByTopic($id, Request $request) {
        $fields = array(
            'to' => '/topics/' . $id,
            'notification' => $request->all()
        );
        return response()->json([
            'success' => true,
            'message' => 'Sent successfully',
            'data' => $this->sendPushNotification($fields)
        ]);
    }
    
    private function sendPushNotification($fields) {
        define('FIREBASE_API_KEY', 'AAAA8NVNMVI:APA91bHhGMZWLr7VYqOspzmTa7RJLc8jxJ1xjC-22G0FS26QFhlmgohAKQxWHJvTtDR9Rr2iIhLOl5iMp2S97PFuLDRJdrspy1yF1Ymp7_vdxnkautrxyim14v7_-7rFDDINpHmzJqef');
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($result);
    }

    private function sendMessage() {
        $url = 'https://fcm.googleapis.com/v1/projects/myproject-b5ae1/messages:send';
    }

    /*function sendPushNotification($fields = array())
{
    $API_ACCESS_KEY = 'Your API Key';
    $headers = array
    (
        'Authorization: key=' . $API_ACCESS_KEY,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );
    echo $result;
}

$title = "Test";
$message = "Hello World";

$fields = array
(
    'to'  => '/topics/Your topic name',
    'priority' => 'high',
    'notification' => array(
        'body' => $message,
        'title' => $title,
        'sound' => 'default',
        'icon' => '',
       	'image'=> ''
    ),
    'data' => array(
        'message' => $message,
        'title' => $title,
        'sound' => 'default',
        'icon' => '',
        'image'=> ''
    )


);

sendPushNotification($fields);*/
}
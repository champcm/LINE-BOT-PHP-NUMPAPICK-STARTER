 <?php
  

function send_LINE($events){
 // Access Token
$access_token = 'fbNQQPSnAfS5iQULfs24gc/CJ+nK4J0TKkA1GQERH5IwJJyn5H0Uu3SgxVLq1iXQmWyo8SSPmSoKDqjeMcLNjsQOQ92YDXAOTeUbLuIQSDXGPGPqK81gciMzQu1YaCDBzgQJeekTtwhO2XPONmsGvQdB04t89/1O/w1cDnyilFU=';
// แปลงเป็น JSON
     $messages = [
        'type' => 'text',
        'text' => $msg
        //'text' => $text
      ];

      // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/push';
      $data = [

        'to' => 'Uae59140384d613ef352fcb2cab626f08',
        'messages' => [$messages],
      ];
      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n"; 
}

?>

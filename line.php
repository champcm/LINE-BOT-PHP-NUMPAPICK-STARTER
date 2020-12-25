 <?php
  

function send_LINE($content){
 $access_token = 'qLip9omRdSnsaKFlsWmCCx9pdvAcRd1CGb6XfH/K3aKVgmHS4Eh/a35I8S1q8XVCZQVJUVIPa2B/c1ZJHfEyA8vUgqlUeIfqTkw607IKQ7yCasUHW34wj+CGzB6bOafYNDSGkh87GIr+Tns7fqFqVAdB04t89/1O/w1cDnyilFU='; 
// รับค่าที่ส่งมา

 // แปลงเป็น JSON
 $events = json_decode($content, true);
 if (!empty($events['events'])) {
    foreach ($events['events'] as $event) {
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // ข้อความที่ส่งกลับ มาจาก ข้อความที่ส่งมา
            // ร่วมกับ USER ID ของไลน์ที่เราต้องการใช้ในการตอบกลับ
            $messages = array(
                'type' => 'text',
                'text' => 'Reply message : '.$event['message']['text']."\nUser ID : ".$event['source']['userId'],
            );
            $post = json_encode(array(
                'replyToken' => $event['replyToken'],
                'messages' => array($messages),
            ));
            // URL ของบริการ Replies สำหรับการตอบกลับด้วยข้อความอัตโนมัติ
            $url = 'https://api.line.me/v2/bot/message/reply';
            $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result;
        }
    }
 }
}

?>

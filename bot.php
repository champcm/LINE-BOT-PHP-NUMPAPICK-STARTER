<?php
 require("pub.php");
 require("line.php");

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON

$events = json_decode($content, true);
// Validate parsed JSON data
if (isset($events['ESP']))
{
	send_LINE($events['ESP']);
}
else if (isset($events['events'])) {
	echo "line bot";
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			// Get text sent
			$text = $event['message']['text'] . '|' . $replyToken;


			// Build message to reply back

			$Topic = "NodeMCU1" ;
			getMqttfromlineMsg($Topic,$text);
			   
			
		}
	}
}
echo "OK3";
?>

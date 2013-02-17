<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
    
    
    $stturl = "https://www.google.com/speech-api/v1/recognize?client=chromium&lang=en-US";

$filename = $_GET['id'] . ".flac";
$upload = file_get_contents($filename);
$data = array(
              "Content_Type"  =>  "audio/x-flac; rate=16000; charset=ISO-8859-1",
              "Content"       =>  $upload);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $stturl);
curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type: audio/x-flac; rate=16000; charset=iso-8859-1"));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
ob_start();
curl_exec($ch);
curl_close($ch);
$contents = ob_get_contents();
ob_end_clean();
$textarray = (json_decode($contents,true));
$text = $textarray['hypotheses']['0']['utterance'];
echo $text;
if(!is_null($text)){
            $iso88591_1 = utf8_decode($text);
            $iso88591_2 = iconv('UTF-8', 'ISO-8859-1', $text);
            $text = mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');       
     }
    
    
    file_put_contents($_GET['id'] . ".txt", $text);
    
    
?>
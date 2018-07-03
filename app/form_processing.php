<?php
//****************************************
//edit here
$senderName = 'nadine-kezev-haghoof-2';
$senderEmail = $_SERVER['SERVER_NAME'];
$targetEmail = [];
$targetEmail = ['office@gofmans.co.il', 'ravit@gofmans.co.il', 'eli@gofmans.co.il', 'alemesh@acceptic.com', 'bommer@netvision.net.il'];
//$targetEmail = ['alemesh@acceptic.com'];
$messageSubject = 'Message from web-site - '. $_SERVER['SERVER_NAME'];
$redirectToReferer = true;
$redirectURL = $_SERVER['SERVER_NAME'];
//****************************************

// mail content

//var_dump($_POST); die;
$ufname = $_POST['name'];
$uphone = $_POST['tel'];
$umail = $_POST['email'];
$sources = $_POST['sources-3'];
$description = $_POST['description'];





// prepare message text
$messageText =	'Name: '.$ufname."\n".
    'Phone: '.$uphone."\n".
    'Email: '.$umail."\n".
    'Description: '.$description."\n".
    'Branch: '.$sources."\n";


// send email
$senderName = "=?UTF-8?B?" . base64_encode($senderName) . "?=";
$messageSubject = "=?UTF-8?B?" . base64_encode($messageSubject) . "?=";
$messageHeaders = "From: " . $senderName . " <" . $senderEmail . ">\r\n"
    . "MIME-Version: 1.0" . "\r\n"
    . "Content-type: text/plain; charset=UTF-8" . "\r\n";

//if (preg_match('/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/',$targetEmail,$matches))
foreach ($targetEmail as $val){
    mail($val, $messageSubject, $messageText, $messageHeaders);
}


//========== xml backups lids ================

$today = date("F j, Y, g:i a");

$file = 'sample.csv';
$tofile = "$ufname;$uphone;$umail;$sources;$description;$today\n";
$bom = "\xEF\xBB\xBF";
@file_put_contents($file, $bom . $tofile . file_get_contents($file));


//$redirectToTnxPage = 'http://campaign.gofmans.co.il/nadine-kezev-haghoof-2/thanks-page.html?Lead=true';
$redirectToTnxPage = '/thanks-page.html?Lead=true';
//$redirectToTnxPage = 'http://192.168.89.147/thanks-page.html?Lead=true';
// redirect
if($redirectToReferer) {
    header("Location: ".$redirectToTnxPage);
} else {
    header("Location: ".$redirectURL);
}


<?php
require_once "_inc/_page.php";

if (isset($_POST['name'])){

    include("Mail.php"); 

    $recipients = "c@rpediem.com"; 

    $headers["From"]    = "info@aquatron.co.uk"; 
    $headers["To"]      = $recipients; 
    $headers["Subject"] = "New email enquiry from website"; 

    $body = "The following enquiry has come in from the website:\n\n";
    $body .= 'Name: ' . $_POST['name'] . "\n";
    $body .= 'Email: ' . $_POST['email'] . "\n";
    $body .= 'Phone number: ' . $_POST['phone'] . "\n";
    $body .= "Query: \n" . $_POST['query'] . "\n";


    $params["host"] = "smtp.gmail.com"; 
    $params["port"] = "25"; 
    $params["auth"] = true; 
    $params["username"] = "c@rpediem.com"; 
    $params["password"] = "LIeow75qt"; 

    // Create the mail object using the Mail::factory method 
    $mail_object =& Mail::factory("smtp", $params); 

    $mail_object->send($recipients, $headers, $body); 
}

$text = new Text();
$text->loadByType('seo', 'contact');

$page->assign("headline", $text->getHeadline());
$page->assign("text", $text->getContent());

$page->display('contact.tpl');
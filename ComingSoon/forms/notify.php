<?php

// Set the recipient email address
$receiving_email_address = 'cristian@bytek.co.uk';

// Check if the PHP Email Form library file exists
if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include($php_email_form);
} else {
    // Consider logging this error and providing a user-friendly response
    exit('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;
$contact->to = $receiving_email_address;
$contact->from_name = "Subscriber";
$contact->subject = "Notify me request";

// Check if 'email' is set and validate the email format
if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $contact->from_email = $_POST['email'];
    $contact->add_message($_POST['email'], 'Email');
} else {
    // Consider logging this error and providing a user-friendly response
    exit('Error: Invalid or missing email field.');
}

// Uncomment and configure the following section if you want to use SMTP
/*
$contact->smtp = array(
    'host' => 'your.smtp.host.com',
    'username' => 'your_smtp_username',
    'password' => 'your_smtp_password',
    'port' => '587'
);
*/

// Send the email and echo the result
$result = $contact->send();

// Check the result and provide feedback
if($result) {
    echo "Your notification request has been sent successfully!";
} else {
    // Consider logging this error and providing a user-friendly response
    echo "There was an error sending your notification request. Please try again later.";
}



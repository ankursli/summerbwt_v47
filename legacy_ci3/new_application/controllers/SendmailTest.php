<?php
require 'vendor/autoload.php';

use SendGrid\Mail\To;
use SendGrid\Mail\From;
use SendGrid\Mail\Content;
use SendGrid\Mail\Attachment;
use SendGrid\Mail\Mail;

defined('BASEPATH') OR exit('No direct script access allowed');

class SendmailTest extends CI_Controller {

  public function index()
	 {
	    $email = new \SendGrid\Mail\Mail(); 
		$email->setFrom("pinak.tecksky@gmail.com", "Example User");
		$email->setSubject("Sending mail with SendGrid");
		$email->addTo("dev3.ts3@gmail.com", "Example User");
		$email->addContent("text/plain","Sending test message from Sendmail");
		
    	$content = new Content("text/html", "<html><body>some text here</body></html>");
    	$email->addContent($content);
    	/*$attachment = new Attachment();
    	$attachment->setType("application/pdf");
    	$attachment->setFilename("test.pdf");
    	$attachment->setDisposition("attachment");
    	$attachment->setContentId("Coupon");
    	$email->addAttachment($attachment);*/

		$sendgrid = new \SendGrid('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');
		try {
		    $response = $sendgrid->send($email);
		    print $response->statusCode() . "\n";
		    print_r($response->headers());
		    print $response->body() . "\n";
		} catch (Exception $e) {
		    echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	 }
}
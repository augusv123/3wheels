<?php

/**
 * Versión compatible con PHP 4
 * @author Daniel Wyrytowski <dandanielw@gmail.com>
 *
 */
class Mail
{
	var $from; 
	var $recipients = array (); 
	var $subject 	= ''; 
	var $message 	= '';
	var $reply_to ; 
	var $cc 		= array(); 
	var $bcc 		= array () ; 

	function Mail($from = null, $to = null, $subject = null, $message = null)
	{
		if ( ! empty($to) ) 	 $this->addRecipients($to); 

		if ( ! empty($from) ) 	 $this->from 	= $from;
		if ( ! empty($subject) ) $this->subject = $subject;
		if ( ! empty($message) ) $this->message = $message;
	}

	function addRecipients($to)
	{
		if ( is_array($to)) 
		{ 
			$recipients = $to; 
		} else if ( ! empty($to)) { 
			$recipients = explode(",", $to);
		}

		foreach ($recipients as $recipient) 
		{
			$this->addRecipient(trim($recipient));
		}
	}

	function addRecipient($email)
	{
		$this->recipients[] = $email; 
	}
	
	function addCc($email)
	{
		$this->cc[] = $email; 
	}

	function addBcc($email)
	{
		$this->bcc[] = $email; 
	}

	function setFrom($from)
	{
		$this->from = $from;
	}

	function setReplyTo($reply_to)
	{
		$this->reply_to = $reply_to;
	}

	function setSubject($subject)
	{
		$this->subject = $subject;
	}

	function setMessage($message)
	{
		$this->message = $message;
	}

	function setUpHeaders()
	{
		if ( ! empty($this->cc)) 		$cc 	= implode(',', $this->cc );
		if ( ! empty($this->bcc)) 		$bcc 	= implode(',', $this->bcc);
		if (   empty($this->reply_to)) 	$this->reply_to = $this->from;

		$headers 						 = "From: " . $this->from . "\r\n";
		$headers 						.= "Reply-To: " . $this->reply_to . "\r\n";
		if ( isset($cc) ) 	$headers 	.= "CC: $cc\r\n";
		if ( isset($bcc) ) 	$headers 	.= "BCC: $bcc\r\n";
		$headers 						.= "MIME-Version: 1.0\r\n";
		$headers 						.= "Content-Type: text/html; charset=UTF-8\r\n";
		
		return $headers; 
	}

	function send()
	{
		$to 		= implode(',', $this->recipients);
		$subject 	= $this->subject;
		$message 	= $this->message; 
 		$header 	= $this->setUpHeaders();

 		return mail($to, $subject, $message, $header);
	}
}
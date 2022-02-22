<?php 
	/* 
	 * PayPal and database configuration 
	 */ 
	  
	// PayPal configuration 
	define('PAYPAL_ID', 'sb-xlrgz1624806@business.example.com'); 
	define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
	 
	define('PAYPAL_RETURN_URL', 'https://peekchat.live/success.php'); 
	define('PAYPAL_CANCEL_URL', 'https://peekchat.live/cancel.php'); 
	define('PAYPAL_NOTIFY_URL', 'https://peekchat.live/ipn.php'); 
	define('PAYPAL_CURRENCY', 'USD'); 
	 
	// Database configuration 
	define('DB_HOST', 'localhost'); 
	define('DB_USERNAME', 'peek'); 
	define('DB_PASSWORD', 'Peekdb@786#'); 
	define('DB_NAME', 'peekchat_live'); 
	 
	// Change not required 
	define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
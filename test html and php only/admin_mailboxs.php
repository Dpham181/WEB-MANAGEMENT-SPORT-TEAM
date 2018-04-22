
<?php
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'servicebasketballmanagement@gmail.com';
$password = 'Danh2610';

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox,'ALL');

/* if emails are returned, cycle through each... */
if($emails) {

	/* begin output var */
	$output1 = '';
  $output2 = '';
  $output3 = '';
  $output4 = '';

	/* put the newest emails on top */
	rsort($emails);

	/* for every email... */
	foreach($emails as $email_number) {

		/* get information specific to this email */
		$overview = imap_fetch_overview($inbox,$email_number,0);
		$message = imap_fetchbody($inbox,$email_number,2);

		/* output the email header information */
		$output1.= $overview[0]->subject;
		$output2.= $overview[0]->from;
		$output3.= $overview[0]->date;
    $output4.= $message;
		/* output the email body */
	}

  echo "<tr>\n";
  echo "<td>".$output1."</td>\n";
  echo "<td>".$output2."</td>\n";
  echo "<td>".$output3."</td>\n";
  echo "<td>".$output4."</td>\n";
}

/* close the connection */
imap_close($inbox);


?>

<?php
header("Access-Control-Allow-Origin: *");
require('mailer/class.phpmailer.php');
require 'codeguy-Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
use \Slim\Slim AS Slim;

// create new Slim instance
$app = new Slim();


$app->get("/f2", function () {
    echo "<h1>f2 azsys service</h1>";
});

$app->post('/registerConfirmation',
function () use ($app) {
   try{
   $request = $app->request();
   $registerDetails = json_decode($request->getBody());
  
   $emailId = $registerDetails->emailId;
   $userName = $registerDetails->userName;
   $password = $registerDetails->password;
  

$message = "<div >Welcome ".$userName.", you are successfully registered. <br><br>Below are your login details : <br><br><b>Email : </b>".$emailId."<br><b>Password : </b>".$password." <br><br><a href='www.zfz.arizonasys.com'>www.zfz.arizonasys.com</a>
 <br><br>Thank you,<br> Team ZestyFlavourZ.</div>";
//echo $message;
   try {
   $mail = new PHPMailer();
      $mail->IsSMTP();
	  $mail->SMTPAuth = true;
	  $mail->SMTPSecure = 'ssl';
	  //$mail->SMTPDebug = 1;
	  $mail->Host = 'smtp.gmail.com';
	  $mail->Port       = 465;
	  $mail->Username = 'arizonasystem@gmail.com';
	  $mail->Password = 'digamber007';
	
	  $mail->SetFrom('noreply@zestyflavourz.com', 'ZestyFlavourZ Team');
	  $mail->AddAddress($emailId, $userName);

	  $mail->Subject = 'ZestyFlavourZ';
	  $mail->Body    = $message;
	  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	  if(!$mail->Send())
	  {
	  //   echo 'Message could not be sent. <p>';
	  //   echo 'Mailer Error: ' . $mail->ErrorInfo;
	     exit;
	  }

	  //echo 'Message has been sent';

	  echo true;

   } catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});


$app->post('/contactus',
function () use ($app) {
   try{
   $request = $app->request();
   $queryDetails = json_decode($request->getBody());
   $uname = $queryDetails->name;
   $email = $queryDetails->email;
   $phone = $queryDetails->phone ;
   $timeToContact = $queryDetails->timeToContact;
   $contactWay = $queryDetails->contactWay;
   $query = $queryDetails->query;

$message = "<div style='border:2px solid green'><b>Name :</b> ".$uname." <br><b>Phone : </b>".$phone." <br><b>Email : </b>".$email."
 <br><b>Best way to contact : </b>".$contactWay. "<br><b>Best time to contact : </b>".$timeToContact." 
 <br><b>Message : </b>".$query."</div>";
//echo $message;
   try {
   $mail = new PHPMailer();
      $mail->IsSMTP();
	  $mail->SMTPAuth = true;
	  $mail->SMTPSecure = 'ssl';
	  //$mail->SMTPDebug = 1;
	  $mail->Host = 'smtp.gmail.com';
	  $mail->Port       = 465;
	  $mail->Username = 'arizonasystem@gmail.com';
	  $mail->Password = 'digamber007';
	
	  $mail->SetFrom($email, $uname);
	  $mail->AddReplyTo($email, 'Reply to ');

	  //$mail->AddAddress('daneshmehta30@gmail.com', 'Danesh');
	 // $mail->AddAddress('itsdiggu@gmail.com', 'Digamber');
	 // $mail->AddAddress('alishapatel2006@gmail.com', 'Alisha');
	  $mail->AddAddress('laaptulaaptu1@gmail.com', 'Laaptu');

	  $mail->Subject = 'Query from ZFZ raised by : '.$uname;
	  $mail->Body    = $message;
	  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	  if(!$mail->Send())
	  {
	  //   echo 'Message could not be sent. <p>';
	  //   echo 'Mailer Error: ' . $mail->ErrorInfo;
	     exit;
	  }

	  //echo 'Message has been sent';

	  echo true;

   } catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

// run the Slim app
	  $app->run();

?>

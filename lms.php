<?php
include 'db.php';
require 'codeguy-Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
use \Slim\Slim AS Slim;
// create new Slim instance
$app = new Slim();

$app->get("/f2", function () {
    echo "<h1>f2 lms service alisha</h1>";
});
$app->get('/f3/:name', function ($name) {
    echo "Hello, $name";
});

$app->post('/logout',
function () use ($app) {
   try{

   $request = $app->request();
   $userIdObj = json_decode($request->getBody());
   $userId = $userIdObj->userId;
   
   try {

      unset($_SESSION['SESSION_KEY']);

   } catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/myordersnew',
function () use ($app) {
   try{

   $request = $app->request();
   $userIdObj = json_decode($request->getBody());
   $userId = $userIdObj->userId;
   $emailId = $userIdObj->emailId;
   $sessionKey = $userIdObj->sessionKey;
   session_start();
	   if($_SESSION[$emailId] == $sessionKey){
			   try {

				  $result = null;

					$sql = "SELECT * FROM ordertablenew WHERE userId = '$userId' ORDER BY orderdate DESC";

					$db = getDB();
					$stmt = $db->prepare($sql);
					$stmt->execute();
					 $ordersFetched = $stmt->fetchAll();
					 $db = null;
					 $result = null;
					 $result = '{"resultObj":{"ordersFetched":'.json_encode($ordersFetched).',"status":"SUCCESS"}}';

				  echo $result;
				  
			   } catch(PDOException $e) {
				  //error_log($e->getMessage(), 3, '/var/tmp/php.log');
				  echo '{"error":{"text":'. $e->getMessage() .'}}';
			   }
	   }
	   else {
			echo '{"error":{"text":"Invalid Session"}}';
	   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/fetchOrderDetail',
function () use ($app) {
   try{

   $request = $app->request();
   $userIdObj = json_decode($request->getBody());
   $userId = $userIdObj->userId;
   $emailId = $userIdObj->emailId;
   $sessionKey = $userIdObj->sessionKey;
   $orderid = $userIdObj->orderid;
   session_start();
	   if($_SESSION[$emailId] == $sessionKey){
			   try {

				  $result = null;

					$sql = "SELECT * FROM orderdetailstable ord, ordertablenew otn WHERE otn.userid = '$userId' and otn.orderid = '$orderid' and otn.orderid = ord.orderid";

					$db = getDB();
					$stmt = $db->prepare($sql);
					$stmt->execute();
					 $ordersFetched = $stmt->fetchAll();
					 $db = null;
					 $result = null;
					 $result = '{"resultObj":{"orderDetail":'.json_encode($ordersFetched).',"status":"SUCCESS"}}';

				  echo $result;
				  
			   } catch(PDOException $e) {
				  //error_log($e->getMessage(), 3, '/var/tmp/php.log');
				  echo '{"error":{"text":'. $e->getMessage() .'}}';
			   }
	   }
	   else {
			echo '{"error":{"text":"Invalid Session"}}';
	   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/myorders',
function () use ($app) {
   try{

   $request = $app->request();
   $userIdObj = json_decode($request->getBody());
   $userId = $userIdObj->userId;
   $emailId = $userIdObj->emailId;
   $sessionKey = $userIdObj->sessionKey;
   session_start();
	   if($_SESSION[$emailId] == $sessionKey){
			   try {

				  $result = null;

					$sql = "SELECT * FROM ordertable WHERE userId = '$userId' ORDER BY orderDateTime DESC";

					$db = getDB();
					$stmt = $db->prepare($sql);
					$stmt->execute();
					 $ordersFetched = $stmt->fetchAll();
					 $db = null;
					 $result = null;
					 $result = '{"resultObj":{"ordersFetched":'.json_encode($ordersFetched).',"status":"SUCCESS"}}';

				  echo $result;
				  
			   } catch(PDOException $e) {
				  //error_log($e->getMessage(), 3, '/var/tmp/php.log');
				  echo '{"error":{"text":'. $e->getMessage() .'}}';
			   }
	   }
	   else {
			echo '{"error":{"text":"Invalid Session"}}';
	   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/fetchMenusForUpdate',
function () use ($app) {
   try{

   $request = $app->request();
   $userIdObj = json_decode($request->getBody());
   $userId = $userIdObj->userId;
   $emailId = $userIdObj->emailId;
   $sessionKey = $userIdObj->sessionKey;
   session_start();
	   if($_SESSION[$emailId] == $sessionKey){
			   try {

				  $result = null;

					$sql = "SELECT * FROM menutable WHERE userId = '$userId'";

					$db = getDB();
					$stmt = $db->prepare($sql);
					$stmt->execute();
					 $menuFetched = $stmt->fetchAll();
					 $db = null;
					 $result = null;
					 $result = '{"resultObj":{"menuFetched":'.json_encode($menuFetched).',"status":"SUCCESS"}}';

				  echo $result;
				  
			   } catch(PDOException $e) {
				  //error_log($e->getMessage(), 3, '/var/tmp/php.log');
				  echo '{"error":{"text":'. $e->getMessage() .'}}';
			   }
	   }
	   else {
			echo '{"error":{"text":"Invalid Session"}}';
	   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/fetchOrdersForUpdate',
function () use ($app) {
   try{

   $request = $app->request();
   $userIdObj = json_decode($request->getBody());
   $userId = $userIdObj->userId;
   $emailId = $userIdObj->emailId;
   $sessionKey = $userIdObj->sessionKey;
   session_start();
	   if($_SESSION[$emailId] == $sessionKey){
			   try {

				  $result = null;

					$sql = "SELECT * FROM `ordertablenew` as otn,`orderdetailstable` as odt WHERE otn.orderid = odt.orderid and odt.provideremailid = '$emailId' ORDER BY otn.orderdate DESC";

					$db = getDB();
					$stmt = $db->prepare($sql);
					$stmt->execute();
					 $menuFetched = $stmt->fetchAll();
					 $db = null;
					 $result = null;
					 $result = '{"resultObj":{"ordersFetched":'.json_encode($menuFetched).',"status":"SUCCESS"}}';

				  echo $result;
				  
			   } catch(PDOException $e) {
				  //error_log($e->getMessage(), 3, '/var/tmp/php.log');
				  echo '{"error":{"text":'. $e->getMessage() .'}}';
			   }
	   }
	   else {
			echo '{"error":{"text":"Invalid Session"}}';
	   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/menus',
function () use ($app) {
   try{

   try {

      $result = null;

      	$sql = "SELECT mt.imageUrl as imageUrl, mt.imgUrlTomorrow as imgUrlTomorrow,mt.todayMenu as todayMenu,mt.tomorrowMenu as tomorrowMenu,mt.todayMenuUnitPrice as todayMenuUnitPrice,
		mt.tomorrowMenuUnitPrice as tomorrowMenuUnitPrice,ut.userName as userName, ut.emailId as emailId, ut.mobileNo as mobileNo
		FROM menutable mt, usertable ut WHERE mt.userId = ut.userId and ut.provider = 'YES' ORDER BY menuAddDate DESC";
      	$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->execute();
		 $menuFetched = $stmt->fetchAll();
		 $db = null;
         $result = null;
         $result = '{"resultObj":{"menuObj":'.json_encode($menuFetched).',"status":"SUCCESS"}}';

      echo $result;
	  
   } catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/addUpdateMenu',
function () use ($app) {
   try{
   $request = $app->request();
   $addUpdateMenu = json_decode($request->getBody());
   $userId = $addUpdateMenu->userId;
   $updatedMenu = $addUpdateMenu->updatedMenu;
   
   try {
      $db = getDB();
	  
	  $sql = "SELECT * FROM menutable WHERE userId='$userId'";
	  
	  $stmt = $db->prepare($sql);
      $stmt->execute();
   
     $stmt->execute();
     $userFetch = $stmt->fetchObject();
	  
	  if($userFetch == null){
		  $sql = "INSERT INTO menutable (`todayMenu`,`tomorrowMenu`,`todayMenuUnitPrice`,`tomorrowMenuUnitPrice`,`menuAddDate`,`userId`,`imageUrl`,`imgUrlTomorrow`)
			VALUES 
			('$updatedMenu->todayMenu','$updatedMenu->tomorrowMenu','$updatedMenu->todayMenuUnitPrice',
			'$updatedMenu->tomorrowMenuUnitPrice',NOW(),'$userId','$updatedMenu->imageUrl','$updatedMenu->imgUrlTomorrow')";
		  $stmt = $db->prepare($sql);
		  $res = $stmt->execute();

		  if ($res !=0 ) {
			 $result = '{"resultObj":{"menuAddUpdateObj":"Added","status":"SUCCESS"}}';
		  }else{
			 $result = "FAILURE";
		  }
	  }else{
	  
		if($updatedMenu->todayMenu != null && $updatedMenu->todayMenu != null ){
			$sql = "UPDATE menutable SET `todayMenu` = '$updatedMenu->todayMenu',
										 `tomorrowMenu` = '$updatedMenu->tomorrowMenu',
										 `imageUrl` = '$updatedMenu->imageUrl',
										 `imgUrlTomorrow` = '$updatedMenu->imgUrlTomorrow',
										 `todayMenuUnitPrice` = '$updatedMenu->todayMenuUnitPrice',
										 `tomorrowMenuUnitPrice` = '$updatedMenu->tomorrowMenuUnitPrice',
										 `menuAddDate` = NOW() WHERE `userId` = '$userId'";
										 
		  $stmt = $db->prepare($sql);
		  $res = $stmt->execute();

		  if ($res !=0 ) {
			 $result = '{"resultObj":{"menuAddUpdateObj":"Updated","status":"SUCCESS"}}';
		  }else{
			 $result = "FAILURE";
		  }
		}
		else {
			$sql = "DELETE FROM menutable WHERE `userId` = '$userId'";
		  $stmt = $db->prepare($sql);
		  $res = $stmt->execute();

		  if ($res !=0 ) {
			 $result = '{"resultObj":{"menuAddUpdateObj":"Deleted","status":"SUCCESS"}}';
		  }else{
			 $result = "FAILURE";
		  }
		}
		  
			
	  }
      $db = null;
     
      echo $result;
   } catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
   
});

$app->post('/confirmorder',
function () use ($app) {
   try{
   $request = $app->request();
   $order = json_decode($request->getBody());
   $address = $order->address;
   $userInfo = $order->userInfo;
   $items = $order->items;
   
   $totalAmount = $order->totalAmount;
   
   session_start();
	   if($_SESSION[$userInfo->emailId] == $userInfo->sessionKey){
	   
		  $deliveryAddress = 'Name - '.$address->name.', Email - '.$address->email.', Phone - '.$address->mobile.', Address Line 1 - '.$address->addLine1.', Address Line 2 - '.$address->addLine2.', City - '.$address->city.', State - '.$address->state.', Pin - '.$address->pin.', Country - '.$address->country;
		  
		  $userid = $userInfo->userId;
		  
		  $sql = "INSERT INTO ordertablenew (`orderdate`,`totalorderprice`,`userid`,`address`,`orderstatus`)
		   VALUES (NOW(),'$totalAmount','$userid','$deliveryAddress','In progress')";
		  
		  $db = getDB();
			  $stmt = $db->prepare($sql);
			  $res = $stmt->execute();
			  $result = null;
			  if ($res !=0 ) {
				$sql = "select MAX(orderId) as orderID from ordertablenew";
				$stmt = $db->prepare($sql);
				$stmt->execute();
				$orderId = $stmt->fetchObject(); 
				$propertiesorderId = get_object_vars($orderId);
				$actualOrderId = $propertiesorderId['orderID'];
				for ($x = 0; $x < sizeof($items); $x++) {
					$item = $items[$x];
					
					$properties = get_object_vars($item);
					$todaysLunchOption = $properties['todaysLunchOption'];
					$tomorrowsLunchOption = $properties['tomorrowsLunchOption'];
					
					$todaysMenu = "NA";
					$selectedQtyTodays = 0;
					$totalPriceToday = 0.0;
					$todayMenuComment = "NA";
					
					$tomorrowsMenu = "NA";
					$selectedQtyTomorrows = 0;
					$totalPriceTomorrow = 0.0;
					$tomorrowMenuComment = "NA";
					
					if($todaysLunchOption == "YES" && $tomorrowsLunchOption == "YES"){
					
					   $selectedQtyTodays = $properties['selectedQtyTodays'];
					   $totalPriceToday = $properties['totalPriceToday'];
					   $todaysLunchOption = $properties['todaysLunchOption'];
					   $todayMenuComment = $properties['todayMenuComment'];
					   $todaysMenu = $properties['todayMenu'];
					   
					   $totalPriceTomorrow = $properties['totalPriceTomorrow'];
					   $selectedQtyTomorrows = $properties['selectedQtyTomorrows'];
					   $tomorrowsLunchOption = $properties['tomorrowsLunchOption'];  
					   $tomorrowMenuComment = $properties['tomorrowMenuComment']; 
					   $tomorrowsMenu = $properties['tomorrowMenu'];
					   
					   $providerEmailId = $properties['providerEmailId'];
					   $providerMobileNo = $properties['providerMobileNo'];
					   $providerName = $properties['providerName'];
					   
					}elseif($todaysLunchOption == "YES" && $tomorrowsLunchOption == "NO"){
					
					   $selectedQtyTodays = $properties['selectedQtyTodays'];
					   $totalPriceToday = $properties['totalPriceToday'];
					   $todaysLunchOption = $properties['todaysLunchOption'];
					   $todayMenuComment = $properties['todayMenuComment'];
					   $todaysMenu = $properties['todayMenu'];
					   
					   $providerEmailId = $properties['providerEmailId'];
					   $providerMobileNo = $properties['providerMobileNo'];
					   $providerName = $properties['providerName'];
					   
					}elseif($todaysLunchOption == "NO" && $tomorrowsLunchOption == "YES") {
					   $totalPriceTomorrow = $properties['totalPriceTomorrow'];
					   $selectedQtyTomorrows = $properties['selectedQtyTomorrows'];
					   $tomorrowsLunchOption = $properties['tomorrowsLunchOption'];  
					   $tomorrowMenuComment = $properties['tomorrowMenuComment']; 
					   $tomorrowsMenu = $properties['tomorrowMenu'];
					   
					   $providerEmailId = $properties['providerEmailId'];
					   $providerMobileNo = $properties['providerMobileNo'];
					   $providerName = $properties['providerName'];
					}
					$sql = "INSERT INTO orderdetailstable (`orderid`,`todaysmenu`,`todaysqty`,`todaystotal`,`todayscomment`,
							`tomorrowsmenu`,`tomorrowsqty`,`tomorrowstotal`,`tomorrowscomment`,`provideremailid`,
							`providerphone`,`providername`,`orderstatus`)
						VALUES ('$actualOrderId','$todaysMenu','$selectedQtyTodays','$totalPriceToday','$todayMenuComment',
							'$tomorrowsMenu','$selectedQtyTomorrows','$totalPriceTomorrow','$tomorrowMenuComment','$providerEmailId','$providerMobileNo','$providerName','In progress')";
							
					$stmt = $db->prepare($sql);
					$stmt->execute();
				  }
				
				 $result = '{"resultObj":{"orderId":'.json_encode($orderId).',"totalAmount":'.$totalAmount.',"status":"SUCCESS"}}';
			  }else{
				 $result = "FAILURE";
			  }
			  $db = null;
			echo $result;
   }
   else{
		echo '{"error":{"text":"Invalid Session"}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/order',
function () use ($app) {
   try{
   $request = $app->request();
   $order = json_decode($request->getBody());
   $emailId = $order->emailId;
   $sessionKey = $order->sessionKey;
   session_start();
	   if($_SESSION[$emailId] == $sessionKey){
		   $selectedQtyTodays = $order->selectedQtyTodays;
		   $selectedQtyTomorrows = $order->selectedQtyTomorrows;
		   $totalPriceToday = $order->totalPriceToday;
		   $totalPriceTomorrow = $order->totalPriceTomorrow;
		   $todaysLunchOption = $order->todaysLunchOption;
		   $tomorrowsLunchOption = $order->tomorrowsLunchOption;
		   $todayMenuComment = $order->todayMenuComment;
		   $tomorrowMenuComment = $order->tomorrowMenuComment;
		   $userId = $order->userId;
		   $menuId = $order->menuId;
		   $address = $order->address;
		   $todaysMenu = $order->todaysMenu;
		   $tomorrowsMenu = $order->tomorrowsMenu;
		   
		   $grandTotal = $totalPriceToday + $totalPriceTomorrow;
		   
		  $deliveryAddress = 'Name - '.$address->name.', Email - '.$address->email.', Phone - '.$address->mobile.', Address Line 1 - '.$address->addLine1.', Address Line 2 - '.$address->addLine2.', City - '.$address->city.', State - '.$address->state.', Pin - '.$address->pin.', Country - '.$address->country;
		  
		   $sql = "INSERT INTO ordertable (`numberOfLunchForToday`,`numberOfLunchForTomorrow`,`isTodayLunchRequired`,`isTomorrowLunchRequired`,`commentsToday`,`commentsTomorrow`,`orderDateTime`,`userId`,`menuId`,`deliveryAddress`,`totalPriceToday`,`paymentDueAmountToday`,`totalPriceTomorrow`,`paymentDueAmountTomorrow`,`todaysMenu`,`tomorrowsMenu`,`grandTotal`)
		   VALUES ('$selectedQtyTodays','$selectedQtyTomorrows','$todaysLunchOption','$tomorrowsLunchOption','$todayMenuComment','$tomorrowMenuComment',NOW(),'$userId','$menuId','$deliveryAddress','$totalPriceToday','$totalPriceToday','$totalPriceTomorrow','$totalPriceTomorrow','$todaysMenu','$tomorrowsMenu','$grandTotal')";
		   try {
			  $db = getDB();
			  $stmt = $db->prepare($sql);
			  $res = $stmt->execute();
			
			  $result = null;
			  if ($res !=0 ) {
				$sql = "select MAX(orderId) as orderID from ordertable";
				$stmt = $db->prepare($sql);
				$stmt->execute();
				$orderId = $stmt->fetchObject();
				//echo $orderId;
				 $result = '{"resultObj":{"orderId":'.json_encode($orderId).',"status":"SUCCESS"}}';
			  }else{
				 $result = "FAILURE";
			  }
			  $db = null;
			  echo $result;
		   } catch(PDOException $e) {
			  //error_log($e->getMessage(), 3, '/var/tmp/php.log');
			  echo '{"error":{"text":'. $e->getMessage() .'}}';
		   } 
   }
   else{
		echo '{"error":{"text":"Invalid Session"}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
});

$app->post('/register',
function () use ($app) {
   try{
   $request = $app->request();
   $registerUser = json_decode($request->getBody());
   $userName = $registerUser->userName;
   $password = $registerUser->password;
   $emailId = $registerUser->emailId;
   $mobileNo = $registerUser->mobileNo;
   $provider = $registerUser->provider;
   
   
   try {
      $db = getDB();
	  
	  $sql = "SELECT * FROM usertable WHERE emailId='$emailId'";
	  
	  $stmt = $db->prepare($sql);
      $stmt->execute();
    //  $stmt->bindParam("userName", $userName);
    //  $stmt->bindParam("password", $password);
     $stmt->execute();
     $userFetch = $stmt->fetchObject();
	  
	  if($userFetch == null){
		  $sql = "INSERT INTO usertable (`userName`,`password`,`emailId`,`mobileNo`,`dateOfRegistration`,`provider`)
			VALUES ('$userName','$password','$emailId','$mobileNo',NOW(),'$provider')";
		  $stmt = $db->prepare($sql);
		  $res = $stmt->execute();

		  if ($res !=0 ) {
			 $result = '{"resultObj":{"userObj":"Registered","status":"SUCCESS"}}';
		  }else{
			 $result = "FAILURE";
		  }
	  }else{
			$result = '{"resultObj":{"userObj":"USER_EXIST","status":"FAILURE"}}';
	  }
      $db = null;
     
      echo $result;
   } catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
}catch(PDOException $e) {
      //error_log($e->getMessage(), 3, '/var/tmp/php.log');
      echo '{"error":{"text":'. $e->getMessage() .'}}';
   }
   
});

$app->post('/login',
function () use ($app) {

   try{
   $request = $app->request();
   $userRegister = json_decode($request->getBody());
   
   $password = $userRegister->password;
   $emailId = $userRegister->emailId;

   $sql = "SELECT * FROM usertable WHERE emailId='$emailId' && password='$password'";
   try {
   session_start();
      $db = getDB();
      $stmt = $db->prepare($sql);
      $stmt->execute();
    //  $stmt->bindParam("userName", $userName);
    //  $stmt->bindParam("password", $password);
     $stmt->execute();
     $userFetch = $stmt->fetchObject();
     $db = null;
     $result = null;
     if($userFetch != null){
		
		$sessionKeyRandomNo = rand()+time();
		$_SESSION[$emailId] = $sessionKeyRandomNo;
         $result =  '{"resultObj":{"userObj":'.json_encode($userFetch).',"SESSION_KEY":'.$sessionKeyRandomNo.',"status":"SUCCESS"}}';
     }else{
		 unset($_SESSION[$emailId]);
         $result =  '{"resultObj":{"status":"FAILURE"}}';
     }
     echo $result;
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
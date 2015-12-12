<?php
header("Access-Control-Allow-Origin: *");
require 'Classes/PHPExcel.php';

require 'codeguy-Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
use \Slim\Slim AS Slim;

// create new Slim instance
$app = new Slim();

$app->get("/f2", function () {
    echo "<h1>f2 azsys service</h1>";
});

$app->post('/downloadAsExcel',
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
				  $objPHPExcel = new PHPExcel();
				  
				  $serialnumber=0;
				  //Set header with temp array
				  $tmparray =array("Sr.No.","Order Id","Order Date","Total paid","Total due","Address");
				  //take new main array and set header array in it.
				  $sheet =array($tmparray);
				  
				  $result = null;

					$sql = "SELECT * FROM `ordertablenew` as otn,`orderdetailstable` as odt WHERE otn.orderid = odt.orderid and odt.provideremailid = '$emailId' ORDER BY otn.orderdate DESC";
					
					// Make a MySQL Connection
					mysql_connect("localhost", "root", "") or die(mysql_error());
					mysql_select_db("lms") or die(mysql_error());

					 $exec1 = mysql_query($sql) or die ("Error in Query1".mysql_error());

					 while ($res1 = mysql_fetch_array($exec1))
					  {
						$tmparray =array();
						$serialnumber = $serialnumber + 1;
						array_push($tmparray,$serialnumber);
						$orderid = $res1['orderid'];
						array_push($tmparray,$orderid);
						$orderdate = $res1['orderdate'];
						array_push($tmparray,$orderdate);
						$totalpaid = $res1['totalpaid'];
						array_push($tmparray,$totalpaid);
						$totaldue = $res1['totaldue'];
						array_push($tmparray,$totaldue);  
						$address = $res1['address'];
						array_push($tmparray,$address); 
						array_push($sheet,$tmparray);
					  }
					   header('Content-type: application/vnd.ms-excel');
					   header('Content-Disposition: attachment; filename="name.xlsx"');
					  $worksheet = $objPHPExcel->getActiveSheet();
					  foreach($sheet as $row => $columns) {
						foreach($columns as $column => $data) {
							$worksheet->setCellValueByColumnAndRow($column, $row + 1, $data);
						}
					  }

					  //make first row bold
					  $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
					  $objPHPExcel->setActiveSheetIndex(0);
					  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					  $objWriter->save(str_replace('.php', $userId.'.xlsx', __FILE__));
					 
					 $menuFetched = 'exportexcel'.$userId.'.xlsx';
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

// run the Slim app
	  $app->run();

?>

var lmCtrls = angular.module("lm.controllers",[]);
lmCtrls.controller("MainCtrl",['$scope','$location','mainService','$log','$rootScope','$cookieStore','usSpinnerService',mainCtrl]);
lmCtrls.controller("MenuCtrl",['$scope','$location','$log','$rootScope','$cookieStore','mainService',menuCtrl]);
	
 var jq = $.noConflict();
 
function mainCtrl($scope,$location,mainService,$log,$rootScope,$cookieStore,usSpinnerService){

$scope.contact = {};
$scope.address = {};
$scope.user = {};

if(location.href.search(/main/) == -1){
	$rootScope.hideLoginSignup = true;
}
if(location.href.search(/login/) != -1){
	$rootScope.hideLoginSignup = false;
}
if(location.href.search(/register/) != -1){
	$rootScope.hideLoginSignup = false;
}
if(typeof $cookieStore.get('sessionKey') == 'undefined'){//if (typeof mainService.sessionKey == 'undefined' || mainService.sessionKey == ''){
	if(location.href.search(/myorders/) != -1 || location.href.search(/orderConfirmation/) != -1 || location.href.search(/menus/) != -1 || location.href.search(/contact/) != -1 || location.href.search(/adminManipulateMenu/) != -1 
	|| location.href.search(/adminManipulateOrders/) != -1){
		$rootScope.hideLoginSignup = false;
		$rootScope.messageOrErrorLogin = "No active session, please login again !!!";
		
		$location.path("/login");
	}
}
else{
	$rootScope.userName = $cookieStore.get('userName');
	if(location.href.search(/myorders/) != -1){
		mainService.userId = $cookieStore.get('userId');
		mainService.sessionKey = $cookieStore.get('sessionKey');
		mainService.emailId = $cookieStore.get('emailId');
		$scope.myorders;
	}
	if(location.href.search(/adminManipulateMenu/) != -1 || location.href.search(/adminManipulateOrders/) != -1){
		mainService.userId = $cookieStore.get('userId');
		mainService.sessionKey = $cookieStore.get('sessionKey');
		mainService.emailId = $cookieStore.get('emailId');
		mainService.showAdminMenu = $cookieStore.get('showAdminMenu');
		$scope.fetchMenusForUpdate;
	}
	if(location.href.search(/orderReview/) != -1){
		$scope.placeOrder;
	}
}
	$scope.startcounter = 0;
    $scope.startSpin = function() {
      if (!$scope.spinneractive) {
        usSpinnerService.spin('spinner-1');
        $scope.startcounter++;
      }
    };

    $scope.stopSpin = function() {
      if ($scope.spinneractive) {
        usSpinnerService.stop('spinner-1');
      }
    };
    $scope.spinneractive = false;

    $rootScope.$on('us-spinner:spin', function(event, key) {
      $scope.spinneractive = true;
    });

    $rootScope.$on('us-spinner:stop', function(event, key) {
      $scope.spinneractive = false;
    });
	
	$scope.disableContactBtn = true;
    $scope.disableContactBtnClass = 'btn btn-default';

    $scope.$watchCollection('contact',function(contactObject){
    	//console.log("contact obj - "+JSON.stringify(contactObject));

    	if (contactObject.name && contactObject.email && contactObject.phone && contactObject.query && contactObject.timeToContact && contactObject.contactWay) {
    		$scope.disableContactBtn = false;
    		$scope.disableContactBtnClass = 'btn btn-primary';
    	};
    });
	
/*	$scope.disableOrderBtn = true;
    $scope.disableOrderBtnClass = 'btn btn-default';

    $scope.$watchCollection('address',function(addressObject){
    
    	if (addressObject.name && addressObject.email && addressObject.mobile && addressObject.addLine1 && addressObject.addLine2 && addressObject.city && addressObject.state && addressObject.pin && addressObject.country) {
    		$scope.disableOrderBtn = false;
    		$scope.disableOrderBtnClass = 'btn btn-warning';
    	};
    });
*/	
	$scope.showMsg = false;
	$scope.contactNow = function(){
		$scope.startSpin();
	//	console.info("ctrl - ",$scope.contact);
		var promiseObj = mainService.contactus($scope.contact);
		promiseObj.success(function(data,status){
			if(data) {
			   $scope.showMsg = true;
			   $scope.contact = '';
			   $scope.stopSpin();
			   $scope.disableContactBtn = true;
    		   $scope.disableContactBtnClass = 'btn btn-default';
			}
			//$log.info("data - "+data);
			//console.info("data - "+data);
		});
		promiseObj.error(function(data, status,response){
			//console.info("error -  response - "+status+" - "+response);
		});
			
	};
	$scope.setMenuPhotoUrl = function(imgUrl,altText){
		$scope.imgUrl = imgUrl;
		$scope.altText = altText;
	}
	$scope.setAddressDetail = function(address){
		$scope.addressVar = address;
	}
	$scope.setAdminOrderDetail = function(orderDetail){
		$scope.orderDetail = orderDetail;
	}
	$scope.login = function(){
			
			$rootScope.userData = {};
			
			if($scope.user.emailId && $scope.user.password){
				var promiseObj = mainService.login($scope.user);
					
				promiseObj.success(function(data,status){
					if(data.resultObj.status === 'SUCCESS'){
						 
						 mainService.emailId = data.resultObj.userObj.emailId;
						 mainService.sessionKey = data.resultObj.SESSION_KEY;
						 mainService.userId = data.resultObj.userObj.userId;
						 $rootScope.userName = data.resultObj.userObj.userName;
						 $cookieStore.put("sessionKey",mainService.sessionKey);
						 $cookieStore.put("userName",$rootScope.userName);
						 $cookieStore.put("userId",mainService.userId);
						 $cookieStore.put("emailId",mainService.emailId);
						 if(data.resultObj.userObj.provider == 'YES'){
							mainService.showAdminMenu = true;
							$cookieStore.put("showAdminMenu",mainService.showAdminMenu);
							$location.path("/adminManipulateMenu");
						 }else{
							$location.path("/menus");
						}
					}else{
						$rootScope.messageOrErrorLogin = "Please register to continue !!!";
						
					}
					
				});
				promiseObj.error(function(data, status,response){
					
					$rootScope.messageOrErrorLogin = "Wrong email Id or password, please try again !!!";
					$rootScope.messageOrErrorColor = "red";
				});
			}else{
				$rootScope.messageOrErrorLogin = "Some mandatory fields are empty !!!";
			}
	}
	$scope.register = function(obj){
			 $rootScope.userData = {};
			 
			 if(obj === 'provider'){
				$scope.user.provider = 'YES';
			 }else{
				$scope.user.provider = 'NO'
			 }
			if($scope.user.userName && $scope.user.emailId && $scope.user.mobileNo && $scope.user.password){
				var promiseObj = mainService.register($scope.user);
					
				promiseObj.success(function(data,status){
					
					if(data.resultObj.status === 'SUCCESS'){
						$rootScope.messageOrErrorLogin = "Please check your email for login details";
					//	mainService.registerConfirmation($scope.user);
						$location.path("/login");
					}else if(data.resultObj.status === 'FAILURE' && data.resultObj.userObj === 'USER_EXIST'){
						$scope.messageOrErrorSignup = "Email Id already registered !!!";
					}
					else{
						$scope.messageOrErrorSignup = "Some error occurred, please try again";
						
					}
				});
				promiseObj.error(function(data, status,response){
					
					$rootScope.messageOrErrorSignup = "Some error occurred, please try again";
					$rootScope.messageOrErrorColor = "red";
				});
			}else{
				 $scope.messageOrErrorSignup = "Some mandatory fields are empty !!!";
			}
	}
	
	$scope.fetchOrderDetail = function(orderid) {
	  var obj = { 
						
						"userId" : mainService.userId,
						"sessionKey" : mainService.sessionKey,
						"emailId" : mainService.emailId,
						"orderid" : orderid
	 
					};
		
		var promiseObj = mainService.fetchOrderDetail(obj);
			promiseObj.success(function(data,status){
				if(data.resultObj.status === 'SUCCESS'){
					$scope.orderDetail = data.resultObj.orderDetail;
				}
			});
			promiseObj.error(function(data, status,response){
				$rootScope.messageOrError = "Some error occurred, please try again";
				$rootScope.messageOrErrorColor = "red";
			});
    }
	
	$scope.fetchOrdersForUpdate = function() {
	  
	  var userIdObj = { 
						
						"userId" : mainService.userId,
						"sessionKey" : mainService.sessionKey,
						"emailId" : mainService.emailId
	 
					};
		
		var promiseObj = mainService.fetchOrdersForUpdate(userIdObj);
				
			promiseObj.success(function(data,status){
				if(data.resultObj.status === 'SUCCESS'){
					$scope.ordersFetched = data.resultObj.ordersFetched;
					
					$scope.totalDue = 0.000;
				
					for(var i = 0; i < $scope.ordersFetched.length; i++){
						
						$scope.totalDue = $scope.totalDue + ($scope.ordersFetched[i].totalorderprice - $scope.ordersFetched[i].totalpaid);
					}
					
				}
			});
			promiseObj.error(function(data, status,response){
				
				$rootScope.messageOrError = "Some error occurred, please try again";
				$rootScope.messageOrErrorColor = "red";
			});
    }
	
	$scope.downloadAsExcel = function() {
	  
	  var userIdObj = { 
						
						"userId" : mainService.userId,
						"sessionKey" : mainService.sessionKey,
						"emailId" : mainService.emailId
	 
					};
		
		var promiseObj = mainService.downloadAsExcel(userIdObj);
				
			promiseObj.success(function(data,status){
				if(data.resultObj.status === 'SUCCESS'){
					window.open(data.resultObj.ordersFetched,'_blank');
				}
			});
			promiseObj.error(function(data, status,response){
				
				$rootScope.messageOrError = "Some error occurred, please try again";
				$rootScope.messageOrErrorColor = "red";
			});
    }
	
	
	$scope.myorders = function() {
	  
	  var userIdObj = { 
						
						"userId" : mainService.userId,
						"sessionKey" : mainService.sessionKey,
						"emailId" : mainService.emailId
	 
					};
		
		var promiseObj = mainService.myorders(userIdObj);
				
			promiseObj.success(function(data,status){
				if(data.resultObj.status === 'SUCCESS'){
					$scope.ordersFetched = data.resultObj.ordersFetched;
					
					$scope.totalDue = 0.000;
				
					for(var i = 0; i < $scope.ordersFetched.length; i++){
						
						$scope.totalDue = $scope.totalDue + ($scope.ordersFetched[i].totalorderprice - $scope.ordersFetched[i].totalpaid);
					}
					
				}
			});
			promiseObj.error(function(data, status,response){
				
				$rootScope.messageOrError = "Some error occurred, please try again";
				$rootScope.messageOrErrorColor = "red";
			});
    }
    $scope.onChangeTodaysLunchOption = function(index){
		if($scope.menusObjects[index].todaysLunchOption === 'NO')
			$scope.menusObjects[index].todaysLunchDisable = true;
		else
			$scope.menusObjects[index].todaysLunchDisable = false;
	}
	 $scope.onChangeTomorrowsLunchOption = function(index){
		
		if($scope.menusObjects[index].tomorrowsLunchOption === 'NO')
			$scope.menusObjects[index].tomorrowsLunchDisable = true;
		else
			$scope.menusObjects[index].tomorrowsLunchDisable = false;
		
	}
	$scope.cancelThisOrder = function(index){
	   if($rootScope.tabToday.active){
			$rootScope.items[index].todayShow = false;
			$rootScope.totalAmount = $rootScope.totalAmount - $rootScope.items[index].totalPriceToday;
		}
	   else{
			$rootScope.items[index].tomorrowShow = false;
			$rootScope.totalAmount = $rootScope.totalAmount - $rootScope.items[index].totalPriceTomorrow;
		}
	}
	$scope.confirmOrder = function(){
		var userInfo = { 
						"userId" : mainService.userId,
						"sessionKey" : mainService.sessionKey,
						"emailId" : mainService.emailId
					};
	var newAddress = $scope.address;
	if(newAddress){
	
	}else{
	
	}
	var order = {'totalAmount':$rootScope.totalAmount,'items':$rootScope.items,'address':newAddress,'userInfo':userInfo};
		
		//console.log('order '+JSON.stringify(order));
		var promiseObj = mainService.confirmorder(order);
		
		promiseObj.success(function(data,status){
					if(data.resultObj.status === 'SUCCESS'){
						$rootScope.orderId = data.resultObj.orderId.orderID;
						$rootScope.totalAmount = data.resultObj.totalAmount;
						$rootScope.items = [];
						$location.path("/orderConfirmation");
					}
					
				});
				promiseObj.error(function(data, status,response){
					console.info("error -  response - "+status+" - "+response);
					$rootScope.messageOrError = "Some error occurred, please try again";
					$rootScope.messageOrErrorColor = "red";
				});
		
	}
    $scope.placeOrder = function() {
	$scope.items = [];
	$rootScope.totalAmount = 0;
	$rootScope.tabToday = {active : false, disabled: false };
	$rootScope.tabTomorrow = {active : false, disabled: false };
	
	var updatedMenus = $scope.menusObjects;
	
	for(var i = 0; i<updatedMenus.length ; i++){
	var item = {};
		if(updatedMenus[i].todaysLunchOption === 'YES' && updatedMenus[i].tomorrowsLunchOption === 'YES'){
		
			$rootScope.tabToday.active = true;
			$rootScope.tabToday.disabled = false;
			$rootScope.tabTomorrow.active = false;
			$rootScope.tabTomorrow.disabled = false;
			item.todaysLunchOption = 'YES';
			item.tomorrowsLunchOption = 'YES';
			item.todayShow = true;
			item.tomorrowShow = true;
			item.todayMenu = updatedMenus[i].todayMenu;
			item.todayMenuUnitPrice = updatedMenus[i].todayMenuUnitPrice;
			item.selectedQtyTodays = updatedMenus[i].selectedQtyTodays;
			item.totalPriceToday = updatedMenus[i].selectedQtyTodays * updatedMenus[i].todayMenuUnitPrice;
			if(updatedMenus[i].todayMenuComment){
				item.todayMenuComment = updatedMenus[i].todayMenuComment;
			}else{
				item.todayMenuComment = 'NA';
			}
			if(updatedMenus[i].tomorrowMenuComment){
				item.tomorrowMenuComment = updatedMenus[i].tomorrowMenuComment;
			}else{
				item.tomorrowMenuComment = 'NA';
			}
			item.tomorrowMenuUnitPrice = updatedMenus[i].tomorrowMenuUnitPrice;
			item.selectedQtyTomorrows = updatedMenus[i].selectedQtyTomorrows;
			item.totalPriceTomorrow = updatedMenus[i].selectedQtyTomorrows * updatedMenus[i].tomorrowMenuUnitPrice;
			item.tomorrowMenu = updatedMenus[i].tomorrowMenu;
			item.providerEmailId = updatedMenus[i].emailId;
			item.providerMobileNo = updatedMenus[i].mobileNo;
			item.providerName = updatedMenus[i].userName;
			$rootScope.totalAmount = $rootScope.totalAmount + item.totalPriceToday + item.totalPriceTomorrow;
			$scope.items.push(item);
		
		}
		else if(updatedMenus[i].todaysLunchOption === 'YES' && updatedMenus[i].tomorrowsLunchOption === 'NO'){
		
			$rootScope.tabToday.active = true;
			$rootScope.tabToday.disabled = false;
			$rootScope.tabTomorrow.active = false;
			$rootScope.tabTomorrow.disabled = true;
			item.todaysLunchOption = 'YES';
			item.tomorrowsLunchOption = 'NO';
			item.todayShow = true;
			item.tomorrowShow = false;
			item.todayMenu = updatedMenus[i].todayMenu;
			item.todayMenuUnitPrice = updatedMenus[i].todayMenuUnitPrice;
			item.selectedQtyTodays = updatedMenus[i].selectedQtyTodays;
			item.totalPriceToday = updatedMenus[i].selectedQtyTodays * updatedMenus[i].todayMenuUnitPrice;
			
			if(updatedMenus[i].todayMenuComment){
				item.todayMenuComment = updatedMenus[i].todayMenuComment;
			}else{
				item.todayMenuComment = 'NA';
			}
			
			item.providerEmailId = updatedMenus[i].emailId;
			item.providerMobileNo = updatedMenus[i].mobileNo;
			item.providerName = updatedMenus[i].userName;
			$rootScope.totalAmount = $rootScope.totalAmount + item.totalPriceToday;
			$scope.items.push(item);
		}
		else if(updatedMenus[i].todaysLunchOption === 'NO' && updatedMenus[i].tomorrowsLunchOption === 'YES'){
		
			$rootScope.tabToday.active = false;
			$rootScope.tabToday.disabled = true;
			$rootScope.tabTomorrow.active = true;
			$rootScope.tabTomorrow.disabled = false;
			item.todaysLunchOption = 'NO';
			item.tomorrowsLunchOption = 'YES';
			item.todayShow = false;
			item.tomorrowShow = true;
			item.tomorrowMenu = updatedMenus[i].tomorrowMenu;
			item.tomorrowMenuUnitPrice = updatedMenus[i].tomorrowMenuUnitPrice;
			item.selectedQtyTomorrows = updatedMenus[i].selectedQtyTomorrows;
			item.totalPriceTomorrow = updatedMenus[i].selectedQtyTomorrows * updatedMenus[i].tomorrowMenuUnitPrice;
			
			if(updatedMenus[i].tomorrowMenuComment){
				item.tomorrowMenuComment = updatedMenus[i].tomorrowMenuComment;
			}else{
				item.tomorrowMenuComment = 'NA';
			}
			
			item.providerEmailId = updatedMenus[i].emailId;
			item.providerMobileNo = updatedMenus[i].mobileNo;
			item.providerName = updatedMenus[i].userName;
			$rootScope.totalAmount = $rootScope.totalAmount + item.totalPriceTomorrow;
			$scope.items.push(item);
		}
		
	}
	if($scope.items.length > 0){
		$scope.showOrderMsg = false;
		$scope.orderMsg = "";
		$rootScope.items = $scope.items;
	//	$cookieStore.put("items",$rootScope.items);
		$location.path("/orderReview");
	}
	else{
		$scope.orderMsg = "Minimum one day order is mandatory, select YES !!!";
		$scope.showOrderMsg = true;
	}
	
    }
	
	$scope.addUpdateMenu = function(){
	
	var addUpdateMenuObj = { 
						
						"userId" : mainService.userId,
						"sessionKey" : mainService.sessionKey,
						"emailId" : mainService.emailId,
						"updatedMenu" : $scope.fetchedMenusObject
	 
					};
	
			var promiseObj = mainService.addUpdateMenu(addUpdateMenuObj);
				
			promiseObj.success(function(data,status){
			
				if(data.resultObj.status === 'SUCCESS'){
					$scope.updatedOrAdded = true;
				}
				
			});
			promiseObj.error(function(data, status,response){
				console.info("error -  response - "+status+" - "+response);
				$rootScope.messageOrError = "Some error occurred, please try again";
				$rootScope.messageOrErrorColor = "red";
			});

			//	console.log("result - ",result);
			
	}
    
    $scope.fetchMenusForUpdate = function(){
	
	var userIdObj = { 
						
						"userId" : mainService.userId,
						"sessionKey" : mainService.sessionKey,
						"emailId" : mainService.emailId
	 
					};
	
			var promiseObj = mainService.fetchMenusForUpdate(userIdObj);
				
			promiseObj.success(function(data,status){
			
				if(data.resultObj.status === 'SUCCESS'){
					$scope.fetchedMenusObject = data.resultObj.menuFetched[0];
				}
				
			});
			promiseObj.error(function(data, status,response){
				console.info("error -  response - "+status+" - "+response);
				$rootScope.messageOrError = "Some error occurred, please try again";
				$rootScope.messageOrErrorColor = "red";
			});

			//	console.log("result - ",result);
			
	}
	
	$scope.menus = function(){
	//console.log(angular.element(".test").val());
	
	//var jq = $.noConflict();
	//console.log("jq----",jq(".test"));
		//$scope.startSpin();
		$scope.showLoading = true;
			var promiseObj = mainService.menus();
			promiseObj.success(function(data,status){
				$scope.menusObjects = data.resultObj.menuObj;
				
				for(var i = 0; i<$scope.menusObjects.length;i++){
					$scope.menusObjects[i].selectedQtyTodays = 1; 
					$scope.menusObjects[i].selectedQtyTomorrows = 1; 
					$scope.menusObjects[i].todaysLunchOption = "YES"; 
					$scope.menusObjects[i].tomorrowsLunchOption = "YES"; 
					$scope.menusObjects[i].qtyList = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
				}
			//	$scope.stopSpin();
			$scope.showLoading = false;
			});
			promiseObj.error(function(data, status,response){
				console.info("error -  response - "+status+" - "+response);
				$rootScope.messageOrError = "Some error occurred, please try again";
				$rootScope.messageOrErrorColor = "red";
			});

			//	console.log("result - ",result);
			
	}

}

function menuCtrl($scope,$location,$log,$rootScope,$cookieStore,mainService){

	$scope.showAdminMenu = mainService.showAdminMenu;
	this.tab = 1;
	this.selectTab = function(setTab){
		this.tab = setTab;
	};
	this.isSelected = function(checkTab) {
		var val =  this.tab === checkTab;
		return val;
	};
	
	$scope.logout = function() {
        
		var promiseObj = mainService.logout(mainService.userId);
		mainService.sessionKey = '';
		mainService.userId = '';
		mainService.showAdminMenu = false;
		$rootScope.messageOrErrorLogin = "Please login with your email Id and password";
		$cookieStore.remove('sessionKey');
		$cookieStore.remove('userName');
		$cookieStore.remove('userId');
		$cookieStore.remove('emailId');
		$cookieStore.remove('showAdminMenu');
	//	$cookieStore.remove("items");
        $location.path("/login");
    }
}

function contains(a, obj) {
    var count = -1;
    for (var i = 0; i < a.length; i++) {
        if (a[i].name === obj) {
            count = i;
            return count;
        }
    }
    return count;
}

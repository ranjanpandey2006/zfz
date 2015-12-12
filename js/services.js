var lmServices = angular.module("lm.services",[]);

lmServices.factory('mainService', ['$http','$q', mainService]);
//var baseUrl = 'http://zfz.arizonasys.com/zfz';
var baseUrl = 'http://localhost:80/zfz';
var paymentUrl = 'https://api.sandbox.paypal.com';

function menuService($http){

	var menuService = function() {
		    this.menusObjects = [];
		    this.busy = false;
		    this.after = 0;
		  };


	menuService.prototype.fetchMenu = function(){

		if (this.busy) return;
    	this.busy = true;

			return $http({
					method: 'POST',
					url: 'http://food.arizonasys.com/LunchMunch/lunchOrder.php/fetchMenu?startrow='+this.after

		        }).success(function(data) {
		        	console.log("data - ",data.resultObj.productsObj);
		        	console.log("after - ",this.after);
			      var items = data.resultObj.productsObj;
			      for (var i = 0; i < items.length; i++) {
			        this.items.push(items[i]);
			      }
			      this.after = 15 + this.after;
			      this.busy = false;
			    }.bind(this));
	};

	return menuService;
}

function mainService($http,$q){
	
	var functionArray = [];
	
	functionArray.confirmorder = function(order){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/confirmorder',
			        data:order
	        });
	};
	
	functionArray.login = function(user){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/login',
			        data:user
	        });
	};
	
	functionArray.register = function(user){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/register',
			        data:user
	        });
	};
	
	functionArray.placeorder = function(orderObj){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/order',
			        data:orderObj
	        });
	};
	
	functionArray.myorders = function(userIdObj){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/myordersnew',
			        data:userIdObj
	        });
	};
	functionArray.fetchOrdersForUpdate = function(userIdObj){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/fetchOrdersForUpdate',
			        data:userIdObj
	        });
	};
	
	functionArray.downloadAsExcel = function(userIdObj){

		return $http({
				method: 'POST', 
				url: baseUrl+'/exportexcel.php/downloadAsExcel',
				data:userIdObj
		});
	};
	
	functionArray.addUpdateMenu = function(addUpdateMenuObj){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/addUpdateMenu',
			        data:addUpdateMenuObj
	        });
	};
	
	functionArray.fetchOrderDetail = function(obj){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/fetchOrderDetail',
			        data:obj
	        });
	};
	
	functionArray.fetchMenusForUpdate = function(userIdObj){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/fetchMenusForUpdate',
			        data:userIdObj
	        });
	};
	
	functionArray.logout = function(userId){
	
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/logout',
					data:userId
	        });
	};
	
	functionArray.menus = function(){
		
		return $http({
			        method: 'POST', 
			        url: baseUrl+'/lms.php/menus'
	        });
	};
	
	functionArray.contactus = function(contactObj){
		
	        return $http({
			        method: 'POST', 
			        url: baseUrl+'/email.php/contactus',
			        data:contactObj
	        });
	    
	};
	
	functionArray.registerConfirmation = function(registerConfirmationObj){
		
	        return $http({
			        method: 'POST', 
			        url: baseUrl+'/email.php/registerConfirmation',
			        data:registerConfirmationObj
	        });
	    
	};
	 
	return functionArray;
}
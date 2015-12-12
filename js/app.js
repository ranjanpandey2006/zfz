var lm = angular.module("lm",['lm.controllers','lm.services','ngRoute','infinite-scroll','ui.bootstrap','ngCookies','angularSpinner']).
config(['$routeProvider', function($routeProvider) {
	  $routeProvider.
		when('/home', {
	            templateUrl: 'partials/lmHome.html',
				controller: 'MainCtrl'
			}); 
		$routeProvider.
		when('/myorders', {
	            templateUrl: 'partials/myOrders.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/adminManipulateMenu', {
	            templateUrl: 'partials/adminManipulateMenu.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/adminManipulateOrders', {
	            templateUrl: 'partials/adminManipulateOrders.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/orderReview', {
	            templateUrl: 'partials/orderReview.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/orderConfirmation', {
	            templateUrl: 'partials/orderConfirmation.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/menus', {
	            templateUrl: 'partials/lmMenu.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/login', {
	            templateUrl: 'partials/login.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/register', {
	            templateUrl: 'partials/signUp.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/registerProvider', {
	            templateUrl: 'partials/signUpProvider.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/addItem', {
	            templateUrl: 'partials/lmAddItem.html',
				controller: 'MainCtrl'
			});
		$routeProvider.
		when('/contact', {
	            templateUrl: 'partials/contact.html',
				controller: 'MainCtrl'
			});
	  $routeProvider.otherwise({redirectTo: '/main'});
	}]);
var epioTest = angular.module('epioTest', 
		[
		'ngFileUpload',
		'angular-loading-bar',
		'ui.tinymce',
		'userCtrl',
		'userService',
		'recipeCtrl',
		'recipeService'
		],
		function($interpolateProvider){
			$interpolateProvider.startSymbol('<%');
			$interpolateProvider.endSymbol('%>');
		});
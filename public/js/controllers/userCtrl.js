angular.module('userCtrl', [])

// inject the user service into our controller
.controller('userController', function($scope, $http, User) {
	//object to hold all the data for the new user form
	$scope.userData = {};

	$scope.modalUser = function(mode) {
		$scope.mode = mode;
		$scope.errors = "";
		switch (mode) {
			case 'register':
				$scope.userData = {
					'name' : '',
					'email' : '',
					'password':''};
				$scope.formTitle = "Registro de doctor";
				$scope.submitBtn = "Guardar"
				break;
			case 'login':
				$scope.formTitle = "Iniciar sesión";
				$scope.submitBtn = "Login"
				$scope.userData.name = 'null';
				break;
			case 'edit':
				break;
			default:
				break;
		}
		$('#regModal').modal('show');
		console.log();
	}

	//function to handle submitting the form
	//SAVE user
	$scope.submitUser = function(mode) {
		//save user pass comment data from the form
		//use the function created in service
		User.save(mode, $scope.userData)
			.success(function(data) {
				if (data.success == false) {
					$scope.errors = data.errors;
				}else{
					$('#regModal').modal('hide');
					if (mode == 'login') {
						location.reload();
					}
				}
			})
			.error(function(data) {
				console.log(data);
			});
	};

	//function to handle delete user
	$scope.deleteUser = function(id) {
		//use function created in service
		User.destroy(id)
			.success(function(data){
				//if successful
				
			});
	};

	$scope.logout = function(){
		User.logout()
			.success(function(data){
				location.reload();
			})
			.error(function(data){
				console.log(data);
			});
	}
	
});

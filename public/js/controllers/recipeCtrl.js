angular.module('recipeCtrl', [])

// inject the Recipe service into our controller
.controller('recipeController', function($scope, $http, Recipe) {
	//object to hold all the data for the new Recipe form
	$scope.recipeData = {};


	//get all Recipees first and bind it to the $scope.Recipees object
	//use the funcion created in service
	//GET ALL RecipeES
	Recipe.get()
		.success(function(data) {
			$scope.recipes = data;
		});

	$scope.modalRecipe = function(mode, id) {
		$scope.mode = mode;
		$scope.errors = "";
		switch (mode) {
			case 'create':
				$scope.recipeData = {
					'name' : '',
					'lastname' : ''};
				$scope.formTitle2 = "Generar Récipe";
				break;
			case 'edit':
				$scope.formTitle = "Editar Récipe";
				$scope.id = id;
				Recipe.show(id)
					.success(function(data) {
						$scope.recipeData = data;
					});
				break;
			default:
				break;
		}
		console.log();
		$('#recipeModal').modal('show');
	}

	//function to handle submitting the form
	//SAVE Recipe
	$scope.submitRecipe = function(mode, id) {
		//save Recipe pass comment data from the form
		//use the function created in service
		Recipe.save(mode, $scope.recipeData, id)
			.success(function(data) {
				if (data.success == false) {
					$scope.errors = data.errors;
				}else{
					Recipe.get()
						.success(function(getData) {
							$scope.recipes = getData;
							$('#recipeModal').modal('hide');
						});
				}
			})
			.error(function(data) {
				/* Act on the event */
				console.log(data);
			});
	};

	//function to send recipe to pacient
	$scope.sendRecipe = function(id,email){
		if (email != null) {
			//send
			Recipe.send(id)
			.success(function(data){
				if (data.success == false) {
					//errors
				}else{
					//show msg
					$('#warnModal').modal('show');
					$scope.mensaje = 'Récipe enviado';
					
				}
			});
		}else{
			//show no email found
			$('#warnModal').modal('show');
			$scope.mensaje = 'Sin dirección de correo';
		}
	}

	$scope.tempId = '';

	//function to show modal confirm delete
	$scope.confirmDelete = function(id) {
		$('#delModal').modal('show');
		$scope.tempId = id;
	};

	$scope.cancelDelete = function(){
		$('#delModal').modal('hide');
		$scope.tempId = '';
	};

	//function to handle delete Recipe
	$scope.deleteRecipe = function(id) {
		//use function created in service
		Recipe.destroy(id)
			.success(function(data){
				$scope.tempId = '';
				//if successful refresh Recipe list and hide modal
				$('#delModal').modal('hide');
				Recipe.get()
					.success(function(getData){
						$scope.recipes = getData;
					});
			});
	};
	
});

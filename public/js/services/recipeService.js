angular.module('recipeService', [])

.factory('Recipe', function($http){
	return {
		//get all paises
		get : function(){
			return $http.get('/recipes');
		},
		//show pais by id
		show : function(id) { 
			return $http.get('/recipes/' + id);
		},

		//save recipe (recipeData)
		save : function(mode , recipeData, id) {
			if (mode == 'edit') {
				url = '/recipes/'+recipeData.id;
			}else{
				url = '/recipes';
			}	
			return $http({
				method: 'POST',
				url: url,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(recipeData)
			});
		},

		//find recipe and send by id
		send : function(id) {
			return $http.get('recipes/send/' + id);
		}

		//delete recipe
		destroy : function(id) {
			return $http.delete('/recipes/' + id);
		}
	}
});
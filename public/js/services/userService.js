angular.module('userService', [])

.factory('User', function($http){
	return {
		//get all users
		get : function(){
			return $http.get('/users');
		},
		//show user by id
		show : function(id) { 
			return $http.get('/users' + id);
		},

		//save pais (userData) and pass data to login
		save : function(mode , userData, id) {
			switch (mode){
				case 'register':
					url = '/register';
					break;
				case 'login':
					url = '/login';
					break;
				case 'edit':
					url = '(/user/' + id;
					break;
			}
			return $http({
				method: 'POST',
				url: url,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(userData)
			});
		},

		//delete pais
		destroy : function(id) {
			return $http.delete('/users' + id);
		},

		//logout user
		logout : function() {
			return $http.get('/logout');
		}
	}
});
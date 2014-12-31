angular.module('noteService', [])

	.factory('Note', function($http) {

		return {

			get : function() {
				return $http.get('/note');
			},

			save : function(noteData) {
				return $http({
					method: 'POST',
					url: '/note',
					headers: {'Content-Type' : 'application/x-www-form-urlencoded'},
					data: $.param(noteData)
				});
			},

			show : function(id) {
				return $http.get('note/' + id);
			},

			update : function(id, noteData) {
				return $http({
					method: 'PUT',
					url: '/note/' + id,
					headers: {'Content-Type' : 'application/x-www-form-urlencoded'},
					data: $.param(noteData)
				});
			},

			destroy : function(id) {
				return $http.delete('/note/' + id);
			} 
		}
	});
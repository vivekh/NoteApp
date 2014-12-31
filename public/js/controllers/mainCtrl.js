angular.module('mainCtrl', [])

	.controller('mainController', function($scope, $http, Note) {
		$scope.noteData = {};
		$scope.noteEditData = {};
		$scope.loading = true;
		$scope.form = false;
		$scope.editForm = false;
		$scope.addBtn = true;

		Note.get().success(function(data){
			$scope.notes = data.response;
			$scope.loading = false;
		});

		$scope.showForm = function() {
			$scope.form = true;
			$scope.addBtn = false;
		};

		$scope.hideForm = function() {
			$scope.form = false;
			$scope.editForm = false;
			$scope.addBtn = true;	
		}

		$scope.submitNote = function() {
			$scope.loading = true;
			Note.save($scope.noteData)
				.success(function(data){
					Note.get().success(function(data){
						$scope.notes = data.response;
						$scope.loading = false;
						$scope.form = false;
						$scope.editForm = false;
						$scope.addBtn = true;
					});
				})
				.error(function(data) {

				});
		};

		$scope.getNote = function(id) {
			$scope.loading = true;
			Note.show(id)
				.success(function(data){
					$scope.loading = false;
					$scope.form = false;
					$scope.editForm = true;
					$scope.addBtn = false;
					$scope.noteEditData.title = data.title;
					$scope.noteEditData.note = data.note;
					$scope.noteEditData.id = data.id;
				})
				.error(function(data) {

				});
		};

		$scope.editNote = function(id) {
			$scope.loading = true;
			Note.update(id, $scope.noteEditData)
				.success(function(data){
					Note.get().success(function(data){
						$scope.notes = data.response;
						$scope.loading = false;
						$scope.form = false;
						$scope.editForm = false;
						$scope.addBtn = true;
					});
				})
				.error(function(data) {

				});
		};

		$scope.deleteNote = function(id) {
			$scope.loading = true;
			Note.destroy(id)
				.success(function(data){
					Note.get().success(function(data){
						$scope.notes = data.response;
						$scope.loading = false;
					});
				});
		};
	});
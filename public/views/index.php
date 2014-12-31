<!DOCTYPE html>
<html lang="en">

	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note app</title>

    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->

    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    <script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
    <script src="js/services/noteService.js"></script> <!-- load our service -->
    <script src="js/app.js"></script> <!-- load our application -->

 	</head>

 	<body ng-app="noteApp" ng-controller="mainController">

 		<div class="container-fluid">

            <div class="row note-form">
            <div class="col-md-4 col-lg-5"></div>
            <button type="button" class="btn btn-primary btn-lg col-md-4 col-lg-2" ng-show="addBtn" ng-click="showForm()">Add Note</button>
            <div class="col-md-4 col-lg-5"></div>
            <div>

            <div class="row note-form">
            <form name="save_form" ng-submit="submitNote()" ng-show="form">
                <div class="row">
                <div class="col-md-2 col-lg-4"></div>
                <div class="form-group col-md-8 col-lg-4">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" ng-model="noteData.title" ng-minlength="1" ng-maxlength="20" required placeholder="Title">
                    <div class="error" ng-show="save_form.title.$dirty && save_form.title.$invalid"></div>
                    <small class="error" ng-show="save_form.title.$error.requried">Title is requried</small>
                    <small class="error" ng-show="save_form.title.$error.maxlength">Title cannot be more then 20 characters</small>
                </div>
                <div class="col-md-2 col-lg-4"></div>
                </div>

                <div class="row">
                <div class="col-md-2 col-lg-4"></div>
                <div class="form-group col-md-8 col-lg-4">
                    <label for="note">Note</label>
                    <textarea class="form-control" rows="3" name="note" ng-model="noteData.note" ng-minlength="1" ng-maxlength="200" required placeholder="Note"></textarea>
                    <div class="error" ng-show="save_form.note.$dirty && save_form.note.$invalid"></div>
                    <small class="error" ng-show="save_form.note.$error.requried">Note is requried</small>
                    <small class="error" ng-show="save_form.note.$error.maxlength">Note cannot be more then 200 characters</small>
                </div>
                <div class="col-md-2 col-lg-4"></div>
                </div>

                 <div class="row">
                    <div class="col-md-4 col-lg-5"></div>
                    <div class="form-group col-md-2 col-lg-1"><button type="submit" class="btn btn-success" ng-disabled="save_form.$invalid">Save</button></div>
                    <div class="form-group col-md-2 col-lg-1"><button type="button" class="btn btn-primary" ng-click="hideForm()">Cancel</button></div>
                    <div class="col-md-4 col-lg-5"></div>
                </div>
            </form>
            </div>

            <div class="row note-form">
            <form name="edit_form" ng-submit="editNote(noteEditData.id)" ng-show="editForm">
                <div class="row">
                <div class="col-md-2 col-lg-4"></div>
                <div class="form-group col-md-8 col-lg-4">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="etitle" ng-model="noteEditData.title" ng-minlength="1" ng-maxlength="20" required>
                    <div class="error" ng-show="edit_form.etitle.$dirty && edit_form.etitle.$invalid"></div>
                    <small class="error" ng-show="edit_form.etitle.$error.requried">Title is requried</small>
                    <small class="error" ng-show="edit_form.etitle.$error.maxlength">Title cannot be more then 20 characters</small>
                </div>
                <div class="col-md-2 col-lg-4"></div>
                </div>

                <div class="row">
                <div class="col-md-2 col-lg-4"></div>
                <div class="form-group col-md-8 col-lg-4">
                    <label for="note">Note</label>
                    <textarea class="form-control" rows="3" name="enote" ng-model="noteEditData.note" ng-minlength="1" ng-maxlength="200" required></textarea>
                    <div class="error" ng-show="edit_form.enote.$dirty && edit_form.enote.$invalid"></div>
                    <small class="error" ng-show="edit_form.enote.$error.requried">Note is requried</small>
                    <small class="error" ng-show="edit_form.enote.$error.maxlength">Note cannot be more then 200 characters</small>
                </div>
                <div class="col-md-2 col-lg-4"></div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-lg-5"></div>
                    <div class="form-group col-md-2 col-lg-1"><button type="submit" class="btn btn-success" ng-disabled="edit_form.$invalid">Save</button></div>
                    <div class="form-group col-md-2 col-lg-1"><button type="button" class="btn btn-primary" ng-click="hideForm()">Cancel</button></div>
                    <div class="col-md-4 col-lg-5"></div>
                </div>
            </form>
            </div>

            <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
            <hr width="80%">
            <div class="note" ng-hide="loading" ng-repeat="note in notes">
                <div class="row">
                    <div class="col-md-2 col-lg-4"></div>
                    <div class="col-md-8 col-lg-4">
                        <h3>{{note.title}} 
                            <button type="button" class="btn btn-danger btn-xs" ng-click="deleteNote(note.id)">Delete</button>
                            <button type="button" class="btn btn-primary btn-xs" ng-click="getNote(note.id)">Edit</button>
                        </h3>
                        <p>{{note.note}}</p>
                        <hr/>
                    </div>
                    <div class="col-md-2 col-lg-4"></div>
                </div>
            </div>
              
 		</div>
 		
 	</body>

</html>
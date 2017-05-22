angular.module('Decibels').controller('adminController',
    ['$http','$cookies','$location', '$timeout', 'alreadyLoggedIn','createNewAdmin', '$scope',
    function($http, $cookies, $location, $timeout, alreadyLoggedIn, createNewAdmin, $scope) {

    // ========= INITIALISATION ========= //

    var self = this;
    self.isRoot = $cookies.get('isRoot');

    // Display Disconnect button
    $scope.changeShowDisconnectButton(true);


    // ========= FUNCTIONS ========= //
    // Check for valid token
    self.callbackAlreadyLoggedIn = function(success,response) {
        if(!success) {
            $location.path("/");
        }
    };
    alreadyLoggedIn.isAlreadyLoggedIn(self.callbackAlreadyLoggedIn);


    // Submit addStyleForm
    self.submitMessage = "";
    self.submitAddStyleForm = function(isValid) {
        if(isValid) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Style',
                            'method': 'insertStyle',
                            'style_name': self.new_style_name
                }
            })
            .then(function success(response){
                self.new_style_name = null;
                self.submitMessage = "Style enregistré !";
                $timeout(function () { self.submitMessage = ""; }, 3000);
            }
            , function error(response) {
                if(response.status == 400) {
                    self.submitMessage = "Echec de l'enregistrement, requête invalide.";
                }
                else {
                    self.submitMessage = "Echec de l'enregistrement, le style est déjà répertorié.";
                }
                $timeout(function () { self.submitMessage = ""; }, 3000);

                console.log('Error inserting style : ' + response);
            });

        }
    }

    // Submit new Admin form
    self.callbackNewAdmin = function(success,response) {
        if(success) {
            $cookies.put('token',response.data['token']);
            $location.path("/dashboard/admin");
        }
        else {
            console.log('Error new admin : '+response.data);
        }
    };

    self.submitNewAdminForm = function(isValid) {
        if(isValid) {
            createNewAdmin.signUp(self.new_admin_username,self.new_admin_password,self.callbackNewAdmin);
        }
    }


}]);

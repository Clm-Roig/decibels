angular.module('Decibels').controller('adminController',
    ['$http','$cookies','$location', '$timeout', 'login','createNewAdmin', '$scope', 'currentTab', 'style',
    function($http, $cookies, $location, $timeout, login, createNewAdmin, $scope, currentTab, style) {

    // ========= INITIALISATION ========= //
    var self = this;
    self.isRoot = $cookies.get('isRoot');
    currentTab.setCurrentTab(0);

    // ========= FUNCTIONS ========= //
    // Check for valid token
    self.callbackAlreadyLoggedIn = function(success,response) {
        if(!success) {
            $scope.changeShowDisconnectButton(true);
            $location.path("/");
        }
        else { 
            // We're logged in, display Disconnect button
            $scope.changeShowDisconnectButton(true);
        }
    };
    login.amILogged(self.callbackAlreadyLoggedIn);

    // Submit addStyleForm
    self.submitMessage = "";
    callbackAddStyle = function(success,response) {
        if(success) {
            self.new_style_name = null;
            self.submitMessage = "Style enregistré !";
            $timeout(function () { self.submitMessage = ""; }, 3000);
        }
        else {
            if(response.status == 400) {
                self.submitMessage = "Echec de l'enregistrement, requête invalide.";
            }
            else {
                self.submitMessage = "Echec de l'enregistrement, le style est déjà répertorié.";
            }
            $timeout(function () { self.submitMessage = ""; }, 3000);
        }
    };

    self.submitAddStyleForm = function(isValid) {
        if(isValid) {
            style.insertStyle(self.new_style_name,callbackAddStyle);
        }
        else {

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

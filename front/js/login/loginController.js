angular.module('Decibels').controller('loginController', [
    '$http', 'currentTab', 'login', '$cookies',
function($http, currentTab, login, $cookies) {
    var self = this;
    currentTab.setCurrentTab(0);

    // ==== Submit login form ==== //
    self.callback = function(success,response) {
        if(success) {
            $cookies.put('token',response);
        }
        else {
            console.log('Error log in : '+response.status);
        }
    };

    self.submitForm = function(isValid) {
        if(isValid) {
            login.signIn(self.admin_username,self.admin_password,self.callback);
        }
    }

}]);

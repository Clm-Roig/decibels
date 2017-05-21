angular.module('Decibels').controller('loginController', [
    '$http', 'currentTab', 'login',
function($http, currentTab, login) {
    var self = this;
    currentTab.setCurrentTab(0);

    // ==== Submit form ==== //
    self.callback = function(success,response) {
        if(success) {
            self.token = response.data;
        }
        else {
            console.log('Error log in : '+response.data);
        }
    };

    self.submitForm = function(isValid) {
        if(isValid) {
            login.signIn(self.admin_username,self.admin_password,self.callback);
        }
    }



}]);

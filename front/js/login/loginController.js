angular.module('Decibels').controller('loginController', [
    '$http', 'currentTab', 'login', 'createNewAdmin',
function($http, currentTab, login, createNewAdmin) {
    var self = this;
    currentTab.setCurrentTab(0);

    // ==== Submit login form ==== //
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

    // ==== Submit new Admin form ==== //
    self.callbackNewAdmin = function(success,response) {
        if(success) {
            self.token = response.data;
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

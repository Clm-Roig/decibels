angular.module('Decibels').controller('loginController', [
    '$http', 'currentTab', 'login',
function($http, currentTab, login) {
    var self = this;
    currentTab.setCurrentTab(0);

    // ==== Submit form ==== //
    self.submitForm = function(isValid) {
        if(isValid) {
            if(login.signIn(self.username,self.password)) {
                alert('Authentification réussie !');
            }
            else {
                alert('Authentification ratée...');
            }
        }
    }

}]);

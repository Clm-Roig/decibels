angular.module('Decibels').controller('loginController',
['currentTab', 'login', '$cookies','$location',
function(currentTab, login, $cookies, $location) {
    var self = this;
    currentTab.setCurrentTab(0);

    // ==== Submit login form ==== //
    self.callback = function(success,response) {
        if(success) {
            $cookies.put('token',response['token']);
            $cookies.put('isRoot',response['isRoot']);
            $location.path("/admin");
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

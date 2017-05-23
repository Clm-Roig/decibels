angular.module('Decibels')
.service('login',
    ['$http','$cookies', function($http,$cookies){
    var service = {
        signIn: function(username, password, callback) {

            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Admin',
                        'method': 'signIn',
                        'admin_username': username,
                        'admin_password': password
                }
            })
            .then(function success(response) {
                callback(true,response.data);
            }, function error(response) {
                callback(false,response);
            });
        },

        amILogged: function(callback) {

            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Admin',
                        'method': 'isAlreadyLoggedIn',
                        'token': $cookies.get('token')
                }
            })
            .then(function success(response) {
                callback(true);
            }, function error(response) {
                callback(false);
            });
        }
    };
    return service;
}]);

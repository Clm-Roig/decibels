angular.module('Decibels')
.service('login', ['$http', function($http){
    var service = {
        signIn: function(username, password, callback) {

            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Login',
                        'method': 'signIn',
                        'admin_username': username,
                        'admin_password': password
                }
            })
            .then(function success(response) {
                callback(true,response.data);
            }, function error(response) {
                callbak(false,response.data);
            });
        }
    };
    return service;
}]);

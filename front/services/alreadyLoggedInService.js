angular.module('Decibels')
.service('alreadyLoggedIn', ['$http','$cookies', function($http, $cookies){
    var service = {
        isAlreadyLoggedIn: function(callback) {

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

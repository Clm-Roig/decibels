angular.module('Decibels')
.service('login', ['$http', function($http){
    var service = {
        signIn: function(username, password, callback) {
            var data = {
                username: username,
                password: password
            };

            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Login',
                        'method': 'signIn',
                        'username': data['username'],
                        'password': data['password']
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

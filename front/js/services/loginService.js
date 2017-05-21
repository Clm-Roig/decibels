angular.module('Decibels')
.service('login', ['$http', function($http){
    var service = {
        signIn: function(username, password) {
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
                return true;
            },function error(response) {
                console.log('Error log in : ' + response.data);
                return false
            });

        }
    }
    return service;
}]);

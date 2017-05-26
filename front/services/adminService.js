angular.module('Decibels')
.service('admin', ['$http', function($http){
    var service = {
        createAdmin: function(username, password, callback) {

            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Admin',
                        'method': 'createAdmin',
                        'admin_username': username,
                        'admin_password': password
                }
            })
            .then(function success(response) {
                callback(true,response);
            }, function error(response) {
                callback(false,response);
            });
        }
    };
    return service;
}]);

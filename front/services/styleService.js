angular.module('Decibels')
.service('style', ['$http',
function($http){

    var service = {
        insertStyle: function(style_name,callback) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Style',
                            'method': 'insertStyle',
                            'style_name': style_name
                }
            })
            .then(function success(response){
                callback(true,response);
            }
            , function error(response) {
                callback(false,response);
            });
        },

        getAllStyles: function(callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Style',
                            'method': 'getAllStylesSorted'
                }
            })
            .then(function success(response){
                callback(true,response);
            }
            , function error(response) {
                callback(false,response);
            });
        }
    }
    return service;
}]);

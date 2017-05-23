angular.module('Decibels')
.service('bandService', ['$http',
function($http){

    var service = {
        getAllBands: function(callback) {
            // Get bands
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'getAllBandsSorted'
                }
            })
            .then(function success(response){
                callback(true,response);
            }
            , function error(response) {
                callback(false,response);;
            });
        }
    }
    return service;
}]);

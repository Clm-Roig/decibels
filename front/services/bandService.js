angular.module('Decibels')
.service('band', ['$http',
function($http){

    var service = {
        getAllBands: function(callback) {
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
        },

        getBandInfos: function(band_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'BandSheet',
                            'method': 'getBandInfos',
                            'band_id' : band_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getBandMembers: function(band_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'BandSheet',
                            'method': 'getBandMembers',
                            'band_id' : band_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getBandProductions: function(band_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'BandSheet',
                            'method': 'getBandProductions',
                            'band_id' : band_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        }
    }
    return service;
}]);

angular.module('Decibels')
.service('band', ['$http',
function($http){

    var service = {
        getAllBands: function(limit, offset, callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'getAllBandsSorted',
                            'limit': limit,
                            'offset': offset
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

        countBands: function(callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Band',
                        'method': 'countBands'
                }
            })
            .then(function success(response) {
                var nb_bands = "nb_bands";
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
        },

        deleteBand: function(band_id,callback) {
            $http({
                method: 'DELETE',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'deleteBand',
                            'band_id' : band_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        insertBandTemp: function(band_name,band_formed_in,band_style_id,callback) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'insertBandTemp',
                            'band_name': band_name,
                            'band_formed_in': band_formed_in,
                            'band_style_id': band_style_id
                }
            })
            .then(function success(response){
                callback(true,response);
            }
            , function error(response) {
                callback(false,response);
            });
        },

        insertBand: function(band_name,band_formed_in,band_style_id,callback) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'insertBand',
                            'band_name': band_name,
                            'band_formed_in': band_formed_in,
                            'band_style_id': band_style_id
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

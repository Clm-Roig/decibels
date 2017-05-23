angular.module('Decibels')
.service('production', ['$http',
function($http){

    var service = {
        getAllProductions: function(callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Production',
                        'method': 'getAllProductions'
                }
            })
            .then(function success(response){
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        countProductions: function(callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Production',
                        'method': 'countProductions'
                }
            })
            .then(function success(response){
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getProductionInfos: function(production_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'ProductionSheet',
                            'method': 'getProductionInfos',
                            'production_id' : production_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getProductionSongs: function(production_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'ProductionSheet',
                            'method': 'getProductionSongs',
                            'production_id' : production_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getProduction: function(production_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Production',
                        'method': 'getProduction',
                        'news_id': production_id
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

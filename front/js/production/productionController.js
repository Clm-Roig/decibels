angular.module('Decibels').controller('productionController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.productionId = $routeParams.productionId;

        // Production infos
        $http({
            method: 'GET',
            url: '/back/Routeur.php',
            params: {
                        'controller': 'ProductionSheet',
                        'method': 'getProductionInfos',
                        'production_id' : self.productionId
            }
        })
        .then(function success(response) {
            self.info = response.data;
            console.log(self.info);
        },function error(response) {
            console.log('Error getting production : ' + response.data);
        });

        // Songs of the production
        $http({
            method: 'GET',
            url: '/back/Routeur.php',
            params: {
                        'controller': 'ProductionSheet',
                        'method': 'getProductionSongs',
                        'production_id' : self.productionId
            }
        })
        .then(function success(response) {
            self.songs = response.data;
            console.log(self.songs);
        },function error(response) {
            console.log('Error getting songs : ' + response.data);
        });

}]);

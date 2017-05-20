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
            // Conversion song_length from sec to mm:ss
            for (index = 0; index < self.songs.length; ++index) {
                var min = self.songs[index]['song_length']/60 >> 0;
                var sec = self.songs[index]['song_length'] - 60*min;
                self.songs[index]['song_length'] = min +':'+ sec;
            }
        },function error(response) {
            console.log('Error getting songs : ' + response.data);
        });

}]);

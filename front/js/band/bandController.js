angular.module('Decibels').controller('bandController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.bandId = $routeParams.bandId;

        // Bands general infos
        $http({
            method: 'GET',
            url: '/back/Routeur.php',
            params: {
                        'controller': 'BandSheet',
                        'method': 'getBandInfos',
                        'band_id' : self.bandId
            }
        })
        .then(function success(response) {
            self.info = response.data;
            console.log(self.info);
        },function error(response) {
            console.log('Error getting band : ' + response.data);
        });

        // Members
        $http({
            method: 'GET',
            url: '/back/Routeur.php',
            params: {
                        'controller': 'BandSheet',
                        'method': 'getBandMembers',
                        'band_id' : self.bandId
            }
        })
        .then(function success(response) {
            self.members = response.data;
            console.log(self.members);
        },function error(response) {
            console.log('Error getting members : ' + response.data);
        });

        // Productions
        $http({
            method: 'GET',
            url: '/back/Routeur.php',
            params: {
                        'controller': 'BandSheet',
                        'method': 'getBandProductions',
                        'band_id' : self.bandId
            }
        })
        .then(function success(response) {
            self.productions = response.data;
            console.log(self.productions);
        },function error(response) {
            console.log('Error getting productions : ' + response.data);
        });

}]);

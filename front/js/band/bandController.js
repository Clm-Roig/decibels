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
                        'method': 'getBandSheet',
                        'band_id' : self.bandId
            }
        })
        .then(function success(response) {
            self.band = response.data;
        },function error(response) {
            console.log('Error getting band : ' + response.data);
        });

        // Members


        // Productions

}]);

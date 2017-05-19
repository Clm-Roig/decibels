angular.module('Decibels').controller('bandController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.bandId = $routeParams.bandId;

        var urlRequest = '/back/Routeur.php';
        $http({
            method: 'GET',
            url: urlRequest,
            params: {
                        'controller': 'Band',
                        'method': 'getBand',
                        'id' : self.bandId
            }
        })
        .then(function success(response) {
            self.band = response.data[0];
        },function error(response) {
            console.log('Error getting band : ' + response.data);
        });

}]);

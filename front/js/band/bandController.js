angular.module('Decibels').controller('bandController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.bandId = $routeParams.bandId;

        var urlRequest = '/back/Routeur.php?controller=Band&method=getBand&id=' + (self.bandId);
        $http({
            method: 'GET',
            url: urlRequest
        })
        .then(function success(response) {
            self.band = response.data[0];
            console.log(response.data);
        },function error(response) {
            console.log('Error getting band : ' + response.data);
        });

}]);

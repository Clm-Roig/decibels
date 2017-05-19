angular.module('Decibels').controller('gigController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.gigId = $routeParams.gigId;

        var urlRequest = '/back/Routeur.php?controller=Gig&method=getGig&id=' + (self.gigId);
        $http({
            method: 'GET',
            url: urlRequest
        })
        .then(function success(response) {
            self.gig = response.data[0];
            console.log(response.data);
        },function error(response) {
            console.log('Error getting gig : ' + response.data);
        });

}]);

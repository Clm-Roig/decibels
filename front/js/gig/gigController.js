angular.module('Decibels').controller('gigController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.gigId = $routeParams.gigId;

        $http({
            method: 'GET',
            url: '/back/Routeur.php',
            params: {
                    'controller': 'Gig',
                    'method': 'getGig';
                    'id': self.gigId
            }
        })
        .then(function success(response) {
            self.gig = response.data[0];
        },function error(response) {
            console.log('Error getting gig : ' + response.data);
        });

}]);

angular.module('Decibels').controller('nextGigsController', ['$http', function($http) {
    this.title = "Prochains concerts";

    var self = this;
    self.limit = 10;

    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                'controller': 'Gig',
                'method': 'getNextGigs',
                'limit': self.limit
        }
    })
    .then(function success(response) {
        self.listGigs = response.data;
    },function error(response) {
        console.log('Error getting next gigs : ' + response.data);
    });
}]);

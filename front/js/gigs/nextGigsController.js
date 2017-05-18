angular.module('Decibels').controller('nextGigsController', ['$http', function($http) {
    this.title = "Next Gigs";

    var self = this;
    self.limit = 10;

    var urlRequest = '/back/Routeur.php?controller=Gig&method=getNextGigs&limit=' + (self.limit);
    $http({
        method: 'GET',
        url: urlRequest
    })
    .then(function success(response) {
        self.listGigs = response.data;
        console.log(response.data);
    },function error(response) {
        console.log('Error getting gigs : ' + response.data);
    });
}]);

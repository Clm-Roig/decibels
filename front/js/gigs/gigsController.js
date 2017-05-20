angular.module('Decibels').controller('gigsController', ['$http','currentTab', function($http,currentTab) {
    var self = this;
    currentTab.setCurrentTab(4);

    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                'controller': 'Gig',
                'method': 'getAllGigsSorted'
        }
    })
    .then(function success(response){
        self.listGigs = response.data;
    }
    , function error(response) {
        console.log('Error getting all gigs : ' + response);
    });
}]);

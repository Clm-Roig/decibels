angular.module('Decibels').controller('bandsController',
    ['$http', 'currentTab',
function($http, currentTab) {
    var self = this;
    currentTab.setCurrentTab(2);

    // Get bands
    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                    'controller': 'Band',
                    'method': 'getAllBandsSorted'
        }
    })
    .then(function success(response){
        self.listBands = response.data;
    }
    , function error(response) {
        console.log('Error getting all bands : ' + response);
    });

}]);

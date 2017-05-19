angular.module('Decibels').controller('bandsController', ['$http', 'currentTab', function($http, currentTab) {
    var self = this;
    currentTab.setCurrentTab(2);
    self.title = "Tous les groupes de Montpellier";

    $http({
        method: 'GET',
        url: '/back/Routeur.php?controller=Band&method=getAllBands'
    })
    .then(function success(response){
        self.listBands = response.data;
        console.log(response.data);
    }
    , function error(response) {
        console.log('Error getting all bands : ' + response);
    });
}]);

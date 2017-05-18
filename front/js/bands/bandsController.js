angular.module('Decibels').controller('bandsController', ['$http', function($http,) {
    var self = this;
    self.title = "All the bands";

    $http({
        method: 'GET',
        url: '/back/Routeur.php?controller=Band&method=getAllBands'
    })
    .then(function success(response){
        self.listBands = response.data;
        console.log(response.data);
    }
    , function error(response) {
        console.log('Error getting all bands : ' + response.data);
    });
}]);

angular.module('Decibels').controller('bandsController', ['$http', function($http) {
    var self = this;
    self.title = "All the bands";

    $http.get('/back/Routeur.php?controller=Band&method=getAllBands')
    .success(function(data){
        self.listBands = data;
    })
    .error(function(error) {
        console.log('Error getting all bands : ' + error);
    });

}]);

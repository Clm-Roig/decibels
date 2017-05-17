angular.module('Decibels').controller('bandsController', ['$http', function($http) {
    var myThis = this;
    myThis.title = "All the bands";

    $http.get('/back/Routeur.php?controller=Band&method=getAllBands')
    .success(function(data){
        myThis.listBands = data;
    })
    .error(function(error) {
        console.log('Error getting all bands : ' + error);
    });

}]);

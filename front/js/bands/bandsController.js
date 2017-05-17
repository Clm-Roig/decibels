angular.module('Decibels').controller('bandsController', ['$http', function($http) {
    var myThis = this;
    myThis.title = "All the bands";

    $http.get('/back/Routeur.php?controller=band&method=getAllBands')
    .success(function(data){
        listBands = data;
    });

}]);

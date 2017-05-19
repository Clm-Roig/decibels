angular.module('Decibels').controller('counterController', ['$http', function($http) {
    var self = this;
    self.count = {};

    // NB_BANDS
    var urlRequest = '/back/Routeur.php?controller=Band&method=countBands';
    $http({
        method: 'GET',
        url: urlRequest
    })
    .then(function success(response) {
        var nb_bands = "nb_bands";
        self.count[nb_bands] = response.data;
        console.log(response.data);
    },function error(response) {
        console.log('Error getting nb_bands : ' + response.data);
    });
}]);

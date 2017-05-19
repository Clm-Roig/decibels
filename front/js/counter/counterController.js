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
    },function error(response) {
        console.log('Error getting nb_bands : ' + response.data);
    });

    // NB_PRODS
    var urlRequest = '/back/Routeur.php?controller=Production&method=countProductions';
    $http({
        method: 'GET',
        url: urlRequest
    })
    .then(function success(response) {
        var nb_prods = "nb_prods";
        self.count[nb_prods] = response.data;
    },function error(response) {
        console.log('Error getting nb_prods : ' + response.data);
    });

    // NB_NEWS
    var urlRequest = '/back/Routeur.php?controller=News&method=countNews';
    $http({
        method: 'GET',
        url: urlRequest
    })
    .then(function success(response) {
        var nb_news = "nb_news";
        self.count[nb_news] = response.data;
    },function error(response) {
        console.log('Error getting nb_news : ' + response.data);
    });
}]);

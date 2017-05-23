angular.module('Decibels').controller('counterController',
['$http',
function($http) {
    var self = this;
    self.count = {};

    // NB_BANDS
    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                'controller': 'Band',
                'method': 'countBands'
        }
    })
    .then(function success(response) {
        var nb_bands = "nb_bands";
        self.count[nb_bands] = response.data;
    },function error(response) {
        console.log('Error getting nb_bands : ' + response.data);
    });

    // NB_PRODS
    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                'controller': 'Production',
                'method': 'countProductions'
        }
    })
    .then(function success(response) {
        var nb_prods = "nb_prods";
        self.count[nb_prods] = response.data;
    },function error(response) {
        console.log('Error getting nb_prods : ' + response.data);
    });

    // NB_NEWS
    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                'controller': 'News',
                'method': 'countNews'
        }
    })
    .then(function success(response) {
        var nb_news = "nb_news";
        self.count[nb_news] = response.data;
    },function error(response) {
        console.log('Error getting nb_news : ' + response.data);
    });
}]);

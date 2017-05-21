angular.module('Decibels').controller('latestNewsController', ['$http', function($http) {
    var self = this;
    self.limit = 5;

    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                'controller': 'News',
                'method': 'getLatestNews',
                'limit': self.limit
        }
    })
    .then(function success(response) {
        self.listNews = response.data;
    },function error(response) {
        console.log('Error getting latest news : ' + response.data);
    });
}]);

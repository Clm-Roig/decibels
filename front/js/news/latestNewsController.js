angular.module('Decibels').controller('latestNewsController',
    ['$http', 'cssInjector',
function($http, cssInjector) {
    var self = this;
    cssInjector.injectCss('/front/js/news/latestNews.css');
    self.limit = 10;

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

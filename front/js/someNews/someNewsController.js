angular.module('Decibels').controller('someNewsController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.newsId = $routeParams.newsId;

        $http({
            method: 'GET',
            url: '/back/Routeur.php',
            params: {
                    'controller': 'News',
                    'method': 'getNews',
                    'news_id': self.newsId
            }
        })
        .then(function success(response) {
            self.news = response.data[0];
        },function error(response) {
            console.log('Error getting news : ' + response.data);
        });

}]);

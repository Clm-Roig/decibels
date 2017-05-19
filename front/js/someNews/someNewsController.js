angular.module('Decibels').controller('someNewsController',
    ['$http','$routeParams', function($http,$routeParams) {
        var self = this;
        self.newsId = $routeParams.newsId;

        var urlRequest = '/back/Routeur.php?controller=News&method=getNews&id=' + (self.newsId);
        $http({
            method: 'GET',
            url: urlRequest
        })
        .then(function success(response) {
            self.news = response.data[0];
            console.log(response.data);
        },function error(response) {
            console.log('Error getting news : ' + response.data);
        });

}]);

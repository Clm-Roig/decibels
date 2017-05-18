angular.module('Decibels').controller('latestNewsController', ['$http', function($http) {
    this.title = "Latest News";

    var self = this;
    self.limit = 10;

    var urlRequest = '/back/Routeur.php?controller=News&method=getLatestNews&limit=' + (self.limit);
    $http({
        method: 'GET',
        url: urlRequest
    })
    .then(function success(response) {
        self.listNews = response.data;
        console.log(response.data);
    },function error(response) {
        console.log('Error getting band : ' + response.data);
    });
}]);

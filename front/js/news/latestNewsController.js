angular.module('Decibels').controller('latestNewsController', ['$http', function($http) {
    this.title = "Actualités";

    var self = this;
    self.limit = 5;

    var urlRequest = '/back/Routeur.php?controller=News&method=getLatestNews&limit=' + (self.limit);
    $http({
        method: 'GET',
        url: urlRequest
    })
    .then(function success(response) {
        self.listNews = response.data;
        console.log(response.data);
    },function error(response) {
        console.log('Error getting news : ' + response.data);
    });
}]);

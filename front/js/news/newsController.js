angular.module('Decibels').controller('newsController', ['$http','currentTab', function($http,currentTab) {
    var self = this;
    currentTab.setCurrentTab(3);
    self.title = "Toutes les actualités";

    $http({
        method: 'GET',
        url: '/back/Routeur.php?controller=News&method=getAllNews'
    })
    .then(function success(response){
        self.listNews = response.data;
        console.log(response.data);
    }
    , function error(response) {
        console.log('Error getting all news : ' + response);
    });
}]);

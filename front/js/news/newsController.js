angular.module('Decibels').controller('newsController', ['$http','currentTab', function($http,currentTab) {
    var self = this;
    currentTab.setCurrentTab(3);
    self.title = "All the news";
}]);

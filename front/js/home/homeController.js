angular.module('Decibels').controller('homeController', ['$http', 'currentTab', function($http,currentTab) {
    currentTab.setCurrentTab(1);
}]);

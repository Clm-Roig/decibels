angular.module('Decibels').controller('contactController', ['$http', 'currentTab', function($http, currentTab) {
    var self = this;
    currentTab.setCurrentTab(-1);
    self.title = "Contact";
}]);

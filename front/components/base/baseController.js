angular.module('Decibels').controller('baseController', [
    '$http', 'currentTab',
function($http, currentTab) {
    this.setCurrentTab = function(value) {
        currentTab.setCurrentTab(value);
    };
    this.isCurrentTab = function(value) {
        return currentTab.isCurrentTab(value);
    };

}]);

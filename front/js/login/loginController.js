angular.module('Decibels').controller('loginController', [
    '$http', 'currentTab',
function($http, currentTab) {
    currentTab.setCurrentTab(0);

}]);

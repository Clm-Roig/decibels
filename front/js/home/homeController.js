angular.module('Decibels').controller('homeController',
    ['$http', 'currentTab', 'cssInjector',
function($http, currentTab, cssInjector) {
    currentTab.setCurrentTab(1);
    cssInjector.injectCss("front/js/home/home.css");
}]);

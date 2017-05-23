angular.module('Decibels').controller('homeController',
['currentTab', 'cssInjector',
function(currentTab, cssInjector) {
    currentTab.setCurrentTab(1);
    cssInjector.injectCss("front/components/home/home.css");
}]);

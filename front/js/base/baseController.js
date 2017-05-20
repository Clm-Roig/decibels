angular.module('Decibels').controller('baseController', [
    '$http', 'currentTab', 'cssInjector',
function($http, currentTab, cssInjector) {

    cssInjector.injectCss("front/js/base/base.css");
    this.setCurrentTab = function(value) {
        currentTab.setCurrentTab(value);
    };
    this.isCurrentTab = function(value) {
        return currentTab.isCurrentTab(value);
    };

}]);

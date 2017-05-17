angular.module('Decibels').controller('baseController', ['$http', function($http) {
    this.activeTab = 1;

    this.setActiveTab = function(value) {
        this.activeTab = value;
    };
    this.isSelected = function(value) {
        return this.activeTab === value;
    };

}]);

angular.module('Decibels')
.service('currentTab',function(){
    var current;
    var service = {
        setCurrentTab: function(value) {
            current = value;
        },

        isCurrentTab: function(value) {
            return value == current;
        }
    }
    return service;
});

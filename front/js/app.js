angular.module('Decibels',[
    'ngRoute'
]).config(['$locationProvider', function($locationProvider){
    $locationProvider.html5Mode(true);
    $locationProvider.hashPrefix('!');
}])

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

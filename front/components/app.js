angular.module('Decibels',[
    'ngRoute', 'ngCookies'
]).config(['$locationProvider', function($locationProvider){
    $locationProvider.html5Mode(true);
    $locationProvider.hashPrefix('!');
}])
/*
.config(['$httpProvider', function ($httpProvider) {
        // enable http caching
       $httpProvider.defaults.cache = true;
}])
*/
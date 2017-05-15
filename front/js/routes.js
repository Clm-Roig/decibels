angular.module('Decibels',['ngRoute'])
.config(['$routeProvider',
    function($routeProvider){
        $routeProvider
        .when("/", {
            templateUrl : "views/index.html"
        })
        .otherwise({
            templateUrl : "views/index.html"
        });
    }


]);

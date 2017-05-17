angular.module('Decibels')
.config(['$routeProvider',
    function($routeProvider){
        $routeProvider
        .when('/', {
            templateUrl : 'front/js/home/home.html',
            controller: 'homeController'
        })
        .when('/bands', {
            templateUrl : 'front/js/bands/bands.html',
            controller: 'bandsController',
            controllerAs: 'bands'
        })
        .when('/latestNews', {
            templateUrl : 'front/js/news/latestNews.html',
            controller: 'latestNewsController'
        })
        .when('#', {
            redirectTo : '/'
        })
        .otherwise({
            redirectTo : '/'
        });
    }
]);

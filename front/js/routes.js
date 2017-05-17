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
        .when('/news', {
            templateUrl : 'front/js/news/news.html',
            controller: 'newsController'
        })
        .when('#', {
            redirectTo : '/'
        })
        .otherwise({
            redirectTo : '/'
        });
    }
]);

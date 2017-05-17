angular.module('Decibels')
.config(['$routeProvider',
    function($routeProvider){
        $routeProvider
        .when('/', {
            templateUrl : 'front/js/home/home.html',
        })
        .when('/band/:bandId', {
            templateUrl : 'front/js/band/band.html',
        })
        .when('/bands', {
            templateUrl : 'front/js/bands/bands.html',
        })
        .when('/news', {
            templateUrl : 'front/js/news/news.html',
        })
        .when('#', {
            redirectTo : '/'
        })
        .otherwise({
            redirectTo : '/'
        });
    }
]);

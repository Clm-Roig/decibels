angular.module('Decibels')
.config(['$routeProvider',
    function($routeProvider){
        $routeProvider
        .when('/', {
            templateUrl : 'front/js/home/home.html',
        })
        .when('/admin', {
            templateUrl : 'front/js/login/login.html',
        })
        .when('/band/:bandId', {
            templateUrl : 'front/js/band/band.html',
        })
        .when('/bands', {
            templateUrl : 'front/js/bands/bands.html',
        })
        .when('/contact', {
            templateUrl : 'front/js/contact/contact.html',
        })
        .when('/gig/:gigId', {
            templateUrl : 'front/js/gig/gig.html',
        })
        .when('/gigs', {
            templateUrl : 'front/js/gigs/gigs.html',
        })
        .when('/news/:newsId', {
            templateUrl : 'front/js/someNews/someNews.html',
        })
        .when('/news', {
            templateUrl : 'front/js/news/news.html',
        })
        .when('/production/:productionId', {
            templateUrl : 'front/js/production/production.html',
        })
        .when('#', {
            redirectTo : '/'
        })
        .otherwise({
            redirectTo : '/'
        });
    }
]);

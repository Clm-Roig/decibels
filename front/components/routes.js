angular.module('Decibels')
.config(['$routeProvider',
    function($routeProvider){
        $routeProvider

        // ==== Routes front-end ==== //
        .when('/', {
            templateUrl : 'front/components/home/home.html',
        })
        .when('/login', {
            templateUrl : 'front/components/login/login.html',
        })
        .when('/band/:bandId', {
            templateUrl : 'front/components/band/band.html',
        })
        .when('/bands', {
            templateUrl : 'front/components/bands/bands.html',
        })
        .when('/contact', {
            templateUrl : 'front/components/contact/contact.html',
        })
        .when('/admin', {
            templateUrl : 'front/components/admin/admin.html',
        })
        .when('/gig/:gigId', {
            templateUrl : 'front/components/gig/gig.html',
        })
        .when('/gigs', {
            templateUrl : 'front/components/gigs/gigs.html',
        })
        .when('/news/:newsId', {
            templateUrl : 'front/components/someNews/someNews.html',
        })
        .when('/news', {
            templateUrl : 'front/components/news/news.html',
        })
        .when('/production/:productionId', {
            templateUrl : 'front/components/production/production.html',
        })
        .when('#', {
            redirectTo : '/'
        })
        .when('/api', {
            templateUrl: '/api.php',
        })
        .otherwise({
            redirectTo : '/'
        });
    }
]);

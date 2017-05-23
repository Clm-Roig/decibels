angular.module('Decibels')
.service('gig', ['$http',
function($http){

    var service = {
        getAllGigs: function(callback) {
            // Get gigs
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Gig',
                        'method': 'getAllGigsSorted'
                }
            })
            .then(function success(response){
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getGig: function(gig_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'Gig',
                        'method': 'getGig',
                        'gig_id': gig_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        }
    }
    return service;
}]);

angular.module('Decibels').controller('gigController',
['$routeParams','gig',
function($routeParams,gig) {
    var self = this;
    self.gigId = $routeParams.gigId;

    // ==== LOAD data ==== //
    callbackGig = function(success,response) {
        if(success) self.gig = response.data;
        else console.log('Error getting gig : ' + response.data);
    }
    gig.getGig(self.gigId,callbackGig);

}]);

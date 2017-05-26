angular.module('Decibels').controller('nextGigsController',
['cssInjector','gig',
function(cssInjector, gig) {
    cssInjector.injectCss('/front/components/gigs/nextGigs.css');

    var self = this;
    self.limit = 10;

    // ==== LOAD data ==== //
    callbackNextGigs = function(success,response) {
        if(success) self.listGigs = response.data;
        else console.log('Error getting next gigs : ' + response.data);
    }
    gig.getNextGigs(self.limit, callbackNextGigs);

}]);

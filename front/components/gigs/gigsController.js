angular.module('Decibels').controller('gigsController',
['currentTab','gig',
function(currentTab, gig) {
    var self = this;
    currentTab.setCurrentTab(4);

    callbackAllGigs = function(success,response) {
        if(success) self.listGigs = response.data;
        else console.log('Error getting all gigs : ' + response.data);
    }
    gig.getAllGigs(callbackAllGigs);
    
}]);

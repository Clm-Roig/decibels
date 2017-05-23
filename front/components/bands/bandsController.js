angular.module('Decibels').controller('bandsController',
    ['currentTab','band',
function(currentTab, band) {
    var self = this;
    currentTab.setCurrentTab(2);

    callbackBands = function(success,response) {
        if(success) self.listBands = response.data;
        else console.log('Error getting all bands : ' + response);;
    }

    band.getAllBands(callbackBands);
}]);

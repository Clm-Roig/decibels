angular.module('Decibels').controller('bandsController',
    ['currentTab','band',
function(currentTab, band) {
    var self = this;

    currentTab.setCurrentTab(2);

    // Get list of bands (5 by 5)
    self.limit = 5;
    self.offset = 0;
    self.c = 0;
    self.listBands = {};
    self.bands = [];
    callbackBands = function(success,response) {
        if(success)  {
            self.bands = response.data;
            self.listBands[self.c] = self.bands;
            self.c++;
            self.offset += self.limit;

            if(self.bands.length == self.limit) {
                band.getAllBands(self.limit,self.offset,callbackBands);
            }
        }
        else console.log('Error getting all bands : ' + response);;
    }

    band.getAllBands(self.limit,self.offset,callbackBands);



}]);

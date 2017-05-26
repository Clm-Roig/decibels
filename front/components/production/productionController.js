angular.module('Decibels').controller('productionController',
['$routeParams','production',
function($routeParams, production) {
    var self = this;
    self.productionId = $routeParams.productionId;

    // ==== LOAD data ==== //
    // get production
    callbackProductionInfos = function(success,response) {
        if(success) self.info = response.data;
        else console.log('Error getting production : ' + response.data);
    }
    production.getProductionInfos(self.productionId,callbackProductionInfos);

    // get songs of the production
    callbackProductionSongs = function(success,response) {
        if(success) {
            self.songs = response.data;
            // Conversion song_length from sec to mm:ss
            for (index = 0; index < self.songs.length; ++index) {
                var min = self.songs[index]['song_length']/60 >> 0;
                var sec = self.songs[index]['song_length'] - 60*min;
                self.songs[index]['song_length'] = min +':'+ sec;
            }
        }
        else console.log('Error getting production songs : ' + response.data);
    }
    production.getProductionSongs(self.productionId,callbackProductionSongs);

}]);

angular.module('Decibels').controller('bandController',
['$http','$routeParams','band',
function($http, $routeParams, band) {
    var self = this;
    self.bandId = $routeParams.bandId;

    // Get Band Infos
    callbackBandInfos = function(success,response) {
        if(success) self.info = response.data;
        else console.log('Error getting band infos : ' + response);;
    }

    band.getBandInfos(self.bandId,callbackBandInfos);

    // Get Band Members
    callbackBandMembers = function(success,response) {
        if(success) self.members = response.data;
        else console.log('Error getting band members : ' + response);;
    }

    band.getBandMembers(self.bandId,callbackBandMembers);

    // Get band Productions
    callbackBandProductions = function(success,response) {
        if(success) self.productions = response.data;
        else console.log('Error getting band productions : ' + response);;
    }

    band.getBandProductions(self.bandId,callbackBandProductions);

}]);

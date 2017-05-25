angular.module('Decibels').controller('bandController',
['$http','$routeParams','band','style','prodType','production', '$timeout', '$location',
function($http, $routeParams, band, style, prodType, production, $timeout, $location) {
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

    // Load all styles
    callbackAllStyles = function(success,response) {
        if(success) {
            self.listStyles = response.data;
        }
        else { 
            console.log('Error getting all styles : '+response.data);
        }
    };
    style.getAllStyles(callbackAllStyles);

    // Load all prod types
    callbackAllProdTypes = function(success,response) {
        if(success) {
            self.listProdTypes = response.data;
        }
        else { 
            console.log('Error getting all prod types : '+response.data);
        }
    };
    prodType.getAllProdTypes(callbackAllProdTypes);

    // ==== SUBMIT FORM ==== //
    self.submitProductionMessage = "";
    self.production_date = new Date();
    callbackAddProduction = function(success,response) {
        if(success) {
            self.production_name = null;
            self.production_prod_type_id = null;
            self.production_date = null;
            self.production_style_id = null;
            self.submitProductionMessage = "Production enregistrée !";

            // Mise à jour de la liste des productions du groupe
            band.getBandProductions(self.bandId,callbackBandProductions);

            $timeout(function () { self.submitProductionMessage = ""; }, 3000);
        }
        else {
            if(response.status == 400) {
                self.submitProductionMessage = "Echec de l'enregistrement, requête invalide.";
            }
            $timeout(function () { self.submitProductionMessage = ""; }, 3000);
        }
    };

    self.submitNewProductionForm = function(isValid) {
        if(isValid) {
            production.insertProduction(self.bandId,self.production_name,self.production_prod_type_id,self.production_date,self.production_style_id, callbackAddProduction);
        }
    };



    // ==== DELETE BAND ==== //
    callbackDeleteBand = function(success,response) {
        if(success) {
            $location.path("/bands");
        }
        else {
        }
    };

    self.deleteBand = function() {
        band.deleteBand(self.bandId, callbackDeleteBand);
    };



}]);

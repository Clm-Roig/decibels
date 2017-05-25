angular.module('Decibels').controller('submitBandController',
    ['$http','cssInjector','$timeout','band',
function($http,cssInjector,$timeout,band) {
    var self = this;
    cssInjector.injectCss("front/components/bands/bands.css");

    // ==== Submission Form ==== //
    self.formData = {};
    self.submitControl = "Groupe soumis, merci !";
    self.messageClass = "hidden-control-message";

    // Submit new band form;
    callbackSubmitBand = function(success,response) {
        if(success) {
            self.formData['band_name'] = null;
            self.formData['band_style_name'] = null;
            self.formData['band_formed_in'] = null;
            self.submitControl = "Groupe soumis, merci !";
            self.messageClass = "temp-visible-control-message";
            $timeout(function () { self.messageClass = "hidden-control-message"; }, 3000);
        }
        else {
            self.submitControl = "Erreur lors de la soumission, veuillez réessayer.";
            self.messageClass = "temp-visible-control-message";
            $timeout(function () { self.messageClass = "hidden-control-message"; }, 3000);
        }
    };

    self.submitForm = function(isValid) {
        if(isValid) {
            band.insertBandTemp(self.formData['band_name'],self.formData['band_formed_in'],self.formData['band_style_name'],callbackSubmitBand);
        }
    }

}]);

angular.module('Decibels').controller('submitBandController',
    ['$http','cssInjector','$timeout',
function($http,cssInjector,$timeout) {
    var self = this;
    cssInjector.injectCss("front/components/bands/bands.css");

    // ==== Submission Form ==== //
    self.formData = {};
    self.submitControl = "Groupe soumis, merci !";
    self.messageClass = "hidden-control-message";

    self.submitForm = function(isValid) {
        if(isValid) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'insertBandTemp',
                            'band_name': self.formData['band_name'],
                            'band_style_name': self.formData['band_style_name'],
                            'band_formed_in': self.formData['band_formed_in']
                }
            })
            .then(function success(response){
                self.formData['band_name'] = null;
                self.formData['band_style_name'] = null;
                self.formData['band_formed_in'] = null;

                self.submitControl = "Groupe soumis, merci !";
                self.messageClass = "temp-visible-control-message";
                $timeout(function () { self.messageClass = "hidden-control-message"; }, 3000);
            }
            , function error(response) {
                self.submitControl = "Erreur lors de la soumission, veuillez réessayer.";
                self.messageClass = "temp-visible-control-message";
                $timeout(function () { self.messageClass = "hidden-control-message"; }, 2000);

                console.log('Error inserting band : ' + response);
            });

        }
    }
}]);

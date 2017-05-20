angular.module('Decibels').controller('submitBandController',
    ['$http',
function($http) {
    var self = this;

    // Get Styles for submission
    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                    'controller': 'Style',
                    'method': 'getAllStylesSorted'
        }
    })
    .then(function success(response){
        self.listStyles = response.data;
        console.log(self.listStyles);
    }
    , function error(response) {
        console.log('Error getting all styles : ' + response);
    });

    // ==== Submission Form ==== //
    self.formData = {};
    self.sent = false;
    self.sentError = false;

    if(self.formValid)
    self.submitForm = function(isValid) {

        if(isValid) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'insertBand',
                            'params': self.formData
                }
            })
            .then(function success(response){
                self.formData['band_name'] = "";
                self.formData['band_style_id'] = "";
                self.formData['band_formed_in'] = "";
                self.sent = true;
                self.sentError = false;
            }
            , function error(response) {
                self.sentError = true;
                self.sent = false;
                console.log('Error inserting band : ' + response);
            });

        }
    }
}]);

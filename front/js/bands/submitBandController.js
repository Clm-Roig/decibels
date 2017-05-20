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
                console.log(self.formData);
                self.formData['band_name'] = null;
                self.formData['band_style_name'] = null;
                self.formData['band_formed_in'] = null;
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

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
    self.submitForm = function(isValid) {

        if(isValid) {
            console.log(self.formData);
            /*
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Band',
                            'method': 'insertBand'
                }
            })
            .then(function success(response){
                console.log(response.data);
            }
            , function error(response) {
                console.log('Error inserting band : ' + response);
            });
            */
        }
    }
}]);

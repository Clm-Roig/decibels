angular.module('Decibels').controller('adminController',
    ['$http','$cookies','$location', '$timeout',
    function($http, $cookies, $location, $timeout) {
    var self = this;
    if($cookies.get('token') != 'admin') {
        $location.path("/login");
    }

    // ==== Submit addStyleForm ==== //
    self.submitMessage = "";
    self.submitAddStyleForm = function(isValid) {
        if(isValid) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'Style',
                            'method': 'insertStyle',
                            'style_name': self.new_style_name
                }
            })
            .then(function success(response){
                self.new_style_name = null;
                self.submitMessage = "Style enregistré !";
                $timeout(function () { self.submitMessage = ""; }, 3000);
            }
            , function error(response) {
                if(response.status == 400) {
                    self.submitMessage = "Echec de l'enregistrement, requête invalide.";
                }
                else {
                    self.submitMessage = "Echec de l'enregistrement, le style est déjà répertorié.";
                }
                $timeout(function () { self.submitMessage = ""; }, 3000);

                console.log('Error inserting style : ' + response);
            });

        }
    }


}]);

angular.module('Decibels')
.service('prodType', ['$http',
function($http){

    var service = {
        insertProdType: function(prod_type_name,callback) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'ProdType',
                            'method': 'insertProdType',
                            'prod_type_name': prod_type_name
                }
            })
            .then(function success(response){
                callback(true,response);
            }
            , function error(response) {
                callback(false,response);
            });
        },

        getAllProdTypes: function(callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                            'controller': 'ProdType',
                            'method': 'getAllProdTypesSorted'
                }
            })
            .then(function success(response){
                callback(true,response);
            }
            , function error(response) {
                callback(false,response);
            });
        }
    }
    return service;
}]);

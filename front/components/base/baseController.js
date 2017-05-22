angular.module('Decibels').controller('baseController', [
    '$http', 'currentTab', '$cookies', '$location','$scope',
function($http, currentTab, $cookies, $location, $scope) {

    // ========= INITIALISATION ========= //
    var self = this;

    self.showDisconnect = false;

    // Am I and admin logged in ?
    if($cookies.get("token")) {
        self.showDisconnect = true;
    }

    // ========= FUNCTIONS ========= //

    // Disconnect
    self.disconnect = function() {
        $cookies.remove("token");
        $cookies.remove("isRoot");
        self.showDisconnect = false;
        $location.path("/");
    }

    $scope.changeShowDisconnectButton = function(value) {
        self.showDisconnect = value;
    }

    this.setCurrentTab = function(value) {
        currentTab.setCurrentTab(value);
    };
    this.isCurrentTab = function(value) {
        return currentTab.isCurrentTab(value);
    };

}]);

angular.module('Decibels').controller('baseController',
['currentTab', '$cookies', '$location','$scope',
function(currentTab, $cookies, $location, $scope) {

    // ========= INITIALISATION ========= //
    var self = this;

    self.showToAdmin = false;

    // Am I an admin logged in ?
    if($cookies.get("token")) {
        self.showToAdmin = true;
    }

    // ========= FUNCTIONS ========= //

    // Disconnect
    self.disconnect = function() {
        $cookies.remove("token");
        $cookies.remove("isRoot");
        self.showToAdmin = false;
        $location.path("/");
    }

    $scope.changeShowToAdminButton = function(value) {
        self.showToAdmin = value;
    }

    this.setCurrentTab = function(value) {
        currentTab.setCurrentTab(value);
    };
    this.isCurrentTab = function(value) {
        return currentTab.isCurrentTab(value);
    };


}]);

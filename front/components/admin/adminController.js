angular.module('Decibels').controller('adminController',
['$cookies','$location', '$timeout', 'login','admin', '$scope', 'currentTab', 'style','band','news',
function($cookies, $location, $timeout, login, admin, $scope, currentTab, style, band, news) {

    // ========= INITIALISATION ========= //
    var self = this;
    self.isRoot = $cookies.get('isRoot');
    currentTab.setCurrentTab(0);

    // ========= FUNCTIONS ========= //
    // Check for valid token
    callbackAlreadyLoggedIn = function(success,response) {
        if(success) {
            // We're logged in, display Disconnect button
            $scope.changeShowToAdminButton(true);
        }
        else { 
            $scope.changeShowToAdminButton(false);
            $location.path("/");
        }
    };
    login.amILogged(callbackAlreadyLoggedIn);

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

    // ==== Submit forms ==== //

    // Submit new News form
    self.submitNewsMessage = "";
    callbackAddNews = function(success,response) {
        if(success) {
            self.news_title = null;
            self.news_text = null;
            self.submitNewsMessage = "News enregistrée !";
            $timeout(function () { self.submitNewsMessage = ""; }, 3000);
        }
        else {
            self.submitNewsMessage = "Echec de l'enregistrement, requête invalide.";
            $timeout(function () { self.submitNewsMessage = ""; }, 3000);
        }
    };

    self.submitAddNewsForm = function(isValid) {
        if(isValid) {
            news.insertNews(self.news_title,self.news_text,callbackAddNews);
        }
    }

    // Submit addStyleForm
    self.submitStyleMessage = "";
    callbackAddStyle = function(success,response) {
        if(success) {
            self.new_style_name = null;
            self.submitStyleMessage = "Style enregistré !";

            // Mise à jour de la liste des styles disponibles
            style.getAllStyles(callbackAllStyles);

            $timeout(function () { self.submitStyleMessage = ""; }, 3000);
        }
        else {
            if(response.status == 400) {
                self.submitStyleMessage = "Echec de l'enregistrement, requête invalide.";
            }
            else {
                self.submitStyleMessage = "Echec de l'enregistrement, le style est déjà répertorié.";
            }
            $timeout(function () { self.submitStyleMessage = ""; }, 3000);
        }
    };

    self.submitAddStyleForm = function(isValid) {
        if(isValid) {
            style.insertStyle(self.new_style_name,callbackAddStyle);
        }
    }

    // Submit new Admin form
    self.submitAdminMessage = "";
    callbackNewAdmin = function(success,response) {
        if(success) {
            self.new_admin_username = null;
            self.new_admin_password = null;
            self.submitAdminMessage = "Administrateur enregistré !";
            $timeout(function () { self.submitAdminMessage = ""; }, 3000);
        }
        else {
            self.submitAdminMessage = "Echec de l'enregistrement, requête invalide.";
            $timeout(function () { self.submitAdminMessage = ""; }, 3000);
        }
    };

    self.submitNewAdminForm = function(isValid) {
        if(isValid) {
            admin.insertAdmin(self.new_admin_username,self.new_admin_password,callbackNewAdmin);
        }
    }

    // Submit new band form
    self.submitBandMessage = "";
    callbackNewBand = function(success,response) {
        if(success) {
            self.new_band_name = null;
            self.new_band_formed_in = null;
            self.new_band_style_id = null;
            self.submitBandMessage = "Groupe enregistré !";
            $timeout(function () { self.submitBandMessage = ""; }, 3000);
        }
        else {
            self.submitBandMessage = "Echec de l'enregistrement, requête invalide.";
            $timeout(function () { self.submitBandMessage = ""; }, 3000);
        }
    };

    self.submitNewBandForm = function(isValid) {
        if(isValid) {
            band.insertBand(self.new_band_name,self.new_band_formed_in,self.new_band_style_id,callbackNewBand);
        }
    }


}]);

angular.module('Decibels')
.service('cssInjector', function(){
    var service = {
        injectCss: function(pathToCss) {
            var ls = document.createElement('link');
            ls.rel= 'stylesheet';
            ls.href= pathToCss;
            document.getElementsByTagName('head')[0].appendChild(ls);
        }
    }
    return service;
 });

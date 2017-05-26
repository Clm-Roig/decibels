angular.module('Decibels').controller('someNewsController',
['$routeParams','news',
function($routeParams,news) {
        var self = this;
        self.newsId = $routeParams.newsId;

        // ==== LOAD data ==== //
        callbackSomeNews = function(success,response) {
            if(success) self.news = response.data;
            else console.log('Error getting the news : ' + response);;
        }
        news.getNews(self.newsId,callbackSomeNews);
}]);

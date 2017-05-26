angular.module('Decibels').controller('latestNewsController',
['cssInjector', 'news',
function(cssInjector, news) {
    var self = this;
    cssInjector.injectCss('/front/components/news/latestNews.css');

    self.limit = 10;
    // ==== LOAD data ==== //
    callbackLatestNews = function(success,response) {
        if(success) self.listNews = response.data;
        else console.log('Error getting latest news : ' + response.data);
    }
    news.getLatestNews(self.limit,callbackLatestNews);

}]);

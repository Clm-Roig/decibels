angular.module('Decibels').controller('newsController',
['currentTab', 'news',
function(currentTab, news) {
    var self = this;
    currentTab.setCurrentTab(3);

    callbackAllNews = function(success,response) {
        if(success) self.listNews = response.data;
        else console.log('Error getting all news : ' + response.data);
    }
    news.getAllNews(callbackAllNews);

}]);

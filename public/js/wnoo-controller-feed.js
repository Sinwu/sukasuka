angular.module('wnoo')

.controller('FeedController', ['$scope', '$timeout', 'Feed', function($scope, $timeout, Feed) {
  $scope.images = [1, 2, 3, 4, 5, 6, 7, 8];

  $scope.feed = new Feed();
  
  $scope.loadMore = function() {
    var last = $scope.images[$scope.images.length - 1];
    for(var i = 1; i <= 8; i++) {
      $scope.images.push(last + i);
    }
  };
  
}])
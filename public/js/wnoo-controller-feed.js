angular.module('wnoo')

.controller('FeedController', ['$scope', '$timeout', 'Feed', 'Post', function($scope, $timeout, Feed, Post) {
  $scope.images = [1, 2, 3, 4, 5, 6, 7, 8];

  $scope.feed = new Feed();
  $scope.post = new Post();
  
  $scope.loadMore = function() {
    var last = $scope.images[$scope.images.length - 1];
    for(var i = 1; i <= 8; i++) {
      $scope.images.push(last + i);
    }
  }

  $scope.postCreate = function() {
    var post = {
      content: $scope.postContent,
      type: 'post',
      destination: 'normal'
    }

    // Do post create
    $scope.post.create(post)
    .then(
      function(success) {
        var response = success.data
        if(response.ok) {
          $scope.clearPostWidget()

          // Need success toast
        } else {
          // Need failed toast
        }
        
        $scope.post.busy = false;
      },
      function(error) {
        alert('Something is wrong, please try again')
        $scope.post.busy = false;
      }
    );
  }

  $scope.clearPostWidget = function() {
    $scope.postContent = null
  }
  
}])
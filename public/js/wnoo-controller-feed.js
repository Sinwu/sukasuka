angular.module('wnoo')

.controller('FeedController', ['$scope', '$timeout', 'Feed', 'Post', 'Media', function($scope, $timeout, Feed, Post, Media) {
  $scope.showProgress = false

  $scope.feed = new Feed();
  $scope.post = new Post();
  $scope.media = new Media();

  $scope.postCreate = function() {
    var post = {
      content: $scope.postContent,
      type: getFileTypeCategory(),
      destination: 'normal'
    }

    var file = getPostMediaObject()
    showPostLoader(file != null)

    if(file) {
      $scope.media.upload(file)
      .then(function (success) {
        $timeout(function () {
          post.src = success.data.result[0].name
          file.result = success.data

          $scope.postSave(post)
        });
      }, function (error) {
        alert('Something is wrong, please try again')
        return
      }, function (evt) {
        file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
      })
    } else {
      $scope.postSave(post)
    }
  }
  
  $scope.postSave = function(post) {
    // Do post create
    $scope.post.create(post)
    .then(
      function(success) {
        var response = success.data
        if(response.ok) {
          $scope.clearPostWidget()

          // Reload feeds
          $scope.feed.reload()
          setTimeout(function() {
            $(window).scroll()
          }, 500)

          // Need success toast
        } else {
          // Need failed toast
        }
        
        hidePostLoader()
      },
      function(error) {
        alert('Something is wrong, please try again')
        hidePostLoader()
      }
    );
  }

  $scope.clearPostWidget = function() {
    $scope.postContent = null
    $scope.image = null
  }

  $scope.shareWrite = function() {
    $('.post.shape')
      .shape('set next side', '.write.side')
      .shape('flip left')
  }

  function getPostMediaObject() {
    var hasMedia = $scope.image || false

    if(!hasMedia) return null
    if($scope.image) return $scope.image
  }

  function getFileTypeCategory() {
    var hasMedia = $scope.image || false
    
    if(!hasMedia) return 'post'
    if($scope.image) return 'image'
  }

  function showPostLoader(isFile) {
    $('.loader-post').addClass('active')
    $scope.showProgress = isFile
  }

  function hidePostLoader() {
    $('.loader-post').removeClass('active')
    $scope.post.busy = false;
  }
  
}])
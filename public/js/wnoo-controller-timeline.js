angular.module('wnoo')

.controller('TimelineController', ['$scope', '$timeout', 'Post', 'Media', function($scope, $timeout, Post, Media) {
  $scope.pageID = $('#pageID').val()
  $scope.userID = $('#userID').val()
  $scope.tUserImage = $('#tUserImage').val()
  $scope.tUserGender = $('#tUserGender').val()
  $scope.userImage = $('#userImage').val()
  $scope.userGender = $('#userGender').val()
  $scope.showProgress = false
  $scope.postIsPublic = false

  $scope.post = new Post('timeline', $scope.pageID)
  $scope.media = new Media()

  $scope.image = null
  $scope.video = null

  $scope.postCreate = function() {
    var post = {
      content: $scope.postContent,
      type: getFileTypeCategory()
    }

    if ($scope.postIsPublic) {
      $.extend(post, {destination: 'normal'})
    } else {
      $.extend(post, {destination: 'wall', wallid: $scope.pageID})
    }

    // Return if nothing to post
    if(post.type == 'post' && !post.content) return

    var file = getPostMediaObject()
    showPostLoader(file != null)

    if(file) {
      $scope.media.upload(file)
      .then(function (success) {
        if(success.data.ok) {
          $timeout(function () {
            post.src = success.data.src
            file.result = success.data
            
            // Switch loader
            $scope.showProgress = false
            $scope.postSave(post)
          });
        } else {
          alert('Something is wrong, please try again')
        }
      }, function (error) {
        alert('Something is wrong, please try again')
        return
      }, function (evt) {
        $scope.uploadProgress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        $('#uploadProgress').progress({ percent: $scope.uploadProgress });
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
          $scope.post.reload()
          setTimeout(function() {
            $(window).scroll()
          }, 500)

          // Need success toast
        } else {
          // Need failed toast
        }
        
        hidePostLoader()
        $scope.cancelPost()
      },
      function(error) {
        alert('Something is wrong, please try again')
        hidePostLoader()
        $scope.cancelPost()
      }
    );
  }

  $scope.postMediaImage = function(file) {
    // VALIDATION HERE
    if(!file) return false

    $scope.image = file
    $scope.shareMediaImage()
    console.log(file)
  }

  $scope.postMediaVideo = function(file) {
    // VALIDATION HERE
    if(!file) return false

    $scope.video = file
    $scope.shareMediaVideo()
    console.log(file)
  }

  $scope.postComment = function(post) {
    if(!post || !post.commentContent) return
    post.comment(post.commentContent)
  }

  $scope.clearPostWidget = function() {
    $scope.postContent = null
    $scope.image = null
    $scope.video = null
    $scope.postIsPublic = false
  }

  $scope.cancelPost = function() {
    $scope.clearPostWidget()

    $('.post.write').transition('hide')
    $('.post.media.image').transition('hide')
    $('.post.media.video').transition('hide')

    $('.post.choice')
      .transition('show', '0ms')
  }

  $scope.shareWrite = function() {
    $('.post.choice').transition('hide')

    $('.post.write')
      .transition('show', '500ms')
  }

  $scope.shareMediaImage = function() {
    $('.post.choice').transition('hide')

    $('.post.media.image')
      .transition('show', '500ms')
  }

  $scope.shareMediaVideo = function() {
    $('.post.choice').transition('hide')

    $('.post.media.video')
      .transition('show', '500ms')
  }

  $scope.selfTimeline = function () {
    return $scope.userID == $scope.pageID
  }

  $scope.getTimelineUserImage = function() {
    if($scope.tUserImage) return $scope.tUserImage

    if($scope.tUserGender == 'm') {
      return '/images/user-default.png'
    } else {
      return '/images/user-default_female.png'
    }
  }

  $scope.getHostUserImage = function() {
    if($scope.userImage) return $scope.userImage

    if($scope.userGender == 'm') {
      return '/images/user-default.png'
    } else {
      return '/images/user-default_female.png'
    }
  }

  $scope.getUserImage = function(user) {
    if(user.src) return user.src

    if(user.gender == 'm') {
      return '/images/user-default.png'
    } else {
      return '/images/user-default_female.png'
    }
  }

  function getPostMediaObject() {
    var hasMedia = $scope.image || $scope.video || false

    if(!hasMedia) return null
    if($scope.image) return $scope.image
    if($scope.video) return $scope.video
  }

  function getFileTypeCategory() {
    var hasMedia = $scope.image || $scope.video || false
    
    if(!hasMedia) return 'post'
    if($scope.image) return 'image'
    if($scope.video) return 'video'
  }

  function showPostLoader(isFile) {
    $('.loader-post').addClass('active')
    if(isFile) {
      $('#uploadProgress').progress();
      $scope.uploadProgress = 0;
    }

    $scope.showProgress = isFile
  }

  function hidePostLoader() {
    $('.loader-post').removeClass('active')
    $scope.uploadProgress = 0;
    $scope.post.busy = false;
  }
  
}])
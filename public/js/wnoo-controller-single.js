angular.module('wnoo')

.controller('SingleController', ['$scope', '$timeout', 'Post', 'App', function($scope, $timeout, Post, App) {
  $scope.userImage = $('#userImage').val()
  $scope.userGender = $('#userGender').val()
  $scope.postID = $('#postID').val()

  $scope.post = new Post('feed')
  $scope.app = new App()

  angular.element(document).ready(function () {
    $scope.app.fetch()
    $scope.post.getSingle($scope.postID)
  });

  $scope.getPostContent = function(post) {
    var urlRegex = /((http(s)?|ftp|sftp):\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g;
    
    post.contentHtml = post.content.replace(urlRegex, function(url) {
      var protocolRegex = /(http(s)?|ftp|sftp):\/\//i;
      var hrefUrl = url
      if (!post.content.match(protocolRegex)){  
        hrefUrl = `//${url}`;
      }

      return '<a href="' + hrefUrl + '" target="_blank">' + url + '</a>';
    })
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
  
}])
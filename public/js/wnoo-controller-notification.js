angular.module('wnoo')

.controller('NotificationController', ['$scope', 'Notification', 'App', function($scope, Notification, App) {
  $scope.userImage = $('#userImage').val()
  $scope.userGender = $('#userGender').val()
  
  $scope.notification = new Notification()
  $scope.app = new App()
  
  angular.element(document).ready(function () {
    $scope.app.fetch()
  });

  $scope.getNotifLink = function(notif) {
    var dest = 'post'
    if(notif.action == 'posted') {
      dest = 'wall'
    }

    var hrefUrl = '/post/s/' + notif.post.id
    notif.link = '<a href="' + hrefUrl + '" target="_blank">' + dest + '</a>.';
  }

  $scope.getNotifDescription = function(action) {
    if(action == 'posted') {
      return 'on your wall.'
    } else if (action == 'comment'){
      return 'on your post.'
    } else {
      return 'your post.'
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

  $scope.getNotifDescription = function(action) {
    if(action == 'posted') {
      return 'on your'
    } else if (action == 'comment'){
      return 'on your'
    } else {
      return 'your'
    }
  }
}])
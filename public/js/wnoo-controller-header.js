angular.module('wnoo')

.controller('HeaderController', ['$scope', 'Notification', function($scope, Notification) {
  $scope.notification = new Notification()

  angular.element(document).ready(function () {
    $scope.notification.getSelf()
  });

  $scope.getNotifDescription = function(action) {
    if(action == 'posted') {
      return 'on your wall.'
    } else if (action == 'comment'){
      return 'on your post.'
    } else {
      return 'your post.'
    }
  }
}])
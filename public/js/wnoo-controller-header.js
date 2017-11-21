angular.module('wnoo')

.controller('HeaderController', ['$scope', 'Notification', function($scope, Notification) {
  $scope.notification = new Notification()

  angular.element(document).ready(function () {
    $scope.notification.getSelf()
  });

  $scope.getNotifDescription = function(action) {
    if(action == 'post') {
      return 'on your wall.'
    } else {
      return 'your post.'
    }
  }
}])
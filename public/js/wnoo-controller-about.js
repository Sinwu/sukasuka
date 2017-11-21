angular.module('wnoo')

.controller('AboutController', ['$scope', '$timeout', function($scope, $timeout) {
  $scope.tUserImage = $('#tUserImage').val()
  $scope.tUserGender = $('#tUserGender').val()

  $scope.getAboutUserImage = function() {
    if($scope.tUserImage) return $scope.tUserImage

    if($scope.tUserGender == 'm') {
      return '/images/user-default.png'
    } else {
      return '/images/user-default_female.png'
    }
  }

}])
angular.module('wnoo')

.controller('AboutController', ['$scope', '$timeout', '$http', function($scope, $timeout, $http) {
  $scope.userID = $('#userID').val()
  $scope.tUserID = $('#tUserID').val()
  $scope.tUserImage = $('#tUserImage').val()
  $scope.tUserGender = $('#tUserGender').val()
  $scope.profile = {}
  $scope.isEmployee = false

  angular.element(document).ready(function () {
    $scope.load()
  });

  $scope.load = function() {
    $http.get(`/api/internal/integrate/profile/${$scope.tUserID}`)
    .then(
      function(success){
        console.log(success)

        $scope.isEmployee = success.data.ok
        if($scope.isEmployee) $scope.profile = success.data.profile
        
        console.log($scope.profile)
        $('#loader').removeClass('active')
      },
      function(error) {
        $('#loader').removeClass('active')
        alert('Something is wrong, please try again')
      }
    )
  }

  $scope.getAboutUserImage = function() {
    if($scope.tUserImage) return $scope.tUserImage

    if($scope.tUserGender == 'm') {
      return '/images/user-default.png'
    } else {
      return '/images/user-default_female.png'
    }
  }

  $scope.selfAbout = function () {
    return $scope.userID == $scope.tUserID
  }
}])
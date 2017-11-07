angular.module('wnoo')

.controller('EditProfileController', ['$scope', '$http', '$window', function($scope, $http, $window) {
  $scope.userBirthday = new Date($('#userBirthday').val())

  // Default values
  $scope.name = $('#userName').val()
  $scope.about = $('#userAbout').val()
  $scope.gender = $('#userGender').val()
  if($scope.userBirthday != 'Invalid Date') {
    $scope.birthDate = $scope.userBirthday.getDate()
    $scope.birthMonth = $scope.userBirthday.getMonth() + 1
    $scope.birthYear = $scope.userBirthday.getFullYear()
  }

  $scope.dates = [
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
    11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
    21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31
  ]

  $scope.months = [
    1, 2, 3, 4, 5, 6,
    7, 8, 9, 10, 11, 12
  ]

  $scope.monthStrings = [
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
  ]

  $scope.years = function() {
    var currentYear = new Date().getFullYear()
    var _years = []

    for (i = -70; i <= 0; i++) { 
      _years.push(currentYear + i)
    }

    return _years
  }

  $scope.update = function() {
    $scope.loginError = false
    showLoader()

    var profile = {
      name: $scope.name,
      gender: $scope.gender,
      about: $scope.about
    }

    if ($scope.birthDate && $scope.birthMonth && $scope.birthYear) {
      $.extend(profile, {birthday: `${$scope.birthDate} ${$scope.monthStrings[$scope.birthMonth - 1]} ${$scope.birthYear}`})
    }

    $http.post('/api/internal/user/update', profile)
    .then(
      function(success) {
        if(success) {
          console.log(success)
        } else {
          alert('need to handle this success error')
        }
        hideLoader()
      },
      function(error) {
        alert('Please check your internet connection')
        hideLoader()
      }
    );
  }

  function showLoader() {
    $('#loader').addClass('active')
  }

  function hideLoader() {
    $('#loader').removeClass('active')
  }

}])
angular.module('wnoo-login',[])

.controller('LoginController', ['$scope', '$http', '$window', function($scope, $http, $window) {

  // Default values
  $scope.regGender = 'm'
  $scope.loginError = false
  $scope.registerError = false
  $scope.registerErrorMessage = ''
  $scope.registerSuccess = false

  $scope.dates = [
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
    11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
    21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31
  ]

  $scope.months = [
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

  $scope.login = function() {
    $scope.loginError = false
    showLoader('Logging you in.')

    $http.post('/login', {email: $scope.logEmail, password: $scope.logPass})
    .then(
      function(success) {
        console.log(success)
        if(success && success.statusText == 'OK') {
          $window.location.href = '/feed'
        } else {
          hideLoader()
          alert('need to handle this success error')
        }
      },
      function(error) {
        console.log(error)
        hideLoader()
        if(error && error.status == 422) {
          $scope.loginError = true
        } else {
          alert('Please check your internet connection')
        }
      }
    );
  }

  $scope.register = function() {
    hideRegisterError()
    showLoader('Logging you in.')

    var data = {
      email: $scope.regEmail,
      password: $scope.regPass,
      password_confirmation: $scope.regConfirm,
      name: $scope.regName,
      gender: $scope.regGender
    }

    if ($scope.regBirthDate && $scope.regBirthMonth && $scope.regBirthYear) {
      $.extend(data, {birthday: `${$scope.regBirthDate} ${$scope.regBirthMonth} ${$scope.regBirthYear}`})
    }

    $http.post('/register', data)
    .then(
      function(success) {
        if(success && success.statusText == 'OK') {
          // $window.location.href = '/feed'

          $scope.registerSuccess = true
          hideLoader()
        } else {
          hideLoader()
          alert('need to handle this success error')
        }
      },
      function(error) {
        hideLoader()
        if(error && error.status == 422) {
          showRegisterError(error)
        } else {
          alert('Please check your internet connection')
        }
      }
    );
  }

  function showRegisterError(error) {
    // Populate errors
    var errors = []
    angular.forEach(error.data.errors, function(value, key) {
      errors.push(value[0]);
    })

    $scope.registerErrorMessage = errors[0]
    $scope.registerError = true
  }

  function hideRegisterError() {
    $scope.registerErrorMessage = ''
    $scope.registerError = false
  }

  function showLoader(msg) {
    $('#loader').addClass('active')
    $('#loader .ui.text').html(msg)
  }

  function hideLoader() {
    $('#loader').removeClass('active')
  }

}])
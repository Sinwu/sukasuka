angular.module('wnoo-login',[])

.controller('LoginController', ['$scope', function($scope) {

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
    showLoader('Logging you in.')
  }

  function showLoader(msg) {
    $('#loader').addClass('active')
    $('#loader .ui.text').html(msg)
  }

  function hideLoader() {

  }

}])
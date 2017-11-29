angular.module('wnoo-redirect',[])

.controller('RedirectController', ['$scope', '$http', '$window', function($scope, $http, $window) {
  $scope.token  = $('#token').val()
  $scope.appsID = $('#appsID').val()

  $scope.app  = {}
  $scope.user = {}

  angular.element(document).ready(function () {
    console.log($scope.token)

    // Getting app details
    var url = `/api/internal/apps/${$scope.appsID}`;
    $http.get(url)
    .then(
      function(success){
        $scope.app  = success.data.app
        $scope.user = success.data.user
        console.log($scope.user)

        $scope.redirect()
      },
      function(error) {
      }
    )
  })

  $scope.redirect = function() {
    var headers = {
      'Authorization': `Bearer ${$scope.token}`
    }

    var data = {}

    var appHeaders = $scope.app.params.filter(function (p) {
      return p.type === 'header'
    })

    var appBody = $scope.app.params.filter(function (p) {
      return p.type === 'body'
    })

    // Populate Header
    angular.forEach(appHeaders, function(val, key) {
      headers[val.name] = val.value
    })

    // Populate Data
    angular.forEach(appBody, function(val, key) {
      data[val.name] = $scope.user[val.value]
    })
    
    console.log($scope.app)
    console.log(headers)
    console.log(data)

    // Do Redirect
    var req = {
      method: 'POST',
      url: $scope.app.url,
      headers: headers,
      data: data,
      timeout: 10000
    }
    console.log(req)
     
    $http(req).then(
      function(success) {
        console.log(success)

        // Redirecting
        $window.location.href = $scope.app.url
      },
      function(error) {
        console.log(error)
        alert('Something is wrong, please try again')
      }
    )
  }

}])
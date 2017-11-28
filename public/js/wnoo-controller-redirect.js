angular.module('wnoo-redirect',[])

.controller('RedirectController', ['$scope', '$http', function($scope, $http) {
  $scope.token  = $('#token').val()
  $scope.appsID = $('#appsID').val()

  angular.element(document).ready(function () {
    console.log($scope.token)

    // Getting app details
    var url = `/api/internal/apps/${$scope.appsID}`;
    $http.get(url)
    .then(
      function(success){
        console.log(success.data)
      },
      function(error) {
      }
    )
  })

}])
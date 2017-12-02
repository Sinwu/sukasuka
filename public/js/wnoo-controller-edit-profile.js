angular.module('wnoo')

.controller('EditProfileController', ['$scope', '$http', '$window', '$timeout', 'Media', function($scope, $http, $window, $timeout, Media) {
  $scope.media = new Media()

  $scope.showProfile = true
  $scope.updateSuccess = false
  $scope.updatePSuccess = false
  $scope.updatePError = false
  $scope.updatePErrorMessage = ''
  $scope.userBirthday = new Date($('#userBirthday').val())

  // Default values
  $scope.name = $('#userName').val()
  $scope.sso_id = $('#userSSOID').val()
  $scope.about = $('#userAbout').val()
  $scope.gender = $('#userGender').val()
  $scope.existingImage = $('#userImage').val()
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
    $scope.updateSuccess = false
    showLoader()

    var profile = {
      name: $scope.name,
      gender: $scope.gender,
      about: $scope.about,
      // sso_id: $scope.sso_id,
    }

    if ($scope.birthDate && $scope.birthMonth && $scope.birthYear) {
      $.extend(profile, {birthday: `${$scope.birthDate} ${$scope.monthStrings[$scope.birthMonth - 1]} ${$scope.birthYear}`})
    }

    if($scope.image) {
      $scope.media.profileUpload($scope.image)
      .then(function (success) {
        if(success.data.ok) {
          $timeout(function () {
            profile.src = success.data.src
            
            // Post update
            $scope.image = null
            $scope.existingImage = success.data.src
            $scope.save(profile)
          });
        } else {
          alert('Something is wrong, please try again')
        }
      }, function (error) {
        alert('Something is wrong, please try again')
        return
      }, function (evt) {
        // Loader event
      })
    } else {
      $scope.save(profile)
    }
  }

  $scope.save = function(profile) {
    $http.post('/api/internal/user/update', profile)
    .then(
      function(success) {
        if(success) {
          $scope.updateSuccess = true
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

  $scope.updateP = function() {
    $scope.updatePError = false
    $scope.updatePSuccess = false
    showLoader()

    var p = {
      oldPassword: $scope.oldP,
      newPassword: $scope.newP,
      newPassword_confirmation: $scope.newPConfirm
    }
    
    $http.post('/api/internal/user/updateP', p)
    .then(
      function(success) {
        if(success) {
          $scope.updatePSuccess = true
        } else {
          alert('need to handle this success error')
        }
        hideLoader()
        clearPassFields()
      },
      function(error) {
        hideLoader()
        clearPassFields()
        if(error && error.status == 422) {
          showUpdatePassError(error)
        } else if (error && error.status == 403) {
          showUpdatePassError()
        } else {
          alert('Please check your internet connection')
        }
      }
    );
  }

  $scope.getUserImage = function() {
    if($scope.existingImage) return $scope.existingImage

    if($scope.gender == 'm') {
      return '/images/user-default.png'
    } else {
      return '/images/user-default_female.png'
    }
  }

  function clearPassFields() {
    $scope.oldP = null
    $scope.newP = null
    $scope.newPConfirm = null
  }

  function showUpdatePassError(error) {
    if(error) {
      // Populate errors
      var errors = []
      angular.forEach(error.data.errors, function(value, key) {
        errors.push(value[0]);
      })

      $scope.updatePErrorMessage = errors[0]
    } else {
      $scope.updatePErrorMessage = 'Please enter correct old password'
    }
    
    $scope.updatePError = true
  }

  function showLoader() {
    $('#loader').addClass('active')
  }

  function hideLoader() {
    $('#loader').removeClass('active')
  }

}])
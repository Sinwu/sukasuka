angular.module('wnoo')

.factory('App', function($http) {
  var Apps = function() {
    this.busy = false
    this.checked = false
    this.apps = []
  };

  var url = `/api/internal/apps`;

  Apps.prototype.fetch = function(post) {
    if (this.busy) return
    this.busy = true
    this.checked = true

    $http.get(url)
    .then(
      function(success){
        this.apps = success.data.apps
        for (var i = 0; i < this.apps.length; i++) {
          this.apps[i].getURL = getURL(this.apps[i])
        }

        this.busy = false;
      }.bind(this),
      function(error) {
        this.busy = false;
      }
    )
  };

  Apps.prototype.isEmpty = function() {
    return this.apps.length < 1
  }

  var getURL = function(app) {
    return function() {
      return `/internalApp/redirect/${app.id}`
    }
  }

  return Apps;
});
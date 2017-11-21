angular.module('wnoo')

.factory('Notification', function($http) {
  var Notification = function() {
    this.busy  = false
    this.checked = false
    this.notifications = []
  };

  Notification.prototype.getSelf = function(post) {
    if (this.busy) return
    this.busy = true
    this.checked = true

    var url = `/api/internal/notification/self`;

    $http.get(url)
    .then(
      function(success){
        if(success.data.notifications.length > 0) {
          this.notifications = success.data.notifications
        }

        this.busy = false;
      }.bind(this),
      function(error) {
      }
    )
  };

  return Notification;
});
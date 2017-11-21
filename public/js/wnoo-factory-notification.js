angular.module('wnoo')

.factory('Notification', function($http) {
  var Notification = function() {
    this.busy  = false
    this.checked = false
    this.after = 0;
    this.init = false;
    this.load = false;
    this.stop = false;
    this.notifications = []
    this.unread = null
  };

  Notification.prototype.nextPage = function() {
    if (this.load || this.stop) return;
    this.init = false;
    this.load = true;

    var url = `/api/internal/notification/p/${this.after}`;

    $http.get(url)
    .then(
      function(success) {
        var notifications = success.data.notifications;
        var lastNotificationID = success.data.lastNotificationID;

        if(notifications.length < 1) {
          this.stop = true
          return
        }
        
        for (var i = 0; i < notifications.length; i++) {
          this.notifications.push(notifications[i]);
        }

        this.after = lastNotificationID
        if(notifications.length < 10) this.stop = true
        this.load = false;
      }.bind(this),
      function(error) {
      }
    );
  };

  Notification.prototype.getSelf = function() {
    if (this.busy) return
    this.busy = true
    this.checked = true

    var url = `/api/internal/notification/self`;

    $http.get(url)
    .then(
      function(success){
        if(success.data.notifications.length > 0) {
          this.notifications = success.data.notifications
          if(success.data.count > 0) this.unread = success.data.count
        }

        this.busy = false;
      }.bind(this),
      function(error) {
      }
    )
  };

  Notification.prototype.read = function() {
    var IDs = [];
    
    angular.forEach(this.notifications, function(notif, key) {
      if(!notif.read) {
        notif.read = true
        this.push(notif.id);
      }
    }, IDs);

    this.unread = this.unread - IDs.length

    if(this.unread < 1) this.unread = null
    if(IDs.length < 1) return

    var url = `/api/internal/notification/update`;

    $http.post(url, {notifs: angular.toJson(IDs)})
    .then(
      function(success){
      }.bind(this),
      function(error) {
      }
    )
  }

  return Notification;
});
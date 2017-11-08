angular.module('wnoo')

.factory('Media', function($http, $timeout, Upload) {
  var Media = function() {
    this.busy = false
  };

  Media.prototype.upload = function(file) {
    if (this.busy) return

    var url = `api/internal/media`;
    file.upload = Upload.upload({
      url: url,
      data: {file: file},
    });

    return file.upload
  };

  Media.prototype.profileUpload = function(file) {
    if (this.busy) return
    
    var url = `api/internal/media/profile`;
    file.upload = Upload.upload({
      url: url,
      data: {file: file},
    });

    return file.upload
  }

  return Media;
});
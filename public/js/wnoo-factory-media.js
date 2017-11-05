angular.module('wnoo')

.factory('Media', function($http, $timeout, Upload) {
  var Media = function() {
    this.busy = false
  };

  var url = `api/internal/media`;

  Media.prototype.upload = function(file) {
    if (this.busy) return

    file.upload = Upload.upload({
      url: url,
      data: {file: file},
    });

    return file.upload
  };

  return Media;
});
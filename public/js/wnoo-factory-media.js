angular.module('wnoo')

.factory('Media', function($http, $timeout, Upload) {
  var Media = function() {
    this.busy = false
  };

  Media.prototype.upload = function(file) {
    if (this.busy) return

    file.upload = Upload.upload({
      url: 'https://angular-file-upload-cors-srv.appspot.com/upload',
      data: {file: file},
    });

    return file.upload
  };

  return Media;
});
angular.module('wnoo')

.factory('Post', function($http) {
  var Post = function() {
    this.busy = false
  };

  Post.prototype.create = function(post) {
    if (this.busy) return
    this.busy = true

    var url = "api/internal/post"

    return $http.post(url, post)
  };

  return Post;
});
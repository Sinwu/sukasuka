angular.module('wnoo')

.factory('Like', function($http) {
  var Like = function() {
    this.busy = false
  };

  var url = `api/internal/like`;

  Like.prototype.send = function(post) {
    if (this.busy) return
    this.busy = true

    var like = {
      post: post.id,
      liked: post.liked
    }

    console.log(like)

    return $http.post(url, like)
    .then(
      function(success){
        console.log(success)

        if(success.data.liked) {
          post.likes++
        } else {
          post.likes--
        }

        post.liked = success.data.liked
        this.busy = false;
      }.bind(this),
      function(error) {
      }
    )
  };

  return Like;
});
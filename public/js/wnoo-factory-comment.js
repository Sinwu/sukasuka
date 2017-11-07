angular.module('wnoo')

.factory('Comment', function($http) {
  var Comment = function() {
    this.busy = false
  };

  var url = `api/internal/comment`;

  Comment.prototype.send = function(post, content) {
    if (this.busy) return
    this.busy = true
    post.busy = true

    var comment = {
      post: post.id,
      content: content
    }

    $http.post(url, comment)
    .then(
      function(success){
        // Push comment to post
        var c = {
          user: success.data.user,
          content: success.data.content
        }
        post.comments.push(c)

        // Clear comment
        post.commentContent = null
        this.busy = false;
        post.busy = false
      }.bind(this),
      function(error) {
      }
    )
  };

  return Comment;
});
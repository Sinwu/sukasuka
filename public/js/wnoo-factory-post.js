angular.module('wnoo')

.factory('Post', ['$http', 'Like', function($http, Like) {
  var Post = function(type) {
    this.type = type
    this.after = 0;
    this.posts = [];
    this.init = false;
    this.load = false;
    this.stop = false;

    this.busy = false;
  };

  var likeFactory = new Like()

  Post.prototype.reload = function() {
    this.after = 0;
    this.posts = [];
    this.init = true;
    this.load = false;
    this.stop = false;
  };

  Post.prototype.create = function(post) {
    if (this.busy) return
    this.busy = true

    var url = "api/internal/post"

    return $http.post(url, post)
  };

  Post.prototype.nextPage = function() {
    if (this.load || this.stop) return;
    this.init = false;
    this.load = true;

    var url = `api/internal/${this.type}/${this.after}`;

    $http.get(url)
    .then(
      function(success) {
        var posts = success.data.posts;

        if(posts.length < 1) {
          this.stop = true
          return
        }
        
        for (var i = 0; i < posts.length; i++) {
          // Define functions
          posts[i].isPost = getType(posts[i].type, 'post')
          posts[i].isImage = getType(posts[i].type, 'image')
          posts[i].isVideo = getType(posts[i].type, 'video')
          
          posts[i].like = postLike(posts[i])
          posts[i].liked = isLiked(posts[i].likes, success.data.requester)
          posts[i].likes = posts[i].likes.length
          
          posts[i].comments = []
          posts[i].comment = postComment(posts[i])

          this.posts.push(posts[i]);
        }
        
        this.after = this.posts[this.posts.length - 1].id;
        if(this.posts.length < 5) this.stop = true
        this.load = false;
      }.bind(this),
      function(error) {
      }
    );
  };

  var isLiked = function(likes, user) {
    var found = likes.find(function(l) { return l.user_id == user })
    return found != null
  }

  var getType = function(type, expected) {
    return function() {
      return type == expected
    }
  }

  var postComment = function(post) {
    return function(content) {
      var c = {
        user: {
          name: 'Stevie'
        },
        content: content
      }

      post.comments.push(c)
    }
  }

  var postLike = function(post) {
    return function() {
      likeFactory.send(post)
    }
  }

  return Post;
}]);
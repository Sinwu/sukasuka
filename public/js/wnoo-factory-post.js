angular.module('wnoo')

.factory('Post', ['$http', 'Like', 'Comment', function($http, Like, Comment) {
  var Post = function(type, tID) {
    this.tID = tID
    this.type = type
    this.after = 0;
    this.posts = [];
    this.init = false;
    this.load = false;
    this.stop = false;
    this.popular = false;

    this.busy = false;
  };

  var likeFactory = new Like()
  var commentFactory = new Comment()

  Post.prototype.reload = function(popular) {
    if(popular) {
      this.after = -1;
    } else {
      this.after = 0;
    }

    this.popular = popular
    this.posts = [];
    this.init = true;
    this.load = false;
    this.stop = false;
  };

  Post.prototype.create = function(post) {
    if (this.busy) return
    this.busy = true

    var url = "/api/internal/post"

    return $http.post(url, post)
  };

  Post.prototype.getSingle = function(id) {
    if(!id) return
    this.loag = true

    var url = `/api/internal/post/${id}`

    $http.get(url)
    .then(
      function(success) {
        var post = success.data.post;
        
        // Override comments
        post.comments = post.comments_

        // Define functions
        post.isPost = getType(post.type, 'post')
        post.isImage = getType(post.type, 'image')
        post.isVideo = getType(post.type, 'video')
        
        post.like = postLike(post)
        post.liked = isLiked(post.likes, success.data.requester)
        post.likes = post.likes.length
        
        post.comment = postComment(post)

        this.posts.push(post);
        this.load = false;
      }.bind(this),
      function(error) {
        console.log(error)
      }
    );
  }

  Post.prototype.nextPage = function() {
    if (this.load || this.stop) return;
    this.init = false;
    this.load = true;

    var url = `/api/internal/${this.type}/${this.after}`;

    $http.get(url)
    .then(
      function(success) {
        var posts = success.data.posts;
        var lastPostID = success.data.lastPostID;

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
          
          posts[i].comment = postComment(posts[i])

          // Extra filter
          if(this.popular) {
            var found = this.posts.find(function(p) { return p.id == posts[i].id })
            if(!found) this.posts.push(posts[i]);
          } else {
            this.posts.push(posts[i]);
          }
        }

        this.after = lastPostID
        if(posts.length < 5) this.stop = true
        this.load = false;
      }.bind(this),
      function(error) {
      }
    );
  };

  Post.prototype.nextTimelinePage = function() {
    if (this.load || this.stop) return;
    this.init = false;
    this.load = true;

    var url = `/api/internal/${this.type}/${this.tID}/${this.after}`;

    $http.get(url)
    .then(
      function(success) {
        var posts = success.data.posts;
        var lastPostID = success.data.lastPostID;

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
          
          posts[i].comment = postComment(posts[i])

          // Different
          organizeTimeline(this.posts, posts[i])
          // this.posts.push(posts[i]);
        }
        
        this.after = lastPostID
        if(posts.length < 5) this.stop = true
        this.load = false;
      }.bind(this),
      function(error) {
      }
    );
  };

  var organizeTimeline = function(posts, post) {
    var postDate = new Date(post.created_at)
    var postDateFormatted = `${postDate.getDate()}-${postDate.getMonth() + 1}-${postDate.getFullYear()}`

    var found = posts.find(function(p) { return p.dateString == postDateFormatted })
    if(found) {
      found.posts.push(post)
    } else {
      var tl = {
        dateString: postDateFormatted,
        timeago: post.timeago,
        posts: [
          post
        ]
      }

      posts.push(tl)
    }
  }

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
      if(!content) return
      commentFactory.send(post, content)
    }
  }

  var postLike = function(post) {
    return function() {
      likeFactory.send(post)
    }
  }

  return Post;
}]);
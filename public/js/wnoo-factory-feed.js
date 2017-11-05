angular.module('wnoo')

.factory('Feed', function($http) {
  var Feed = function() {
    this.after = 0;
    this.posts = [];
    this.init = false;
    this.busy = false;
    this.stop = false;
  };

  var dummy = {
    data: [
      {
        type: 'photo',
        chrono: '3 mins ago',
        image: 'http://placehold.it/1920x1280',
        content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        like: 20,
        user: {
          profile: {
            image: 'http://placehold.it/300x300',
            name: 'Alexis Clark'
          }
        },
        comments: [
          {
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud',
            user: {
              image: 'http://placehold.it/300x300',
              name: 'Diana'
            }
          },
          {
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud',
            user: {
              image: 'http://placehold.it/300x300',
              name: 'Felix Tan'
            }
          }
        ]
      }
    ]
  }

  Feed.prototype.reload = function() {
    this.after = 0;
    this.posts = [];
    this.init = true;
    this.busy = false;
    this.stop = false;
  }

  Feed.prototype.nextPage = function() {
    if (this.busy || this.stop) return;
    this.init = false;
    this.busy = true;

    var url = `api/internal/post/${this.after}`;

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
          posts[i].likes = Math.floor((Math.random() * 100))
          posts[i].comments = []
          posts[i].comment = postComment(posts[i])

          this.posts.push(posts[i]);
        }
        
        this.after = this.posts[this.posts.length - 1].id;
        if(this.posts.length < 5) this.stop = true
        this.busy = false;
      }.bind(this),
      function(error) {
      }
    );
  };

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
      console.log(post.comments)
    }
  }

  var postLike = function(post) {
    return function() {
      post.liked = !post.liked

      if (post.liked) {
        post.likes++
      } else {
        post.likes--
      }
      console.log(post.liked)
      console.log(post.likes)
    }
  }

  return Feed;
});
angular.module('wnoo')

.factory('Feed', function($http) {
  var Feed = function() {
    this.posts = [];
    this.busy = false;
    this.after = '';
  };

  var dummy = {
    data: [
      {
        type: 'photo',
        chrono: '3 mins ago',
        image: 'http://placehold.it/1920x1280',
        content: 'content here',
        like: 20,
        user: {
          profile: {
            image: 'http://placehold.it/300x300',
            name: 'Alexis Clark'
          }
        },
        comments: [
          {
            content: 'this is comment',
            user: {
              image: 'http://placehold.it/300x300',
              name: 'Diana'
            }
          }
        ]
      },
      {
        type: 'photo',
        chrono: '3 mins ago',
        image: 'http://placehold.it/1920x1280',
        content: 'content here',
        like: 20,
        user: {
          profile: {
            image: 'http://placehold.it/300x300',
            name: 'Linda Lohan'
          }
        },
        comments: [
          {
            content: 'this is comment',
            user: {
              image: 'http://placehold.it/300x300',
              name: 'Diana'
            }
          }
        ]
      },
      {
        type: 'photo',
        chrono: '3 mins ago',
        image: 'http://placehold.it/1920x1280',
        content: 'content here',
        like: 20,
        user: {
          profile: {
            image: 'http://placehold.it/300x300',
            name: 'John Doe'
          }
        },
        comments: [
          {
            content: 'this is comment',
            user: {
              image: 'http://placehold.it/300x300',
              name: 'Diana'
            }
          }
        ]
      },
      {
        type: 'photo',
        chrono: '3 mins ago',
        image: 'http://placehold.it/1920x1280',
        content: 'content here',
        like: 20,
        user: {
          profile: {
            image: 'http://placehold.it/300x300',
            name: 'Sophia Lee'
          }
        },
        comments: [
          {
            content: 'this is comment',
            user: {
              image: 'http://placehold.it/300x300',
              name: 'Diana'
            }
          }
        ]
      },
      {
        type: 'photo',
        chrono: '3 mins ago',
        image: 'http://placehold.it/1920x1280',
        content: 'content here',
        like: 20,
        user: {
          profile: {
            image: 'http://placehold.it/300x300',
            name: 'Anna Young'
          }
        },
        comments: [
          {
            content: 'this is comment',
            user: {
              image: 'http://placehold.it/300x300',
              name: 'Diana'
            }
          }
        ]
      }
    ]
  }

  Feed.prototype.nextPage = function() {
    if (this.busy) return;
    this.busy = true;

    var url = "http://httpbin.org/post";

    $http.post(url, dummy)
    .then(
      function(success) {
        var posts = success.data.json.data;
        
        for (var i = 0; i < posts.length; i++) {
          this.posts.push(posts[i]);
        }
        
        // this.after = this.posts[this.posts.length - 1].id;
        this.busy = false;
      }.bind(this),
      function(error) {
      }
    );
  };

  return Feed;
});
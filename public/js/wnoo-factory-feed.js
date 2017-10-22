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
      },
      {
        type: 'post',
        chrono: '3 mins ago',
        image: '',
        content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        like: 20,
        user: {
          profile: {
            image: 'http://placehold.it/300x300',
            name: 'Linda Lohan'
          }
        },
        comments: [
          {
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud',
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
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud',
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
          // Define functions
          posts[i].isPost = getType(posts[i].type, 'post')
          posts[i].isImage = getType(posts[i].type, 'photo')

          this.posts.push(posts[i]);
        }
        
        // this.after = this.posts[this.posts.length - 1].id;
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

  return Feed;
});
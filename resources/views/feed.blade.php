@extends('layouts.wnoo')

@section('content')
<div id="page-contents">
  <div class="feed container" ng-controller="FeedController as ctrl">
    <input id="userImage" type="hidden" value="{{ $user->src }}">
    <input id="userGender" type="hidden" value="{{ $user->gender }}">

    <div class="row">
      <!-- Newsfeed Common Side Bar Right
      ================================================= -->
      <div class="col-md-3 col-md-push-9">
        
        <div class="suggestions" id="sticky-sidebar">

          <div class="profile-card">
            <img ng-src="@{{getHostUserImage()}}" alt="user" class="profile-photo" />
            <h5><a href="/timeline/{{ $user->id }}" class="text-white">{{ $user->name }}</a></h5>
            <p class="text-white">Administrator</p>
          </div><!--profile card ends-->

          <div class="ui card internal segment">
            <div ng-show="app.busy" class="ui inverted active dimmer">
              <div class="ui loader"></div>
            </div>

            <h4 class="grey">Internal Applications</h4>
            <h5 ng-show="app.isEmpty() && !app.busy && app.checked" class="text-muted">No integrated Applications</h5>
            <div class="follow-user" ng-repeat="app in app.apps">
              <img ng-src="@{{app.icon_url}}" alt="" class="profile-photo-sm pull-left" />
              <div>
                <h5><a href="timeline">@{{app.name}}</a></h5>
                <p class="text-muted">@{{app.description}}</p>
              </div>
            </div>
            {{--  <div class="follow-user">
              <img src="data:image/jpeg;base64,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" alt="" class="profile-photo-sm pull-left" />
              <div>
                <h5><a href="timeline">Calendar</a></h5>
                <p href="#" class="text-muted">App Description</p>
              </div>
            </div>
            <div class="follow-user">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDMRhieU5G9Y8lD-jGRsgprbNzSkiW3XZ11pPQtXimwlVcqJJuLw" alt="" class="profile-photo-sm pull-left" />
              <div>
                <h5><a href="timeline">Another Application</a></h5>
                <p class="text-muted">App Description</p>
              </div>
            </div>
            <div class="follow-user">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3z7sF3hLVJLo-U9bNA7qVIcNeaJpATVsCWvFasTfnDdRBqY1B" alt="" class="profile-photo-sm pull-left" />
              <div>
                <h5><a href="timeline">More Application</a></h5>
                <p class="text-muted">App Description</p>
              </div>
            </div>  --}}
          </div>
            
        </div>
      </div>
      
      <div class="col-md-9 col-md-pull-3">

        <!-- Post Create Box
        ================================================= -->
        <div class="ui card segment create-post">

          {{--  Loader  --}}
          <div class="ui inverted dimmer loader-post">
            <div ng-show="showProgress">
              <div class="ui blue progress" id="uploadProgress">
                <div class="bar">
                  <div class="progress"></div>
                </div>
              </div>
              <h5 class="prgrs label">Uploading your files</h5>
            </div>
            <div ng-hide="showProgress">
              <div class="ui text loader">Posting</div>
            </div>
          </div>

          <form name="postForm">
            {{--  Choice side  --}}
            <div class="post choice">
              <div class="ui steps">
                <a class="step" ng-click="shareWrite()">
                  <i class="quote right blue icon"></i>
                  <div class="content">
                    <div class="title blue">Write</div>
                    <div class="description">Share your thoughts</div>
                  </div>
                </a>
                <a class="step" href="#" ngf-select="postMediaImage($file)" ng-model="image" name="image" ngf-pattern="'image/*'"
                  ngf-accept="'image/*'" ngf-max-size="5MB"
                  ngf-model-invalid="errorImage">
                  <i class="camera retro orange icon"></i>
                  <div class="content">
                    <div class="title orange">Upload</div>
                    <div class="description">Upload an image</div>
                  </div>
                </a>
                <a class="step" href="#" ngf-select="postMediaVideo($file)" ng-model="video" name="video" ngf-pattern="'video/*'"
                  ngf-accept="'video/*'" ngf-max-size="20MB"
                  ngf-model-invalid="errorVideo">
                  <i class="film purple icon"></i>
                  <div class="content">
                    <div class="title purple">Video</div>
                    <div class="description">Publish your videos</div>
                  </div>
                </a>
              </div>

            </div>

            <div class="post write" style="display: none">
              <textarea ng-model="postContent" name="content" id="contentTextArea" rows="2" class="form-control textarea" placeholder="Write your thought"></textarea>
              
              <button ng-click="cancelPost()" class="ui mini red button cancel">
                Cancel
              </button>
              <button ng-click="postCreate()" class="ui mini blue button post">
                Publish
              </button>
            </div>

            <div class="post media image" style="display: none">
              <div class="row">
                <div class="col-md-2">
                  <div class="thumbnail">
                    <img ngf-thumbnail="image" class="thumbnail" />
                  </div>
                </div>
                <div class="col-md-10 content">
                  <textarea ng-model="postContent" name="content" id="contentTextArea" rows="2" class="form-control textarea" placeholder="Tell something about your image"></textarea>
                </div>
              </div>

              <button ng-click="cancelPost()" class="ui mini red button cancel">
                Cancel
              </button>
              <button ng-click="postCreate()" class="ui mini blue button post">
                Publish
              </button>
            </div>

            <div class="post media video" style="display: none">
              <div class="row">
                <div class="col-md-2 video-description">
                  <i class="ui film purple icon huge"></i>
                  <h6>@{{ video.name }}</h6>
                </div>
                <div class="col-md-10 content">
                  <textarea ng-model="postContent" name="content" id="contentTextArea" rows="2" class="form-control textarea" placeholder="Tell something about your video"></textarea>
                </div>
              </div>

              <button ng-click="cancelPost()" class="ui mini red button cancel">
                Cancel
              </button>
              <button ng-click="postCreate()" class="ui mini blue button post">
                Publish
              </button>
            </div>
          </form>

        </div><!-- Post Create Box End-->

        <div class="ui popular card" style="padding-left: 1.5rem; max-width: 262px;">
          <div class="ui toggle checkbox">
            <input ng-model="popular" type="checkbox" ng-change="togglePopular()">
            <label style="color: #1678c2;">Popular Posts</label>
          </div>
        </div>

        <!-- Post Content
        ================================================= -->
        <div infinite-scroll='post.nextPage()' infinite-scroll-disabled='post.load' infinite-scroll-distance='2'>
          
          <div class="ui card post-content" ng-repeat="post in post.posts">
            <video ng-show="post.isVideo()" class="post-video" controls><source ng-src="@{{post.src}}" type="video/mp4"></video>
            <img ng-show="post.isImage()" ng-src="@{{post.src}}" alt="post-image" class="img-responsive post-image" />
            <div class="post-container">
              <img ng-src="@{{getUserImage(post.user)}}" alt="user" class="profile-photo-md pull-left" />
              <div class="post-detail">

                <div class="user-info">
                  <h5><a href="/timeline/@{{ post.user.id }}" class="profile-link">@{{ post.user.name }}</a></h5>
                  <p class="text-muted">Published @{{post.type == 'image' ? 'an' : 'a'}} @{{ post.type }} @{{ post.timeago }}</p>
                </div>
                <div class="reaction">
                  <div ng-click="post.like()" class="ui labeled mini button" tabindex="0">
                    <div ng-class="{white: !post.liked, red: post.liked}" class="ui mini button">
                      <i class="heart icon"></i> Like@{{ post.liked ? 'd' : '' }}
                    </div>
                    <a ng-class="{white: !post.liked, red: post.liked}" class="ui basic left pointing label">
                      @{{ post.likes }}
                    </a>
                  </div>
                </div>
                <div class="line-divider"></div>
                <div class="post-text">
                  <p> @{{ post.content }} </p>
                </div>
                <div class="line-divider"></div>

                <div ng-repeat="comment in post.comments" class="post-comment">
                  <img ng-src="@{{getUserImage(comment.user)}}" alt="" class="profile-photo-sm" />
                  <p><a href="/timeline/@{{ comment.user.id }}" class="profile-link">@{{ comment.user.name }} </a> @{{ comment.content }} </p>
                </div>
                <div class="post-comment">
                  <img ng-src="@{{getHostUserImage()}}" alt="" class="profile-photo-sm" />
                  <input ng-disabled="post.busy" ng-model="post.commentContent" type="text" class="form-control comment" placeholder="Post a comment">
                  <button ng-disabled="post.busy" ng-click="postComment(post)" class="ui mini blue button comment"> Comment </button>
                </div>

              </div>
            </div>
          </div>
        </div><!-- Post Content End-->

        <!-- Post Content
        ================================================= -->
        {{--  <div class="post-content">
          <img src="http://placehold.it/1920x1280" alt="post-image" class="img-responsive post-image" />
          <div class="post-container">
            <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline" class="profile-link">Alexis Clark</a> <span class="following">following</span></h5>
                <p class="text-muted">Published a photo about 3 mins ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Diana </a><i class="em em-laughing"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">John</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <input type="text" class="form-control" placeholder="Post a comment">
              </div>
            </div>
          </div>
        </div>

        <!-- Post Content
        ================================================= -->
        <div class="post-content">
          <video class="post-video" controls> <source src="videos/1.mp4" type="video/mp4"></video>
          <div class="post-container">
            <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline" class="profile-link">Sophia Lee</a> <span class="following">following</span></h5>
                <p class="text-muted">Updated her status about 33 mins ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 75</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 8</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
              </div>
              <div class="line-divider"></div>
                <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Olivia </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <i class="em em-anguished"></i> Ut enim ad minim veniam, quis nostrud </p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Sarah</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Linda</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <input type="text" class="form-control" placeholder="Post a comment">
              </div>
            </div>
          </div>
        </div>

        <!-- Post Content
        ================================================= -->
        <div class="post-content">
          <div class="post-container">
            <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline" class="profile-link">Linda Lohan</a> <span class="following">following</span></h5>
                <p class="text-muted">Published a photo about 1 hour ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 23</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 4</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p><i class="em em-thumbsup"></i> <i class="em em-thumbsup"></i> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Cris </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <i class="em em-muscle"></i></p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <input type="text" class="form-control" placeholder="Post a comment">
              </div>
            </div>
          </div>
        </div>

        <!-- Post Content
        ================================================= -->
        <div class="post-content">
          <img src="http://placehold.it/2000x1300" alt="post-image" class="img-responsive post-image" />
          <div class="post-container">
            <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline" class="profile-link">John Doe</a> <span class="following">following</span></h5>
                <p class="text-muted">Published a photo about 2 hour ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 39</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 2</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt</p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Brian </a>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Richard</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <input type="text" class="form-control" placeholder="Post a comment">
              </div>
            </div>
          </div>
        </div>

        <!-- Post Content
        ================================================= -->
        <div class="post-content">
          <div class="google-maps">
            <div id="map" class="map"></div>
          </div>
          <div class="post-container">
            <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline" class="profile-link">Sophia Lee</a> <span class="following">following</span></h5>
                <p class="text-muted"><i class="icon ion-ios-location"></i> Went to Niagara Falls today</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 17</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Sarah </a>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <i class="em em-blush"></i> <i class="em em-blush"></i> </p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <input type="text" class="form-control" placeholder="Post a comment">
              </div>
            </div>
          </div>
        </div>

        <!-- Post Content
        ================================================= -->
        <div class="post-content">
          <img src="http://placehold.it/1920x1160" alt="" class="img-responsive post-image" />
          <div class="post-container">
            <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline" class="profile-link">Anna Young</a> <span class="following">following</span></h5>
                <p class="text-muted">Published a photo about 4 hour ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 2</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>
              </div>
              <div class="line-divider"></div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">Julia </a>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
              </div>
              <div class="post-comment">
                <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <input type="text" class="form-control" placeholder="Post a comment">
              </div>
            </div>
          </div>
        </div>  --}}

        <div ng-show="post.init || (post.load && !post.stop)" class="ui feed load segment">
          <div class="ui active feed text loader">
            Getting your feed
          </div>
        </div>

        <div ng-show="post.stop" class="ui feed stop segment">
          <h5>End of your feed</h5>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script src="/js/ng-file-upload.min.js"></script>
<script src="/js/wnoo-controller-feed.js"></script>
@endsection
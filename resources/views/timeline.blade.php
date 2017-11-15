@extends('layouts.wnoo')

@section('content')
<div class="timeline container" ng-controller="TimelineController as ctrl">
  <input id="pageID" type="hidden" value="{{ $tUser->id }}">
  <input id="userID" type="hidden" value="{{ $user->id }}">
  <input id="tUserImage" type="hidden" value="{{ $tUser->src }}">
  <input id="tUserGender" type="hidden" value="{{ $tUser->gender }}">
  <input id="userImage" type="hidden" value="{{ $user->src }}">
  <input id="userGender" type="hidden" value="{{ $user->gender }}">

  <!-- Timeline
  ================================================= -->
  <div class="timeline">
    <div class="timeline-cover">

      <!--Timeline Menu for Large Screens-->
      <div class="timeline-nav-bar hidden-sm hidden-xs">
        <div class="row">
          <div class="col-md-3">
            <div class="profile-info">
              <img ng-src="@{{getTimelineUserImage()}}" alt="" class="img-responsive profile-photo" />
              <h3>{{ $tUser->name }}</h3>
              <p class="text-muted">Administrator</p>
            </div>
          </div>
          <div class="col-md-9">
            <ul class="list-inline profile-menu">
              <li><a href="/feed">Feed</a></li>
              <li><a href="/timeline/{{ $tUser->id }}">Timeline</a></li>
              <li><a href="/about/{{ $tUser->id }}">About Me</a></li>
            </ul>
            <ul class="follow-me list-inline">
              <li ng-show="selfTimeline()"><a href="/editbasic"><button class="btn-primary">Edit Profile</button></a></li>
            </ul>
          </div>
        </div>
      </div><!--Timeline Menu for Large Screens End-->

      <!--Timeline Menu for Small Screens-->
      <div class="navbar-mobile hidden-lg hidden-md">
        <div class="profile-info">
          <img ng-src="@{{getTimelineUserImage()}}" alt="" class="img-responsive profile-photo" />
          <h4>{{ $user->name }}</h4>
          <p class="text-muted">Administrator</p>
        </div>
        <div class="mobile-menu">
          <ul class="list-inline">
            <li><a href="/feed">Feed</a></li>
            <li><a href="/timeline/{{ $tUser->id }}">Timeline</a></li>
            <li><a href="/about/{{ $tUser->id }}">About Me</a></li>
          </ul>
          <button class="btn-primary">Edit Profile</button>
        </div>
      </div><!--Timeline Menu for Small Screens End-->

    </div>
    <div id="page-contents">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">

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
                      {{--  <div class="description">Share your thoughts</div>  --}}
                    </div>
                  </a>
                  <a class="step" href="#" ngf-select="postMediaImage($file)" ng-model="image" name="image" ngf-pattern="'image/*'"
                    ngf-accept="'image/*'" ngf-max-size="5MB"
                    ngf-model-invalid="errorImage">
                    <i class="camera retro orange icon"></i>
                    <div class="content">
                      <div class="title orange">Upload</div>
                      {{--  <div class="description">Upload an image</div>  --}}
                    </div>
                  </a>
                  <a class="step" href="#" ngf-select="postMediaVideo($file)" ng-model="video" name="video" ngf-pattern="'video/*'"
                    ngf-accept="'video/*'" ngf-max-size="20MB"
                    ngf-model-invalid="errorVideo">
                    <i class="film purple icon"></i>
                    <div class="content">
                      <div class="title purple">Video</div>
                      {{--  <div class="description">Publish your videos</div>  --}}
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

          <!-- Post Content
          ================================================= -->
          <div infinite-scroll='post.nextTimelinePage()' infinite-scroll-disabled='post.load' infinite-scroll-distance='2'>
          
            <div class="post-content" ng-repeat="time in post.posts">
              <!--Post Date-->
              <div class="post-date hidden-xs hidden-sm">
                <h5>@{{ time.dateString }}</h5>
                <p class="text-muted">@{{ time.timeago }}</p>
              </div><!--Post Date End-->

              <div class="ui card timeline" ng-repeat="post in time.posts">
                <video  ng-show="post.isVideo()" class="post-video" controls><source ng-src="@{{post.src}}" type="video/mp4"></video>
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
              </div><!--Post Card End-->

            </div>
          </div>


          {{--  <div class="post-content">

            <!--Post Date-->
            <div class="post-date hidden-xs hidden-sm">
              <h5>{{ $user->name }}</h5>
              <p class="text-grey">Sometimes ago</p>
            </div><!--Post Date End-->

            <div class="ui card timeline">
              <img src="https://wallpapersite.com/images/wallpapers/swiss-alps-1920x1200-mountains-town-switzerland-5k-4045.jpg" alt="post-image" class="img-responsive post-image" />
              <div class="post-container">
                <img src="/images/user-default.png" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline" class="profile-link">Sinwu</a> <span class="following">following</span></h5>
                    <p class="text-muted">Published a photo about 15 mins ago</p>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p> An astonishing view from somewhere in your beautiful earth <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-comment">
                    <img src="images/user-default_female.png" alt="" class="profile-photo-sm" />
                    <p><a href="timeline" class="profile-link">Diana </a><i class="em em-laughing"></i> Where is it? I really want to go there. </p>
                  </div>
                  <div class="post-comment">
                    <img src="images/user-default_ori.png" alt="" class="profile-photo-sm" />
                    <p><a href="timeline" class="profile-link">John</a> Such a beautiful place  </p>
                  </div>
                  <div class="post-comment">
                    <img src="images/user-default.png" alt="" class="profile-photo-sm" />
                    <input type="text" class="form-control" placeholder="Post a comment">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Post Content
          ================================================= -->
          <div class="post-content">

            <!--Post Date-->
            <div class="post-date hidden-xs hidden-sm">
              <h5>{{ $user->name }}</h5>
              <p class="text-grey">10/22/2016</p>
            </div><!--Post Date End-->

            <div class="ui card timeline">
              <img src="https://wallpapersite.com/images/wallpapers/swiss-alps-1920x1200-mountains-town-switzerland-5k-4045.jpg" alt="post-image" class="img-responsive post-image" />
              <div class="post-container">
                <img src="images/user-default.png" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline" class="profile-link">Sinwu</a> <span class="following">following</span></h5>
                    <p class="text-muted">Yesterday</p>
                  </div>
                  <div class="reaction">
                    <div ng-click="post.like()" class="ui labeled mini button" tabindex="0">
                      <div ng-class="{white: !post.liked, red: post.liked}" class="ui mini button">
                        <i class="heart icon"></i> Like
                      </div>
                      <a ng-class="{white: !post.liked, red: post.liked}" class="ui basic left pointing label">
                        @{{ post.likes }}
                      </a>
                    </div>
                    <a class="btn text-green"><i class="icon ion-thumbsup"></i> 49</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p> An astonishing view from somewhere in your beautiful earth <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-comment">
                    <img src="images/user-default_female.png" alt="" class="profile-photo-sm" />
                    <p><a href="timeline" class="profile-link">Diana </a><i class="em em-laughing"></i> Where is it? I really want to go there. </p>
                  </div>
                  <div class="post-comment">
                    <img src="images/user-default_ori.png" alt="" class="profile-photo-sm" />
                    <p><a href="timeline" class="profile-link">John</a> Such a beautiful place  </p>
                  </div>
                  <div class="post-comment">
                    <img src="images/user-default.png" alt="" class="profile-photo-sm" />
                    <input type="text" class="form-control" placeholder="Post a comment">
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Post Content
          ================================================= -->
          <div class="post-content">

            <!--Post Date-->
            <div class="post-date hidden-xs hidden-sm">
              <h5>{{ $user->name }}</h5>
              <p class="text-grey">10/21/2016</p>
            </div><!--Post Date End-->

            <div class="ui card timeline">
              <div class="post-container">
                <img src="images/user-default.png" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline" class="profile-link">Sinwu</a> <span class="following">following</span></h5>
                    <p class="text-muted">2 days ago</p>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="icon ion-thumbsup"></i> 49</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p> An astonishing view from somewhere in your beautiful earth <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-comment">
                    <img src="images/user-default_female.png" alt="" class="profile-photo-sm" />
                    <p><a href="timeline" class="profile-link">Diana </a><i class="em em-laughing"></i> Where is it? I really want to go there. </p>
                  </div>
                  <div class="post-comment">
                    <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                    <p><a href="timeline" class="profile-link">John</a> Such a beautiful place  </p>
                  </div>
                  <div class="post-comment">
                    <img src="images/user-default.png" alt="" class="profile-photo-sm" />
                    <input type="text" class="form-control" placeholder="Post a comment">
                  </div>
                </div>
              </div>
            </div>

          </div>  --}}

          <div ng-show="post.init || (post.load && !post.stop)" class="ui feed load segment">
            <div class="ui active feed text loader">
              Getting timeline
            </div>
          </div>

          <div ng-show="post.stop" class="ui feed stop segment">
            <h5>End of timeline</h5>
          </div>

        </div>
        <div class="col-md-2 static">
          <div id="sticky-sidebar">
            <h4 class="grey">Recent activity</h4>
            @foreach ($tUserActivities as $activity)
              <div class="feed-item">
                <div class="live-activity">
                  <p><a href="#" class="profile-link">{{ $tUser->name }}</a> <span class="description">{{$activity['type']}} {{$activity['target']}}</span></p>
                  <p class="text-muted">{{$activity['timeago']}}</p>
                </div>
              </div>
            @endforeach
            {{--  <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">{{ $user->name }}</a> <span class="description">commented on a photo</span></p>
                <p class="text-muted">5 mins ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">{{ $user->name }}</a> <span class="description">has posted a photo</span></p>
                <p class="text-muted">an hour ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">{{ $user->name }}</a> <span class="description">liked her friend's post</span></p>
                <p class="text-muted">4 hours ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">{{ $user->name }}</a> <span class="description">has shared a video</span></p>
                <p class="text-muted">a day ago</p>
              </div>
            </div>  --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="/js/ng-file-upload.min.js"></script>
<script src="/js/wnoo-controller-timeline.js"></script>
@endsection
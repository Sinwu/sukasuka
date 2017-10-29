@extends('layouts.wnoo')

@section('content')
<div class="timeline container">

  <!-- Timeline
  ================================================= -->
  <div class="timeline">
    <div class="timeline-cover">

      <!--Timeline Menu for Large Screens-->
      <div class="timeline-nav-bar hidden-sm hidden-xs">
        <div class="row">
          <div class="col-md-3">
            <div class="profile-info">
              <img src="images/user-default.png" alt="" class="img-responsive profile-photo" />
              <h3>{{ $user->name }}</h3>
              <p class="text-muted">Administrator</p>
            </div>
          </div>
          <div class="col-md-9">
            <ul class="list-inline profile-menu">
              <li><a href="feed" class="active">Feed</a></li>
              <li><a href="timeline" class="active">Timeline</a></li>
            </ul>
            <ul class="follow-me list-inline">
              <li><button class="btn-primary">Edit Profile</button></li>
            </ul>
          </div>
        </div>
      </div><!--Timeline Menu for Large Screens End-->

      <!--Timeline Menu for Small Screens-->
      <div class="navbar-mobile hidden-lg hidden-md">
        <div class="profile-info">
          <img src="http://placehold.it/300x300" alt="" class="img-responsive profile-photo" />
          <h4>Sarah Cruiz</h4>
          <p class="text-muted">Creative Director</p>
        </div>
        <div class="mobile-menu">
          <ul class="list-inline">
            <li><a href="feed" class="active">Feed</a></li>
            <li><a href="timeline" class="active">Timeline</a></li>
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
            <div class="ui steps">
              <a class="step">
                <i class="quote right blue icon"></i>
                <div class="content">
                  <div class="title blue">Write</div>
                  {{--  <div class="description">Share your thoughts</div>  --}}
                </div>
              </a>
              <a class="step">
                <i class="camera retro orange icon"></i>
                <div class="content">
                  <div class="title orange">Upload</div>
                  {{--  <div class="description">Upload an image/video</div>  --}}
                </div>
              </a>
              <a class="step">
                <i class="clone purple icon"></i>
                <div class="content">
                  <div class="title purple">Share</div>
                  {{--  <div class="description">Publish a file</div>  --}}
                </div>
              </a>
            </div>
            {{--  <div class="row">
              <div class="col-md-8 col-sm-8">
                <div class="form-group">
                  <textarea name="texts" id="exampleTextarea" cols="50" rows="2" class="form-control" placeholder="Write what you wish"></textarea>
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="tools">
                  <ul class="publishing-tools list-inline">
                    <li><a href="#"><i class="ion-images"></i></a></li>
                    <li><a href="#"><i class="ion-paperclip"></i></a></li>
                  </ul>
                  <button class="btn btn-primary pull-right">Publish</button>
                </div>
              </div>
            </div>  --}}
          </div><!-- Post Create Box End-->

          <!-- Post Content
          ================================================= -->
          <div class="post-content">

            <!--Post Date-->
            <div class="post-date hidden-xs hidden-sm">
              <h5>Sarah</h5>
              <p class="text-grey">Sometimes ago</p>
            </div><!--Post Date End-->

            <div class="ui card timeline">
              <img src="http://placehold.it/1920x1280" alt="post-image" class="img-responsive post-image" />
              <div class="post-container">
                <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline" class="profile-link">Sarah Cruiz</a> <span class="following">following</span></h5>
                    <p class="text-muted">Published a photo about 15 mins ago</p>
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
          </div>

          <!-- Post Content
          ================================================= -->
          <div class="post-content">

            <!--Post Date-->
            <div class="post-date hidden-xs hidden-sm">
              <h5>Sarah</h5>
              <p class="text-grey">10/22/2016</p>
            </div><!--Post Date End-->

            <div class="ui card timeline">
              <img src="http://placehold.it/1920x1280" alt="post-image" class="img-responsive post-image" />
              <div class="post-container">
                <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline" class="profile-link">Sarah Cruiz</a> <span class="following">following</span></h5>
                    <p class="text-muted">Yesterday</p>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="icon ion-thumbsup"></i> 49</a>
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

          </div>

          <!-- Post Content
          ================================================= -->
          <div class="post-content">

            <!--Post Date-->
            <div class="post-date hidden-xs hidden-sm">
              <h5>Sarah</h5>
              <p class="text-grey">10/21/2016</p>
            </div><!--Post Date End-->

            <div class="ui card timeline">
              <div class="post-container">
                <img src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline" class="profile-link">Sarah Cruiz</a> <span class="following">following</span></h5>
                    <p class="text-muted">2 days ago</p>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="icon ion-thumbsup"></i> 49</a>
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

          </div>

        </div>
        <div class="col-md-2 static">
          <div id="sticky-sidebar">
            <h4 class="grey">Sarah's activity</h4>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sarah</a> Commended on a Photo</p>
                <p class="text-muted">5 mins ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sarah</a> Has posted a photo</p>
                <p class="text-muted">an hour ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sarah</a> Liked her friend's post</p>
                <p class="text-muted">4 hours ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sarah</a> has shared an album</p>
                <p class="text-muted">a day ago</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
    
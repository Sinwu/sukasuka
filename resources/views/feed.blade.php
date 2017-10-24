@extends('layouts.wnoo')

@section('content')
<div class="feed container" ng-controller="FeedController as ctrl">
  <div class="row">
    <!-- Newsfeed Common Side Bar Left
    ================================================= -->
    <div class="col-md-3 static">
      <div class="profile-card">
        <img src="images/user-default.png" alt="user" class="profile-photo" />
        <h5><a href="timeline" class="text-white">{{ $user->name }}</a></h5>
        <p class="text-white">Administrator</p>
      </div><!--profile card ends-->
      <ul class="nav-news-feed">
        <li><i class="icon ion-ios-paper"></i><div><a href="timeline">My Timeline</a></div></li>
      </ul><!--news-feed links ends-->
    </div>
    
    <div class="col-md-7">

      <!-- Post Create Box
      ================================================= -->
      <div class="create-post">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <div class="form-group">
              <textarea ng-model="postContent" name="texts" id="exampleTextarea" cols="50" rows="2" class="form-control" placeholder="Write what you wish"></textarea>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="tools">
              <ul class="publishing-tools list-inline">
                <li><a href="#"><i class="ion-images"></i></a></li>
                <li><a href="#"><i class="ion-paperclip"></i></a></li>
              </ul>
              <button ng-click="postCreate()" class="btn btn-primary pull-right">Publish</button>
            </div>
          </div>
        </div>
      </div><!-- Post Create Box End-->

      <!-- Post Content
      ================================================= -->
      <div infinite-scroll='feed.nextPage()' infinite-scroll-disabled='feed.busy' infinite-scroll-distance='2'>
        <div class="post-content" ng-repeat="post in feed.posts">
          <img ng-show="post.isImage()" ng-src="@{{ post.image }}" alt="post-image" class="img-responsive post-image" />
          <div class="post-container">
            <img ng-src="http://placehold.it/300x300" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a href="timeline" class="profile-link">@{{ post.user.name }}</a></h5>
                <p class="text-muted">Published a @{{ post.type }} about 3 mins ago</p>
              </div>
              <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                {{--  <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>  --}}
              </div>
              <div class="line-divider"></div>
              <div class="post-text">
                <p> @{{ post.content }} </p>
              </div>
              <div class="line-divider"></div>

              <div ng-repeat="comment in post.comments" class="post-comment">
                <img ng-src="@{{ comment.user.image }}" alt="" class="profile-photo-sm" />
                <p><a href="timeline" class="profile-link">@{{ comment.user.name }} </a><i class="em em-laughing"></i> @{{ comment.content }} </p>
              </div>
              <div class="post-comment">
                <img ng-src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />
                <input type="text" class="form-control" placeholder="Post a comment">
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

      <div ng-show="feed.busy && !feed.stop" class="ui feed load segment">
        <div class="ui active feed text loader">
          Getting your timeline
        </div>
      </div>

      <div ng-show="feed.stop" class="ui feed stop segment">
        <h5>End of your timeline</h5>
      </div>

    </div>

    <!-- Newsfeed Common Side Bar Right
    ================================================= -->
    <div class="col-md-2 static">
      <div class="suggestions" id="sticky-sidebar">
        <h4 class="grey">Recent Activities</h4>
        <div class="follow-user">
          <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm pull-left" />
          <div>
            <h5><a href="timeline">Diana Amber</a></h5>
            <p class="text-muted">Posted a new photo</p>
          </div>
        </div>
        <div class="follow-user">
          <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm pull-left" />
          <div>
            <h5><a href="timeline">Cris Haris</a></h5>
            <p href="#" class="text-muted">Added a new post</p>
          </div>
        </div>
        <div class="follow-user">
          <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm pull-left" />
          <div>
            <h5><a href="timeline">Brian Walton</a></h5>
            <p class="text-muted">Commented a post</p>
          </div>
        </div>
        <div class="follow-user">
          <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm pull-left" />
          <div>
            <h5><a href="timeline">Olivia Steward</a></h5>
            <p class="text-muted">Profile updated</p>
          </div>
        </div>
        <div class="follow-user">
          <img src="http://placehold.it/300x300" alt="" class="profile-photo-sm pull-left" />
          <div>
            <h5><a href="timeline">Sophia Page</a></h5>
            <p class="text-muted">Commented a post</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="js/wnoo-factory-post.js"></script>
<script src="js/wnoo-factory-feed.js"></script>
<script src="js/wnoo-controller-feed.js"></script>
@endsection
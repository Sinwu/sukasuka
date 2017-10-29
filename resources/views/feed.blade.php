@extends('layouts.wnoo')

@section('content')
<div id="page-contents">
  <div class="feed container" ng-controller="FeedController as ctrl">
    <div class="row">
      <!-- Newsfeed Common Side Bar Right
      ================================================= -->
      <div class="col-md-3 col-md-push-9">
        
        <div class="suggestions" id="sticky-sidebar">

          <div class="profile-card">
            <img src="images/user-default.png" alt="user" class="profile-photo" />
            <h5><a href="timeline" class="text-white">{{ $user->name }}</a></h5>
            <p class="text-white">Administrator</p>
          </div><!--profile card ends-->

          {{--  <div class="ui card">
            <ul class="nav-news-feed">
              <li><i class="icon ion-ios-paper"></i><div><a href="timeline">My Timeline</a></div></li>
              <li><i class="icon ion-ios-paper"></i><div><a href="#">Profile</a></div></li>
            </ul><!--news-feed links ends-->
          </div>  --}}

          <div class="ui card">
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
      
      <div class="col-md-9 col-md-pull-3">

        <!-- Post Create Box
        ================================================= -->
        <div class="ui card segment create-post">
          <div class="ui steps">
            <a class="step">
              <i class="quote right blue icon"></i>
              <div class="content">
                <div class="title blue">Write</div>
                <div class="description">Share your thoughts</div>
              </div>
            </a>
            <a class="step">
              <i class="camera retro orange icon"></i>
              <div class="content">
                <div class="title orange">Upload</div>
                <div class="description">Upload an image or video</div>
              </div>
            </a>
            <a class="step">
              <i class="clone purple icon"></i>
              <div class="content">
                <div class="title purple">Share</div>
                <div class="description">Publish a file</div>
              </div>
            </a>
          </div>

          {{--  <div class="ui inverted dimmer loader-post">
            <div ng-show="showProgress">
              <h5 class="Uploading your post"></h5>
              <div class="ui teal progress loader-progress">
                <div class="bar"></div>
                <div class="label"><span class="counter"></span>22%</div>
              </div>
            </div>
            <div ng-hide="showProgress">
              <div class="ui text loader">Posting</div>
            </div>
          </div>

          <form name="postForm">
            <div class="row preview">
              <div ng-show="image" class="image preview">
                <img ngf-thumbnail="image" class="img-responsive">
                <button class="circular ui icon mini negative button" ng-click="image = null" ng-show="image">
                  <i class="icon close"></i>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 col-sm-8">
                <div class="form-group">
                  <textarea ng-model="postContent" name="texts" id="exampleTextarea" cols="50" rows="2" class="form-control" placeholder="Write what you wish"></textarea>
                  
                </div>
              </div>
              <div class="col-md-4 col-sm-4">
                <div class="tools">
                  <ul class="publishing-tools list-inline">
                    <li>
                      <a href="#" ngf-select ng-model="image" name="image" ngf-pattern="'image/*'"
                        ngf-accept="'image/*'" ngf-max-size="5MB" ngf-min-height="100"
                        ngf-model-invalid="errorImage">
                        <i class="ion-images"></i>
                      </a>
                    </li>
                    <li><a href="#"><i class="ion-paperclip"></i></a></li>
                  </ul>
                  <button ng-click="postCreate()" class="btn btn-primary pull-right">Publish</button>
                </div>
              </div>
            </div>

            <div class="row">
              <div ng-show="postForm.image.$error.maxSize" class="ui negative message">
                <span ng-show="postForm.image.$error.maxSize">Please upload an image with size below 5MB</span>
              </div>
            </div>
          </form>  --}}
        </div><!-- Post Create Box End-->

        {{--  <form name="myForm">
          <fieldset>
            <legend>Upload on form submit</legend>
            Username:
            <input type="text" name="userName" ng-model="username" size="31" required>
            <i ng-show="myForm.userName.$error.required">*required</i>
            <br>Photo:
            <input type="file" ngf-select ng-model="picFile" name="file"    
                  accept="image/*" ngf-max-size="2MB" required
                  ngf-model-invalid="errorFile">
            <i ng-show="myForm.file.$error.required">*required</i><br>
            <i ng-show="myForm.file.$error.maxSize">File too large 
                {{errorFile.size / 1000000|number:1}}MB: max 2M</i>
            <img ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb"> <button ng-click="picFile = null" ng-show="picFile">Remove</button>
            <br>
            <button ng-disabled="!myForm.$valid" 
                    ng-click="uploadPic(picFile)">Submit</button>
            <span class="progress" ng-show="picFile.progress >= 0">
              <div style="width:{{picFile.progress}}%" 
                  ng-bind="picFile.progress + '%'"></div>
            </span>
            <span ng-show="picFile.result">Upload Successful</span>
            <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
          </fieldset>
          <br>
        </form>  --}}

        <!-- Post Content
        ================================================= -->
        <div infinite-scroll='feed.nextPage()' infinite-scroll-disabled='feed.busy' infinite-scroll-distance='2'>
          
          <div class="ui card post-content" ng-repeat="post in feed.posts">
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

        <div ng-show="feed.init || (feed.busy && !feed.stop)" class="ui feed load segment">
          <div class="ui active feed text loader">
            Getting your feed
          </div>
        </div>

        <div ng-show="feed.stop" class="ui feed stop segment">
          <h5>End of your feed</h5>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script src="js/ng-file-upload.min.js"></script>
<script src="js/wnoo-factory-post.js"></script>
<script src="js/wnoo-factory-feed.js"></script>
<script src="js/wnoo-factory-media.js"></script>
<script src="js/wnoo-controller-feed.js"></script>
@endsection
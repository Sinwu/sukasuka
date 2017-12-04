@extends('layouts.wnoo')

@section('content')
<div id="page-contents">
  <div class="feed container" ng-controller="SingleController as ctrl">
    <input id="postID"     type="hidden" value="{{ $postID }}">
    <input id="userImage"  type="hidden" value="{{ $user->src }}">
    <input id="userGender" type="hidden" value="{{ $user->gender }}">

    <div class="row">
      <!-- Newsfeed Common Side Bar Right
      ================================================= -->
      <div class="col-md-3 col-md-push-9">
        
        <div class="suggestions" id="sticky-sidebar">

          <div class="profile-card">
            <img ng-src="@{{getHostUserImage()}}" alt="user" class="profile-photo" />
            <h5><a href="/timeline/{{ $user->id }}" class="text-white">{{ $user->name }}</a></h5>
            {{--  <p class="text-white">Administrator</p>  --}}
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
                <h5><a href="@{{app.getURL()}}">@{{app.name}}</a></h5>
                <p class="text-muted">@{{app.description}}</p>
              </div>
            </div>
          </div>
            
        </div>
      </div>
      
      <div class="col-md-9 col-md-pull-3">

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
                <p ng-bind-html="post.contentHtml"> @{{ getPostContent(post) }} </p>
              </div>
              <div class="line-divider"></div>

              <div ng-repeat="comment in post.comments" class="post-comment">
                <img ng-src="@{{getUserImage(comment.user)}}" alt="" class="profile-photo-sm" />
                <div>
                  <a href="/timeline/@{{ comment.user.id }}" class="profile-link">@{{ comment.user.name }} </a> @{{ comment.content }}
                  <p class="text-muted timestamp">@{{ comment.timeago }}</p>
                </div>
              </div>
              <div class="post-comment">
                <img ng-src="@{{getHostUserImage()}}" alt="" class="profile-photo-sm" />
                <input ng-disabled="post.busy" ng-model="post.commentContent" type="text" class="form-control comment" placeholder="Post a comment">
                <button ng-disabled="post.busy" ng-click="postComment(post)" class="ui mini blue button comment"> Comment </button>
              </div>

            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script src="/js/ng-file-upload.min.js"></script>
<script src="/js/wnoo-controller-single.js"></script>
@endsection
@extends('layouts.wnoo')

@section('content')
<div id="page-contents">
  <div class="feed container" ng-controller="NotificationController as ctrl">
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

        <!-- Notification Content
        ================================================= -->
        <div infinite-scroll='notification.nextPage()' infinite-scroll-disabled='notification.load' infinite-scroll-distance='2'>
          
          <div class="ui card post-content" ng-repeat="notif in notification.notifications">
            <div class="row notif-container">
              <div class="col-md-1">
                <img ng-src="@{{getUserImage(notif.actor)}}" alt="" class="profile-photo-sm" />
              </div>
              <div class="col-md-11" style="line-height: 2.7rem;">
                <span><a href="/timeline/@{{ notif.actor.id }}" class="profile-link">@{{ notif.actor.name }} </a> @{{notif.action}} @{{getNotifDescription(notif.action)}} <p style="display:inline-block" ng-bind-html="notif.link"> @{{ getNotifLink(notif) }} </p></span>
              </div>
            </div>
          </div>
        </div><!-- Notification Content End-->

        <div ng-show="notification.init || (notification.load && !notification.stop)" class="ui feed load segment">
          <div class="ui active feed text loader">
            Getting your notification
          </div>
        </div>

        <div ng-show="notification.stop" class="ui feed stop segment">
          <h5>End of your notification</h5>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script src="/js/ng-file-upload.min.js"></script>
<script src="/js/wnoo-controller-notification.js"></script>
@endsection
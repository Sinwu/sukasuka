@extends('layouts.wnoo')

@section('content')
<div class="edit password container">

  <!-- Timeline
  ================================================= -->
  <div class="timeline">
    <div class="timeline-cover">

      <!--Timeline Menu for Large Screens-->
      <div class="timeline-nav-bar hidden-sm hidden-xs">
        <div class="row">
          <div class="col-md-3">
            <div class="profile-info">
              <img src="@{{getUserImage()}}" alt="" class="img-responsive profile-photo" />
              <h3>@{{ name }}</h3>
              {{--  <p class="text-muted">Administrator</p>  --}}
            </div>
          </div>
          <div class="col-md-9">
            <ul class="list-inline profile-menu">
              <li><a href="feed">Feed</a></li>
              <li><a href="timeline/{{ $user->id }}">Timeline</a></li>
              <li><a href="about/{{ $user->id }}">About Me</a></li>
            </ul>
            <ul class="follow-me list-inline">
              {{--  <li><button class="btn-primary">Edit Profile</button></li>  --}}
            </ul>
          </div>
        </div>
      </div><!--Timeline Menu for Large Screens End-->

      <!--Timeline Menu for Small Screens-->
      <div class="navbar-mobile hidden-lg hidden-md">
        <div class="profile-info">
          <img src="@{{getUserImage()}}" alt="" class="img-responsive profile-photo" />
          <h4>@{{ name }}</h4>
          {{--  <p class="text-muted">Creative Director</p>  --}}
        </div>
        <div class="mobile-menu">
          <ul class="list-inline">
            <li><a href="feed">Feed</a></li>
            <li><a href="timeline/{{ $user->id }}">Timeline</a></li>
            <li><a href="about/{{ $user->id }}">About Me</a></li>
          </ul>
          {{--  <button class="btn-primary">Edit Profile</button>  --}}
        </div>
      </div><!--Timeline Menu for Small Screens End-->

    </div>
    <div id="page-contents">
      <div class="ui card post-content">
        <div class="post-container">
          <div class="row">
            <div class="col-md-3">
              
              <!--Edit Profile Menu-->
              <ul class="edit-menu">
                <li><i class="icon ion-ios-information-outline"></i><a href="editbasic">Basic Information</a></li>
                <li class="active"><i class="icon ion-ios-locked-outline"></i><a href="editpassword">Change Password</a></li>
              </ul>
            </div>
            <div class="col-md-7">

              <!-- Change Password
              ================================================= -->
              <div class="edit-profile-container">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-ios-locked-outline"></i>Change Password</h4>
                  <div class="line"></div>
                </div>
                <div class="edit-block">
                  <form name="update-pass" id="education" class="form-inline">
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-password">Old password</label>
                        <input id="my-password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Old password"/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label>New password</label>
                        <input class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="New password"/>
                      </div>
                      <div class="form-group col-xs-6">
                        <label>Confirm password</label>
                        <input class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Confirm password"/>
                      </div>
                    </div>
                    <p><a href="#">Forgot Password?</a></p>
                    <button class="btn btn-primary">Update Password</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-2 static">
              
              <!--Sticky Timeline Activity Sidebar-->
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
  </div>
</div>
@endsection
@extends('layouts.wnoo')

@section('content')
<div class="edit profile container" ng-controller="EditProfileController as ctrl">
  <input id="userName" type="hidden" value="{{ $user->name }}">
  <input id="userGender" type="hidden" value="{{ $user->gender }}">
  <input id="userBirthday" type="hidden" value="{{ $user->birthday }}">
  <input id="userAbout" type="hidden" value="{{ $user->about }}">
  <input id="userImage" type="hidden" value="{{ $user->src }}">

  <!-- Timeline
  ================================================= -->
  <div class="edit-profile">
    <div class="timeline-cover">

      <!--Timeline Menu for Large Screens-->
      <div class="timeline-nav-bar hidden-sm hidden-xs">
        <div class="row">
          <div class="col-md-3">
            <div class="profile-info">
              <img src="@{{getUserImage()}}" alt="" class="img-responsive profile-photo" />
              <h3>@{{ name }}</h3>
              <p class="text-muted">Administrator</p>
            </div>
          </div>
          <div class="col-md-9">
            <ul class="list-inline profile-menu">
              <li><a href="feed">Feed</a></li>
              <li><a href="timeline">Timeline</a></li>
              <li><a href="about">About Me</a></li>
            </ul>
            <ul class="follow-me list-inline">
              {{--  <li><a href="editbasic"><button class="btn-primary">Edit Profile</button></a></li>  --}}
            </ul>
          </div>
        </div>
      </div><!--Timeline Menu for Large Screens End-->

      <!--Timeline Menu for Small Screens-->
      <div class="navbar-mobile hidden-lg hidden-md">
        <div class="profile-info">
          <img src="@{{getUserImage()}}" alt="" class="img-responsive profile-photo" />
          <h4>@{{ name }}</h4>
          <p class="text-muted">Creative Director</p>
        </div>
        <div class="mobile-menu">
          <ul class="list-inline">
            <li><a href="feed">Feed</a></li>
            <li><a href="timeline">Timeline</a></li>
            <li><a href="about">About Me</a></li>
          </ul>
          <button class="btn-primary">Edit Profile</button>
        </div>
      </div><!--Timeline Menu for Small Screens End-->

    </div>
    <div id="page-contents">
      <div class="ui card post-content">
        <div class="post-container">
          <div class="row ui segment">

            <!--  Loader  -->
            <div id="loader" class="ui inverted dimmer">
              <div class="ui text loader">Loading</div>
            </div>

            <div class="col-md-3">
              
              <!--Edit Profile Menu-->
              <ul class="edit-menu">
                <li ng-click="showProfile = true" ng-class="{active: showProfile}"><i class="icon ion-ios-information-outline"></i><a href="">Basic Information</a></li>
                <li ng-click="showProfile = false" ng-class="{active: !showProfile}"><i class="icon ion-ios-locked-outline"></i><a href="">Change Password</a></li>
              </ul>
            </div>
            <div class="col-md-9">

              <!-- Basic Information
              ================================================= -->
              <div ng-show="showProfile" class="edit-profile-container">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i>Edit basic information</h4>
                  <div class="line"></div>
                </div>
                <div ng-show="updateSuccess" class="ui success message">Profile Updated</div>
                <div class="edit-block">
                  <form name="basic-info" ng-submit="update()" id="basic-info" class="form-inline">
                    <div class="row">
                      <div style="text-align: center" class="form-group col-xs-5">
                        <img ng-show="image" ngf-src="image" class="img-responsive profile-photo update" />
                        <img ng-hide="image" src="@{{getUserImage()}}" class="img-responsive profile-photo update" />
                        <button ngf-select="setProfileImage($file)" ng-model="image" name="image" ngf-pattern="'image/*'"
                          ngf-accept="'image/*'" ngf-max-size="5MB" ngf-model-invalid="errorImage" type="button"
                          style="width: 100px; margin-top: .5rem" class="btn btn-primary">Change</button>
                      </div>
                      <div class="form-group col-xs-7">
                        <label for="firstname">Fullname</label>
                        <input ng-model="name" id="firstname" class="form-control input-group-lg" type="text" name="fullname" required title="Enter your full name" />
                        
                        <label style="margin-top: .5rem" for="email">My email</label>
                        <input id="email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" value="{{ $user->email }}" disabled />
                      </div>
                    </div>
                    <div class="row">
                      <p class="custom-label"><strong>Date of Birth</strong></p>
                      <div class="form-group col-sm-3 col-xs-3">
                        <label for="month" class="sr-only"></label>
                        <select ng-model="birthDate" ng-options="d for d in dates" class="form-control">
                        </select>
                      </div>
                      <div class="form-group col-sm-6 col-xs-6">
                        <label for="month" class="sr-only"></label>
                        <select ng-model="birthMonth" ng-options="m for m in months" class="form-control">
                        </select>
                      </div>
                      <div class="form-group col-sm-3 col-xs-3">
                        <label for="year" class="sr-only"></label>
                        <select ng-model="birthYear" ng-options="y for y in years()" class="form-control">
                        </select>
                      </div>
                    </div>
                    <div class="form-group gender">
                      <span class="custom-label"><strong>I am a: </strong></span>
                      <label class="radio-inline">
                        <input ng-model="gender" type="radio" name="optradio" value="m">Male
                      </label>
                      <label class="radio-inline">
                        <input ng-model="gender" type="radio" name="optradio" value="f">Female
                      </label>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-info">About me</label>
                        <textarea ng-model="about" name="information" class="form-control" placeholder="Some texts about me" rows="4" cols="400"></textarea>
                      </div>
                    </div>                    
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </form>
                </div>
              </div> <!-- End of Basic Profile -->

              <!-- Change Password
              ================================================= -->
              <div ng-hide="showProfile" class="edit-profile-container">
                <div class="block-title">
                  <h4 class="grey"><i class="icon ion-ios-locked-outline"></i>Change Password</h4>
                  <div class="line"></div>
                </div>
                <div ng-show="updatePError" class="ui negative message">@{{ updatePErrorMessage }}</div>
                <div ng-show="updatePSuccess" class="ui success message">Password Updated</div>
                <div class="edit-block">
                  <form name="update-pass" ng-submit="updateP()" id="education" class="form-inline">
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-password">Old password</label>
                        <input ng-model="oldP" required class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Old password"/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-6">
                        <label>New password</label>
                        <input ng-model="newP" required class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="New password"/>
                      </div>
                      <div class="form-group col-xs-6">
                        <label>Confirm password</label>
                        <input ng-model="newPConfirm" required class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Confirm password"/>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                  </form>
                </div>
              </div> <!-- End of Change Password -->

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
<script src="/js/wnoo-controller-edit-profile.js"></script>
@endsection
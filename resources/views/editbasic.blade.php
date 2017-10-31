@extends('layouts.wnoo')

@section('content')
<div class="edit profile container">

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
              <h3>Sinwu </h3>
              <p class="text-muted">Creative Director</p>
            </div>
          </div>
          <div class="col-md-9">
            <ul class="list-inline profile-menu">
              <li><a href="feed">Feed</a></li>
            </ul>
            <ul class="follow-me list-inline">
              <li><a href="timeline"><button class="btn-primary">Timeline</button></a></li>
            </ul>
          </div>
        </div>
      </div><!--Timeline Menu for Large Screens End-->

      <!--Timeline Menu for Small Screens-->
      <div class="navbar-mobile hidden-lg hidden-md">
        <div class="profile-info">
          <img src="images/user-default.png" alt="" class="img-responsive profile-photo" />
          <h4>Sinwu </h4>
          <p class="text-muted">Creative Director</p>
        </div>
        <div class="mobile-menu">
          <ul class="list-inline">
            <li><a href="timline">Timeline</a></li>
          </ul>
          <button class="btn-primary">Edit Profile</button>
        </div>
      </div><!--Timeline Menu for Small Screens End-->

    </div>
    <div id="page-contents">
      <div class="row">
        <div class="col-md-3">
          
          <!--Edit Profile Menu-->
          <ul class="edit-menu">
            <li class="active"><i class="icon ion-ios-information-outline"></i><a href="editbasic">Basic Information</a></li>
            <li><i class="icon ion-ios-locked-outline"></i><a href="editpassword">Change Password</a></li>
          </ul>
        </div>
        <div class="col-md-7">

          <!-- Basic Information
          ================================================= -->
          <div class="edit-profile-container">
            <div class="block-title">
              <h4 class="grey"><i class="icon ion-android-checkmark-circle"></i>Edit basic information</h4>
              <div class="line"></div>
            </div>
            <div class="edit-block">
              <form name="basic-info" id="basic-info" class="form-inline">
                <div class="row">
                  <div class="form-group col-xs-6">
                    <label for="firstname">First name</label>
                    <input id="firstname" class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name" value="John" />
                  </div>
                  <div class="form-group col-xs-6">
                    <label for="lastname" class="">Last name</label>
                    <input id="lastname" class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name" value="Doe" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-xs-12">
                    <label for="email">My email</label>
                    <input id="email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" placeholder="My Email" value="razor.venon@gmail.com" />
                  </div>
                </div>
                <div class="row">
                  <p class="custom-label"><strong>Date of Birth</strong></p>
                  <div class="form-group col-sm-3 col-xs-6">
                    <label for="month" class="sr-only"></label>
                    <select class="form-control" id="day">
                      <option value="Day">Day</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                      <option>11</option>
                      <option>12</option>
                      <option>13</option>
                      <option>14</option>
                      <option>15</option>
                      <option>16</option>
                      <option>17</option>
                      <option>18</option>
                      <option selected>19</option>
                      <option>20</option>
                      <option>21</option>
                      <option>22</option>
                      <option>23</option>
                      <option>24</option>
                      <option>25</option>
                      <option>26</option>
                      <option>27</option>
                      <option>28</option>
                      <option>29</option>
                      <option>30</option>
                      <option>31</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-3 col-xs-6">
                    <label for="month" class="sr-only"></label>
                    <select class="form-control" id="month">
                      <option value="month">Month</option>
                      <option>Jan</option>
                      <option>Feb</option>
                      <option>Mar</option>
                      <option>Apr</option>
                      <option>May</option>
                      <option>Jun</option>
                      <option>Jul</option>
                      <option>Aug</option>
                      <option>Sep</option>
                      <option>Oct</option>
                      <option>Nov</option>
                      <option selected>Dec</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-6 col-xs-12">
                    <label for="year" class="sr-only"></label>
                    <select class="form-control" id="year">
                      <option value="year">Year</option>
                      <option selected>2000</option>
                      <option>2001</option>
                      <option>2002</option>
                      <option>2004</option>
                      <option>2005</option>
                      <option>2006</option>
                      <option>2007</option>
                      <option>2008</option>
                      <option>2009</option>
                      <option>2010</option>
                      <option>2011</option>
                      <option>2012</option>
                    </select>
                  </div>
                </div>
                <div class="form-group gender">
                  <span class="custom-label"><strong>I am a: </strong></span>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" checked>Male
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio">Female
                  </label>
                </div>
                <div class="row">
                  <div class="form-group col-xs-12">
                    <label for="my-info">About me</label>
                    <textarea id="my-info" name="information" class="form-control" placeholder="Some texts about me" rows="4" cols="400">
                    Some short description about myself..
                    </textarea>
                  </div>
                </div>
                <button class="btn btn-primary">Save Changes</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-2 static">
          
          <!--Sticky Timeline Activity Sidebar-->
          <div id="sticky-sidebar">
            <h4 class="grey">Sinwu's activity</h4>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sinwu</a> Commended on a Photo</p>
                <p class="text-muted">5 mins ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sinwu</a> Has posted a photo</p>
                <p class="text-muted">an hour ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sinwu</a> Liked her friend's post</p>
                <p class="text-muted">4 hours ago</p>
              </div>
            </div>
            <div class="feed-item">
              <div class="live-activity">
                <p><a href="#" class="profile-link">Sinwu</a> has shared an album</p>
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

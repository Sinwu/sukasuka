@extends('layouts.wnoo')

@section('content')
<div class="about container" ng-controller="AboutController as ctrl">
  <input id="tUserID" type="hidden" value="{{ $tUser->id }}">
  <input id="tUserImage" type="hidden" value="{{ $tUser->src }}">
  <input id="tUserGender" type="hidden" value="{{ $tUser->gender }}">

  <!-- Timeline
  ================================================= -->
  <div>
    <div class="timeline-cover">

      <!--Timeline Menu for Large Screens-->
      <div class="timeline-nav-bar hidden-sm hidden-xs">
        <div class="row">
          <div class="col-md-3">
            <div class="profile-info">
              <img ng-src="@{{getAboutUserImage()}}" alt="" class="img-responsive profile-photo" />
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
              <li><a href="editbasic"><button class="btn-primary">Edit Profile</button></a></li>
            </ul>
          </div>
        </div>
      </div><!--Timeline Menu for Large Screens End-->

      <!--Timeline Menu for Small Screens-->
      <div class="navbar-mobile hidden-lg hidden-md">
        <div class="profile-info">
          <img ng-src="@{{getAboutUserImage()}}" alt="" class="img-responsive profile-photo" />
          <h4>{{ $user->name }}</h4>
          <p class="text-muted">Creative Director</p>
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
      <div class="ui card post-content" style="background-color: white;">
        <div class="post-container">
          <div class="about row ui segment">
            <!--  Loader  -->
            <div id="loader" class="ui active inverted dimmer">
              <div class="ui text loader">Loading</div>
            </div>

            <div class="col-md-3"></div>
            <div class="col-md-7">

              <!-- About
              ================================================= -->
              <div class="about-profile">
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-information-outline icon-in-title"></i>Personal Information</h4>
                  {{--
                  "NIK": "8314265",
                  "Nama": "Syafrizal",
                  "email": "syafrizal@edi-indonesia.co.id",
                  "jabatan": "Analyst Programmer",
                  "nama_div_ext": "IT Development",
                  "subdivisi": "Project & Product Development",
                  "lokasi": "Jakarta",
                  "noext": "8322",
                  "Alamat": "Jl. Pengadegan Selatan VIII No. 13 RT.010/RW.05 Pengadegan, Pancoran, Jakarta Selatan",
                  "NoTelepon": "-",
                  "NoHp": "085659650001",
                  "TempatLahir": "Garut",
                  "TanggalLahir": "1983-09-25",
                  "nama_agama": "Islam",
                  "emailreg": "isol.retro@gmail.com",
                  "gol_darah": "",
                  "hobi": null
                  --}}
                  <div ng-hide="isEmployee">
                    <div class="row">
                      <div class="col-md-3">
                        <p>Fullname</p>
                      </div>
                      <div class="col-md-9">
                        <p>{{ $tUser->name }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Email</p>
                      </div>
                      <div class="col-md-9">
                        <p>{{ $tUser->email }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Date of birth</p>
                      </div>
                      <div class="col-md-9">
                        <p>{{ $tUser->birthday }}</p>
                      </div>
                    </div>
                  </div>

                  <div ng-show="isEmployee">
                    <div class="row">
                      <div class="col-md-3">
                        <p>NIK</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.NIK }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Fullname</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.Nama }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Email</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.email }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Email Pribadi</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.emailreg }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Jabatan</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.jabatan }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Divisi</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.nama_div_ext }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Sub Divisi</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.subdivisi }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Lokasi</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.lokasi }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>No. Extension</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.noext }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Alamat</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.Alamat }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Telepon / HP</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.NoTelepon }} / @{{ profile.datapribadi.NoHp }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Tempat, Tanggal Lahir</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.TempatLahir }}, @{{ profile.datapribadi.TanggalLahir }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Agama</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.nama_agama }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Gol. Darah</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.gol_darah }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <p>Hobi</p>
                      </div>
                      <div class="col-md-9">
                        <p>@{{ profile.datapribadi.hobi }}</p>
                      </div>
                    </div>
                  </div>

                </div>
                
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Work Experiences</h4>
                  <div class="organization">
                    <img src="images/fav.png" alt="" class="pull-left img-org" />
                    <div class="work-info">
                      <a href="#" class="profile-link">EDII</a>
                      <p>Top Administrator - <span class="text-grey">1 February 2013 to present</span></p>
                    </div>
                  </div>
                  <div class="organization">
                    <img src="images/fav.png" alt="" class="pull-left img-org" />
                    <div class="work-info">
                      <a href="#" class="profile-link">EDII</a>
                      <p>Super Administrator - <span class="text-grey">1 March 2010 to 1 February 2013</span></p>
                    </div>
                  </div>
                  <div class="organization">
                    <img src="images/fav.png" alt="" class="pull-left img-org" />

                    <div class="work-info">
                      <a href="#" class="profile-link">EDII</a>
                      <p>Administrator - <span class="text-grey">1 December 2007 to 1 March 2010</span></p>
                    </div>
                  </div>
                </div>
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-heart-outline icon-in-title"></i>Interests</h4>
                  <ul class="interests list-inline">
                    <li><span class="int-icons" title="Bycycle riding"><i class="icon ion-android-bicycle"></i></span></li>
                    <li><span class="int-icons" title="Photography"><i class="icon ion-ios-camera"></i></span></li>
                    <li><span class="int-icons" title="Shopping"><i class="icon ion-android-cart"></i></span></li>
                    <li><span class="int-icons" title="Traveling"><i class="icon ion-android-plane"></i></span></li>
                    <li><span class="int-icons" title="Eating"><i class="icon ion-android-restaurant"></i></span></li>
                  </ul>
                </div>
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
<script src="/js/wnoo-controller-about.js"></script>
@endsection
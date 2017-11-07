@extends('mod.layouts.wnoo-mod')

@section('content')
<!-- BEGIN BASE-->
<div id="base">

  <!-- BEGIN OFFCANVAS LEFT -->
  <div class="offcanvas">
  </div><!--end .offcanvas-->
  <!-- END OFFCANVAS LEFT -->

  <!-- BEGIN CONTENT-->
  <div id="content">
    <section class="style-default-bright">
      <div class="section-header">
        <h2 class="text-primary">Social Hub User</h2>
      </div>
      <div class="section-body">

        <!-- BEGIN DATATABLE 1 -->
        <div class="row">
          <div class="col-md-12">
            <p>You can manage social hub user data and approve new registration on this page.</p>
          </div><!--end .col -->
          <div class="col-lg-12">
            <div class="table-responsive">
              <table id="datatable1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{--  @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->birthday }}</td>
                    <td>
                      @if ( $user->active == 0)
                        <b> {{ "Not Active" }} </b>
                      @elseif ( $user->active == 1)
                        <b> {{ "Active"}} </b>
                      @endif
                    </td>
                    <td>
                      @if ( $user->active == '0')
                      <button id="actButton" type="button" class="btn ink-reaction btn-raised btn-info" data-toggle="modal" data-target="#actModal" data-id="{{ $user->id }}" data-active="{{ $user->active }}">
                      Activate
                      </button>
                       @elseif ( $user->active == '1')
                      <button id="actButton" type="button" class="btn ink-reaction btn-raised btn-info" data-toggle="modal" data-target="#actModal" data-id="{{ $user->id }}" data-active="{{ $user->active }}">
                      De-Activate
                      </button>
                      @endif
                    </td>
                  </tr>
                  @endforeach  --}}
                </tbody>
              </table>
            </div><!--end .table-responsive -->
          </div><!--end .col -->
        </div><!--end .row -->
        <!-- END DATATABLE 1 -->

      </div><!--end .section-body -->
    </section>
  </div><!--end #content-->
  <!-- END CONTENT -->
@endsection

@section('modal')
<!-- BEGIN SIMPLE MODAL MARKUP -->
<div class="modal fade" id="actModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Update Activation Status</h4>
        <input type="hidden" id="hiddenID"></input>
      </div>
      <div class="modal-body">
        <p>Current activation status is <b id="currState"></b></p>
        <br>
        <p>Are you sure to set this user to <b id="nextState"></b> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="actConf" type="button" class="btn btn-danger">Confirm</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END SIMPLE MODAL MARKUP -->
@endsection

@section('script')
<script src="../cms_assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="../cms_assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="../cms_assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="../cms_assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="../cms_assets/js/core/demo/Demo.js"></script>
<script src="../cms_assets/js/core/demo/DemoTableDynamic.js"></script>

<script src="../cms_assets/js/addtional/modal/shuser.js"></script>
@endsection
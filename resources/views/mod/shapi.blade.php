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
        <h2 class="text-primary">Internal Application</h2>
      </div>
      <div class="section-body">

        <!-- BEGIN DATATABLE 1 -->
        <div class="row">
          <div class="col-md-12">
            <p>You can manage internal application shown on the newsfeed page here.</p>
          </div><!--end .col -->
					<div class="col-md-12">
						<button id="createButton" type="button" class="btn ink-reaction btn-raised btn-primary" data-toggle="modal" data-target="#createModal">
						Add New Internal App
						</button>
					</div>
          <div class="col-lg-12">
            <div class="table-responsive">
              <table id="datatable1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Icon</th>
                    <th>App Name</th>
                    <th>App Description</th>
                    <th>App Url</th>
										<th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($apps as $app)
                  <tr>
                    <td><img style="max-width:30px; max-height:30px;" src="{{ URL::to('/') . '/' . $app->icon_url }}" alt="appIcon"></td>
                    <td>{{ $app->name }}</td>
                    <td>{{ $app->description }}</td>
                    <td><a href="{{ $app->url }}" target="_blank">{{ $app->url }}</a></td>
										<td>
											@if ( $app->shown == 0)
                        <b> {{ "Disabled" }} </b>
                      @elseif ( $app->shown == 1)
                        <b> {{ "Enabled"}} </b>
                      @endif
										</td>
                    <td>
                      <button id="actButton" type="button" class="btn ink-reaction btn-raised btn-info" data-toggle="modal" data-target="#actModal" data-id="{{ $app->id }}" data-active="{{ $app->shown }}">
                      @if ($app->shown == 1)
												{{ "Disable" }}
											@elseif ($app->shown == 0)
												{{ "Enable" }}
											@endif
                      </button>
											<button id="delButton" type="button" class="btn ink-reaction btn-raised btn-danger" data-toggle="modal" data-target="#delModal" data-id="{{ $app->id }}">
											Delete
											</button>
                    </td>
                  </tr>
									@endforeach
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
        <h4 class="modal-title" id="simpleModalLabel">Enable / Disable App</h4>
      </div>
      <div class="modal-body">
        <p>Current status is <b id="currState"></b></p>
        <br>
        <p>Are you sure to set this app to <b id="nextState"></b> ?</p>
      </div>
      <div class="modal-footer">
			<form method="POST" action="/mod/updShownApp">
				{{ csrf_field() }}
				<input type="hidden" id="hiddenID" name="id"/>
				<input type="hidden" id="hiddenState" name="state"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-danger" value="Confirm"/>
			</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END SIMPLE MODAL MARKUP -->

<!-- BEGIN CREATE MODAL MARKUP -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Create New Internal Apps</h4>
        <input type="hidden" id="hiddenID"></input>
      </div>
      <div class="modal-body">
			<p>
        <form class="form" role="form" method="POST" action="/mod/apps" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group floating-label">
						<input type="text" class="form-control" id="appname" required="required" name="name">
						<label for="appname">App Name</label>
					</div>
					<div class="form-group floating-label">
						<input type="text" class="form-control" id="appdesc" required="required" name="description">
						<label for="appdesc">App Description</label>
					</div>
					<div class="form-group floating-label">
						<input type="text" class="form-control" id="appurl" required="required" name="url">
						<label for="appurl">App Url</label>
						<p class="help-block">ex: http://your-internal-application.com</p>
					</div>
					<div class="form-group floating-label">
						<div class="row">
							<div class="col-md-12">
								<label class="radio-inline radio-styled">
									<input type="radio" name="shown" value="1"><span>Enable</span>
								</label>
								<label class="radio-inline radio-styled">
									<input type="radio" name="shown" value="0"><span>Disable</span>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group floating-label">
						<label for="file_url">Upload Icon</label>
						<input type="file" class="form-control" name="icon_url" id="file_url" required="required">
						<p class="help-block">Max file size is 5MB</p>
					</div>
				
			</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" value="Submit"/>
      </div>
				</form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END CREATE MODAL MARKUP -->

<!-- BEGIN DELETE MODAL MARKUP -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Delete App</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this app ??</p>
      </div>
      <div class="modal-footer">
      <form method="POST" action="/mod/delApp">
        {{ csrf_field() }}
        <input type="hidden" id="hiddenID2" name="id"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-danger" value="Confirm"/>
      </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END DELETE MODAL MARKUP -->
@endsection

@section('script')
<script src="../cms_assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="../cms_assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="../cms_assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="../cms_assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="../cms_assets/js/core/demo/Demo.js"></script>
<script src="../cms_assets/js/core/demo/DemoTableDynamic.js"></script>

<script src="../cms_assets/js/addtional/modal/shapps.js"></script>
@endsection
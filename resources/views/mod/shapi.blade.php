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
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($apps as $app)
                  <tr>
                    <td><img style="max-width:30px; max-height:30px;" src="{{ URL::to('/') . $app->icon_url }}" alt="appIcon"></td>
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
                    <td class="text-center">
                      <button id="actButton" type="button" class="btn ink-reaction btn-raised btn-info" data-toggle="modal" data-target="#actModal" data-id="{{ $app->id }}" data-active="{{ $app->shown }}">
                      @if ($app->shown == 1)
												{{ "Disable" }}
											@elseif ($app->shown == 0)
												{{ "Enable" }}
											@endif
                      </button>
											<button id="editApp" type="button" class="btn ink-reaction btn-raised btn-warning" data-toggle="modal" data-target="#editAppModal" data-id="{{ $app->id }}">
											Edit
											</button>
                      <button id="paramButton" type="button" class="btn ink-reaction btn-raised btn-primary" data-toggle="modal" data-target="#paramModal" data-id="{{ $app->id }}">
											Params
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
						<input type="text" class="form-control" id="appurl" required="required" name="url">
						<label for="appurl">App Url</label>
						<p class="help-block">ex: http://internal.api/public/login</p>
					</div>
          <div class="form-group floating-label">
						<input type="text" class="form-control" id="appdesc" required="required" name="description">
						<label for="appdesc">App Description</label>
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
						<p class="help-block">Max file size is 2MB</p>
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

<!-- BEGIN EDIT MODAL MARKUP -->
<div class="modal fade" id="editAppModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Edit Internal Apps</h4>
        <input type="hidden" id="hiddenID"></input>
      </div>
      <div class="modal-body">
			<p>
        <form class="form" role="form" method="POST" action="/mod/updapps" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
            <input type="hidden" id="appID2" name="id">
						<input type="text" class="form-control" id="appname2" required="required" name="name">
						<label for="appname2">App Name</label>
					</div>					
					<div class="form-group">
						<input type="text" class="form-control" id="appurl2" required="required" name="url">
						<label for="appurl2">App Url</label>
						<p class="help-block">ex: http://internal.api/public/login</p>
					</div>
          <div class="form-group">
						<input type="text" class="form-control" id="appdesc2" required="required" name="description">
						<label for="appdesc2">App Description</label>
					</div>
					<div class="form-group floating-label">
						<div class="row">
							<div class="col-md-12">
								<label class="radio-inline radio-styled">
									<input type="radio" name="shown" value="1" required="required"><span>Enable</span>
								</label>
								<label class="radio-inline radio-styled">
									<input type="radio" name="shown" value="0" required="required"><span>Disable</span>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group floating-label">
						<label for="file_url">Upload Icon</label>
						<input type="file" class="form-control" name="icon_url" id="file_url" required="required">
						<p class="help-block">Max file size is 2MB</p>
					</div>
				
			</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-warning" value="Submit"/>
      </div>
				</form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END EDIT MODAL MARKUP -->

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

<!-- BEGIN PARAM MODAL MARKUP -->
<div class="modal fade" id="paramModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Parameter Sent to Access Apps</h4>
        <input type="hidden" id="appid">
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-8">
              <h2 class="text-primary">Header</h2>
            </div>
            <div class="col-md-4">
              <h2 class="text-right">
                <button id="createButton2" type="button" class="btn ink-reaction btn-raised btn-primary" data-toggle="modal" data-target="#headerModal">
                Add Header
                </button>
              </h2>
            </div>
            <table id="headerTable" class="table table-condensed no-margin">
              <thead>
                <tr>
                  <th class="text-center">Key</th>
                  <th class="text-center">Value</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- add content dynamicaly here  --}}
              </tbody>
            </table>
          </div>
        </div>
        <hr class="ruler-m">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-8">
              <h2 class="text-primary">Body</h2>
            </div>
            <div class="col-md-4">
              <h2 class="text-right">
                <button id="createButton2" type="button" class="btn ink-reaction btn-raised btn-primary" data-toggle="modal" data-target="#bodyModal">
                Add Body
                </button>
              </h2>
            </div>
            <table id="bodyTable" class="table table-condensed no-margin">
              <thead>
                <tr>
                  <th class="text-center">Key</th>
                  <th class="text-center">Value</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- add content dynamicaly here  --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END PARAM MODAL MARKUP -->

<!-- BEGIN HEADER MODAL MARKUP -->
<div class="modal fade" id="headerModal" tabindex="18" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Add New Header Data</h4>
      </div>
      <div class="modal-body">
      <form id="headerForm" class="form" role="form">
        {{ csrf_field() }}
        <div class="form-group floating-label">
          <input type="text" class="form-control" id="headerName" required="required" name="name">
          <label for="headerName">Header Param Name</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" class="form-control" id="headerValue" required="required" name="value">
          <label for="headerValue">Header Param Value</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="submitHeaderButton">Submit</button>
			</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END HEADER MODAL MARKUP -->

<!-- BEGIN BODY MODAL MARKUP -->
<div class="modal fade" id="bodyModal" tabindex="18" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Add New Body Form Data</h4>
      </div>
      <div class="modal-body">
      <form id="bodyForm" class="form" role="form">
        {{ csrf_field() }}
        <div class="form-group floating-label">
          <input type="text" class="form-control" id="bodyName" required="required" name="name">
          <label for="bodyName">Body Param Name</label>
        </div>
        <div class="form-group floating-label">
          <select id="bodyValue" class="form-control" name="value">
            <option value="">&nbsp;</option>
            <option value="uuid">uuid</option>
            <option value="email">email</option>
            <option value="sso_id">sso_id</option>
            <option value="password">password</option>
          </select>
          <label for="bodyValue">User data from local db</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="submitBodyButton">Submit</button>
			</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END BODY MODAL MARKUP -->

<!-- BEGIN DELETE MODAL MARKUP -->
<div class="modal fade" id="delParamModal" tabindex="18" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="simpleModalLabel">Delete App</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this parameter ??</p>
      </div>
      <div class="modal-footer">
      <form id="delParamForm" action="/mod/delappparams" method="POST">
        {{ csrf_field() }}
        <input type="hidden" id="paramID" name="id" required="required">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="delParamButton">Delete</button>
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
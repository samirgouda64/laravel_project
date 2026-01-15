<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @include('includes.header')
</head>

<body>

@include('includes.sidebar')

<div class="main-content" id="mainContent">

    <!-- Breadcrumb -->
    <div class="clearfix" style="margin-bottom:15px;">
        <div class="pull-left">
            <ol class="breadcrumb" style="margin-bottom:0;">
                <li class="active">
                    <i class="glyphicon glyphicon-home"></i> Profile Setup
                </li>
            </ol>
        </div>
        <div class="pull-right" id="clockbox"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="nav-tabs-custom">
                <div id="tabs_profile">

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"> <a href="#department" data-toggle="tab">Department</a> </li>
                        <li> <a href="#emptype" data-toggle="tab">Employment Type</a> </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" style="margin-top:15px;">

                        <!-- Department Tab -->
                        <div class="tab-pane fade in active" id="department">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Department</div>

                                <div class="panel-body table-responsive">
                                    <table class="table table-bordered table-hover" id="dtbldept">
                                        <thead>
                                            <tr style="background-color:#2984d6;color:#fff">
                                                <th class="text-center">Sl No.</th>
                                                <th class="text-center">Department</th>
                                                <th class="text-center">Department Type</th>
                                            </tr>
                                        </thead>
                                        <tbody id="deptTable"></tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="divModaldept" tabindex="-1" role="dialog" data-backdrop="static">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">
                                                <span id="lblModalDept"></span> DEPARTMENT
                                            </h4>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <form id="frmdept" class="form-horizontal" autocomplete="on">

                                                @csrf

                                                <input type="hidden" id="hidcodedept" name="hidcodedept">
                                                <input type="hidden" id="hidDeptname" name="hidDeptname">

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">
                                                        Department <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                            id="txtdescriptiondept" name="txtdescriptiondept">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">
                                                        Department Type <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                            id="cmbdeptType" name="cmbdeptType">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" id="deptbtnSave">
                                                        <i class="fa fa-save"></i> Save
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        <i class="fa fa-close"></i> Close
                                                    </button>
                                                </div>

                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- /tab-content -->
			</div><!-- /tabs -->
		</div><!-- /.col (main col) -->
    </div>
</div>

<script src="{{ asset('assets/js/dashboard/js_dashboard.js') }}"></script>
</body>
</html>

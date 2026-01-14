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

    <!-- Main Content -->
    <div class="main-content" id="mainContent">

        <!-- Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">
                        <i class="bi bi-house"></i> Profile Setup
                    </li>
                </ol>
            </nav>
            <div id="clockbox"></div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3" id="studentTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="time-slip-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#time_slip"
                        type="button"
                        role="tab">
                    Time Slip
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="inout-log-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#inout_log"
                        type="button"
                        role="tab">
                    IN/OUT Log
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">

            <!-- Time Slip Tab -->
            <div class="tab-pane fade show active" id="time_slip" role="tabpanel">
                <div class="card border-primary mb-4">
                    <div class="card-header bg-primary text-white">
                        Time Slip
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover align-middle" id="dtblTimeslip">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Father</th>
                                    <th>Mother</th>
                                    <th>Residential</th>
                                    <th>Profile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="studentTable"></tbody>
                        </table>
                    </div>
                </div>
                <button id="btnFacultyAdd">ADD</button>
                <!-- Modal Form Faculty -->
                <div class="modal fade" id="divModalFaculty" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">
                                    <span id="lblModalStream">ADD</span> School/Organization
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form id="frmFaculty">

                                    <input type="hidden" name="hidFacultyCsrfToken" id="hidFacultyCsrfToken">

                                    <!-- Hidden Fields -->
                                    <div class="d-none">
                                        <input type="text" name="hidFacultycode" id="hidFacultycode">
                                        <input type="text" name="hidFacultyName" id="hidFacultyName">
                                    </div>

                                    <!-- School Code -->
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">
                                            School/Organization Code <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="txtFacultyCode" id="txtFacultyCode">
                                        </div>
                                    </div>

                                    <!-- School Name -->
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">
                                            School/Organization Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="txtFacultyName" id="txtFacultyName">
                                        </div>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="btnSaveFaculty">
                                            <i class="fa fa-save"></i> Save
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            <i class="fa fa-close"></i> Close
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- IN/OUT Log Tab -->
            <div class="tab-pane fade" id="inout_log" role="tabpanel">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        IN / OUT Log
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover align-middle" id="dtblslip">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Father</th>
                                    <th>Mother</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="studentInOut"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
 <script src="{{ asset('assets/js/dashboard/js_dashboard.js') }}"></script>
</html>

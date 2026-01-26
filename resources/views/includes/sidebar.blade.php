<!-- Navigation Bar -->
<div id="navbar" class="fixed-header">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <span class="navbar-logo">
                    <img src="{{ session('profile_image_url') }}" style="width:20px;height:20px" alt="User Image" />
                </span>
            </div>
            <div class="navbar-header">
                <span class="navbar-company">
                    Company Name
                </span>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ session('profile_image_url') }}" style="width:20px;height:20px" alt="User Image" />
                        <span>{{ session('display_name') }} ({{ session('role_type') }})<i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu" style="height: auto">
                        <li class="user-header bg-light-blue">
                            <img src="{{ session('profile_image_url') }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ session('display_name') }}<br />
                                {{ session('role_type') }}
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <button class="btn btn-default btn-flat btn custom-btn-left">
                                    <i class="fa fa-cog"></i>
                                    Settings
                                </button>
                            </div>
                            <div class="pull-right">
                                <button id="logoutBtn" class="btn btn-default btn-flat btn custom-btn-right">
                                    <i class="fa fa-lock"></i>
                                    Sign out
                                </button>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a class="logo-text" href="#">Dashboard</a>
            <div class="arrow-controls">
                <i class="fa fa-angle-left arrow arrow-left"></i>
                <i class="fa fa-angle-right arrow arrow-right"></i>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="active">
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- For HR -->

            @if(session('role_code') == 'RLADMIN' || session('role_code') == 'RLHR')
            <li class="has-submenu">
                <a href="#" class="toggle-submenu">
                    <i class="fa fa-users"></i>
                    <span>HRMS</span>
                    <i class="fa fa-chevron-right submenu-icon"></i>
                </a>

                <ul class="submenu">

                    <!-- HR SETUP -->
                    <li class="has-submenu">
                        <a href="#" class="toggle-submenu">
                            <i class="fa fa-cogs"></i>
                            <span>HR Setup</span>
                            <i class="fa fa-chevron-right submenu-icon"></i>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="/hr/setup/employee">
                                    <i class="fa fa-id-card"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="/hr/setup/department">
                                    <i class="fa fa-plane"></i> Leave
                                </a>
                            </li>
                            <li>
                                <a href="/hr/setup/designation">
                                    <i class="fa fa-calendar-check-o"></i> Attendance
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- HR ACTIVITY -->
                    <li class="has-submenu">
                        <a href="#" class="toggle-submenu">
                            <i class="fa fa-tasks"></i>
                            <span>HR Activity</span>
                            <i class="fa fa-chevron-right submenu-icon"></i>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="/hr/activity/joining">
                                    <i class="fa fa-user-plus"></i> Joining
                                </a>
                            </li>
                            <li>
                                <a href="/hr/activity/profile">
                                    <i class="fa fa-id-card"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="/hr/activity/leave">
                                    <i class="fa fa-plane"></i> Leave
                                </a>
                            </li>
                            <li>
                                <a href="/hr/activity/attendance">
                                    <i class="fa fa-calendar-check-o"></i> Attendance
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            @endif

            <!-- For Employees -->
            @if(session('role_code') == 'RLADMIN' || session('role_code') == 'RLEMPLOYEE')
            <li class="has-submenu">
                <a href="#" class="toggle-submenu">
                    <i class="fa fa-users"></i>
                    <span>HRMS(Employee)</span>
                    <i class="fa fa-chevron-right submenu-icon"></i>
                </a>

                <ul class="submenu">

                    <!-- Employee Activity -->
                    <li class="has-submenu">
                        <a href="#" class="toggle-submenu">
                            <i class="fa fa-cogs"></i>
                            <span>Activity</span>
                            <i class="fa fa-chevron-right submenu-icon"></i>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="/hr/setup/employee">
                                    <i class="fa fa-id-card"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="/hr/setup/department">
                                    <i class="fa fa-plane"></i> Leave
                                </a>
                            </li>
                            <li>
                                <a href="/hr/setup/designation">
                                    <i class="fa fa-calendar-check-o"></i> Attendance
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Employee Reports -->
                    <li class="has-submenu">
                        <a href="#" class="toggle-submenu">
                            <i class="fa fa-tasks"></i>
                            <span>Reports</span>
                            <i class="fa fa-chevron-right submenu-icon"></i>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="/hr/activity/joining">
                                    <i class="fa fa-money"></i> salary Slip
                                </a>
                            </li>
                            <li>
                                <a href="/hr/activity/profile">
                                    <i class="fa fa-bar-chart"></i> Employee Report
                                </a>
                            </li>
                            <li>
                                <a href="/hr/activity/leave">
                                    <i class="fa fa-envelope"></i> Mail Contact
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            @endif
        </ul>

    </div>
</div>

<script>
$(document).ready(function(){
    $('#logoutBtn').click(function(){
        console.log("clicked");
		$.ajax({
			url:'/logout',
			type:'GET',
			success: function(result){
				if(result.dbStatus ==  'SUCCESS'){
					toastr.success(result.dbMessage);
					window.location.href = result.redirect_url;
				}
			},
			error:function(){
				toastr.error('Unable to process please contact support');
			}
		});
	});

    // Hide all submenus initially
    $('.sidebar .submenu').hide();

    // MULTI-LEVEL SUBMENU TOGGLE (FIXED)
    $(document).on('click', '.toggle-submenu', function (e) {
        e.preventDefault();

        let parentLi = $(this).parent('.has-submenu');
        let currentSubmenu = parentLi.children('.submenu');

        // Close ONLY same-level siblings
        parentLi
            .siblings('.has-submenu')
            .removeClass('open')
            .children('.submenu')
            .slideUp(200);

        // Toggle current submenu
        parentLi.toggleClass('open');
        currentSubmenu.slideToggle(200);
    });

    
})
</script>
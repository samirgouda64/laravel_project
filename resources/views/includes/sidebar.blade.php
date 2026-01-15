<!-- Navigation Bar -->
<div id="navbar" class="fixed-header">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="" class="img-circle" width="40" height="40" alt="Profile">
                        <span class="std_name">Name</span>
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li style="padding:10px;">
                            <div class="clearfix">
                                <img src="" class="img-circle pull-left" width="40" height="40" alt="Profile">
                                <div style="margin-left:55px;">
                                    <strong id="userName">Name</strong><br>
                                    <span id="userEmail">Email</span>
                                </div>
                            </div>
                        </li>

                        <li class="divider"></li>

                        <li style="padding:10px;">
                            <a href="#">
                                <i class="fa fa-cog"></i> Settings
                            </a>
                        </li>

                        <li>
                            <form id="logoutForm" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger" style="padding-left:20px;">
                                    <i class="fa fa-sign-out"></i> Logout
                                </button>
                            </form>
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

            <li id="viewUsersBtn">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
        </ul>
    </div>
</div>

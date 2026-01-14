<!-- Navigation Bar -->
    <div id="navbar" class="fixed-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="" alt="Profile" class="rounded-circle" width="40" height="40">
                                <span class="std_name">Name</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li class="px-3 py-2">
                                    <div id="profile_section" class="d-flex align-items-center">
                                    <img src="" alt="Profile" class="rounded-circle" width="40" height="40">
                                        <div>
                                            <div class="fw-bold" id="userName">Name</div>
                                            <div class="fw-bold" id="userEmail" >Email</div>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="px-3 py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="dropdown-item px-0" href="#"><i class="fas fa-cog me-1"></i> Settings</a>
                                        <form id="logoutForm" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline text-decoration-none">
                                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a class="logo-text" href="#">Dashboard</a>
                <div class="arrow-controls">
                <i class="fa-solid fa-angle-left arrow arrow-left"></i>
                <i class="fa-solid fa-angle-right arrow arrow-right"></i>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="active">
                <a href="#">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li id="viewUsersBtn">
                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
        </ul>
    </div>
<style>

.custom-btn-left,
.custom-btn-right {
    background-color: #f8f9fa;  
    border: 1px solid #ddd;     
    color: #333;              
    padding: 6px 12px;
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.custom-btn-left:hover,
.custom-btn-right:hover {
    background-color: #007bff;  
    color: #fff;                
    transform: translateY(-2px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
.custom-btn-left:hover {
    background-color: #28a745; 
}

.navbar-right .user-menu > a {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
}
.navbar-right .user-menu > a:hover {
    background-color: #1a2732;
    border-radius: 4px;
}
.navbar-right .user-menu img {
    border-radius: 50%;
    margin-right: 8px;
    width: 32px;
    height: 32px;
    object-fit: cover;
    border: 2px solid #fff;
}
.navbar-right .user-menu .dropdown-menu {
    width: 250px;
    border-radius: 6px;
    padding: 0;
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}
.user-header {
    text-align: center;
    padding: 15px;
    color: #fff;
    background: linear-gradient(135deg, #3498db, #2980b9);
}
.user-header img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid #fff;
    margin-bottom: 10px;
}
.user-header p {
    margin: 0;
    font-size: 14px;
    line-height: 1.4;
}
.user-footer {
    padding: 10px;
    background: #f9f9f9;
    display: flex;
    justify-content: space-between;
}
.user-footer a.btn {
    font-size: 13px;
    padding: 5px 10px;
    border-radius: 4px;
    color: #333;
    text-decoration: none;
}
.user-footer a.btn:hover {
    background-color: #3498db;
    color: #fff;
    border-color: #3498db;
}
.user-menu span {
    margin-left: 5px;
    font-weight: 600;
    color: #fff;
}
.user-menu .caret {
    margin-left: 3px;
}
</style>


<!-- Navigation Bar -->
<div id="navbar" class="fixed-header">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('assets/images/profile_16.png') }}" style="width:20px;height:20px" alt="User Image" />
                        <span>{{ session('username') }} ({{ session('role') }})<i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu" style="height: auto">
                        <li class="user-header bg-light-blue">
                            <img src="{{ asset('assets/images/profile_16.png') }}" class="img-circle" alt="User Image" />
                            <p>
                                {{ session('username') }}<br />
                                {{ session('role') }}
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

            <li id="viewUsersBtn">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
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
		})
	})
})
</script>
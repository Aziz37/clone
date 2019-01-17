    <div class="container-fluid">
        <div class="row">

            <!--sidebar-->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-colum mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/archive">
                                <i class="fas fa-archive"></i> Archived Projects
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>USER MANAGEMENT</span>
                    </h6>
                    <ul class="nav flex-colum mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/users/">
                                <i class="fas fa-users-cog"></i> User Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/users/create">
                                <i class="fas fa-user-plus"></i> Add New Users
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>PROFILE</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/profile/{{Auth::user()->id}}/edit">
                                <i class="fas fa-cog"></i> Profile Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--end sidebar-->


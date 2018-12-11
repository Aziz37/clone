    <div class="container-fluid">
        <div class="row">

            <!--sidebar-->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>PROFILE</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/users/profile/{{Auth::user()->id}}/edit">
                                <i class="fas fa-cog"></i> Profile Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users/logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--end sidebar-->


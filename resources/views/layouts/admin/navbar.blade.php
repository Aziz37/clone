<body>
    <!--static navbar-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark bg-blue mb-4">
        <a class="navbar-brand" href="#"><i class="fas fa-project-diagram"></i> Project Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/admin"><i class="fas fa-columns"></i> Boards <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"><a href="#"><i class="fas fa-search" style="color: white"></i></a>
            </form>
        </div>
    </nav>
    <!--end navbar-->
    <div class="panel-header panel-header-sm d-flex justify-content-center">
        @if ($flash = session('message'))
            <div id="alert" class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{ $flash }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
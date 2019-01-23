<body>
    <!--static navbar-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark bg-blue mb-4">
        <a class="navbar-brand" href="#"><img src="{{URL::asset('/img/gp.png')}}" style="height:35px"> Digital Project Board</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
                      Export Report
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/admin/export">Excel file (.xlsx)</a>
                    </div>
                </li>
            </ul>
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
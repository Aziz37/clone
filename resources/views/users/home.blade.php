@extends('layouts.admin.master')

@section('content')
    <!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h5><i class="fas fa-user-circle"></i> All Boards</h5>
        </div>
        
            @foreach($boards->chunk(3) as $chunks)
                <div class="row">
                    @foreach($chunks as $board)
                    <a href="/users/boards/{{$board->id}}">
                        <div class="card home-card">
                            <div class="card-body">
                                <h5 class="card-title">{{$board->title}}</h5>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endforeach
        </div>

    </main>
    <!--end main section-->
@endsection
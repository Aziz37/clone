@extends('layouts.admin.master')

@section('content')
    <!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h5><i class="fas fa-user-circle"></i> Personal Boards</h5>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createBoard"><i class="fas fa-plus"></i> Create a New Board</button>
        </div>
        
            @foreach($boards->chunk(3) as $chunks)
                <div class="row">
                    @foreach($chunks as $board)
                    <a href="/admin/boards/{{$board->id}}">
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
        <div class="text-center">
            
        </div>

        <div class="modal fade" id="createBoard" tabindex="-1" role="dialog" aria-labelledby="createBoardLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createBoardLabel">Create a New Board</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/admin/boards">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label for="objective">Objective</label>
                                <input type="text" class="form-control" name="objective">
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Create Board</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!--end main section-->
@endsection
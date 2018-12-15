@extends('layouts.user.master')

@section('content')
	<!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h5><a href="/users/boards/{{$card->board->id}}"><i class="fas fa-angle-left"></i> </a> <i class="fas fa-chalkboard"></i> <button class="btn {{$card->color}}">{{$card->title}}</button> 
            </h5>
            <p> in list {{$card->list->name}}</p>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @if(isset($card->due_date) && isset($card->due_time))
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Due Date</div>
                                <div class="card-text">
                                    {{$card->date_format($card->due_date)}} at {{$card->time_format($card->due_time)}}
                                </div>
                            </div>
                        </div>
                        <br/>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="fas fa-bars"></i> Description</div>
                            <div class="card-text">
                                @if(isset($card->description))
                                    <p class="description">{{$card->description}}</p>
                                @else
                                    <p>No description yet</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    @if(count($card->files)>0)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="fas fa-paperclip"></i> Attachments</div>
                            <div class="card-text">
                                <ul class="list-group list-group-flush">
                                    @foreach($card->files as $file)
                                        <li class="list-group-item"><img class="img-thumbnail" src="{{ Storage::url($file->path) }}" alt="{{$file->filename}}" style="max-width:70px">
                                            &nbsp{{$file->filename}}
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('deleteFile_{{$file->id}}').submit();" style="float:right">
                                                Delete
                                            </a>
                                            <form method="POST" action="/users/files/{{$file->id}}" id="deleteFile_{{$file->id}}" style="display:none">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br/>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="far fa-comment"></i> Add Comment</div>
                            <div class="card-text">
                                <div class="form-group">
                                    <form method="POST" action="/users/comments">
                                        @csrf
                                        <textarea class="form-control" name="body" placeholder="Write a comment"></textarea>
                                        <input type="hidden" value="{{$card->id}}" name="card_id">
                                        <br/>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><i class="far fa-comments"></i> Comments</div>
                            <div class="card-text">
                                @if(count($card->comments)==0)
                                    <p>No comments yet</p>
                                @endif
                                @foreach($card->comments as $comment)
                                    <div class="card comment-card">
                                        <div class="card-header">
                                            @if($comment->admin_id)
                                                <strong>{{$comment->admin->name}}</strong> <span style="font-size:12px">{{$comment->created_at->diffForHumans()}}</span>
                                            @elseif($comment->user_id)
                                                <strong>{{$comment->user->name}}</strong> <span style="font-size:12px">{{$comment->created_at->diffForHumans()}}</span>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <p>{{$comment->body}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br/>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="sidebar-module sidebar-module-inset">
                        <div class="sidebar-module">
                            <h6>ADD TO CARD</h6>
                            <ol class="list-unstyled">
                                <li>
                                    <i class="far fa-clock"></i> <a class="changeDate" id="changeDate" data-form-id="{{$card->id}}" href="#">Due Date</a>
                                </li>
                                <div class="card member-card" id="date_{{$card->id}}" style="display:none">
                                    <div class="card-body">
                                        <p class="text-center">Change Due Date</p>
                                        <form method="POST" action="/users/cards/{{$card->id}}">
                                            @method('PATCH')
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date">Date</label>
                                                    <input type="date" id="datepicker_{{$card->id}}" class="form-control" name="date" value="{{$card->due_date}}"/>
                                                </div>
                                                <div class="col">
                                                    <label for="time">Time</label>
                                                    <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true" >
                                                        <input type="text" name="time" class="form-control" value="{{$card->due_time}} ">
                                                        <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/><br/>
                                            <input type="hidden" name="card_id" value="{{$card->id}}">
                                            <button type="submit" class="btn btn-success" style="float:left">Change</button>
                                        </form>
                                        <form method="POST" action="/users/cards/{{$card->id}}">
                                            @method('PATCH')
                                            @csrf
                                            <input type="hidden" name="clear">
                                            <input type="hidden" name="card_id" value="{{$card->id}}">
                                            <button type="submit" class="btn btn-danger" style="float:right">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                <li>
                                    <i class="fas fa-paperclip"></i> <a class="showAttachment" data-form-id="{{$card->id}}" href="#">Attachment</a>
                                </li>
                                <div class="card member-card" id="attachment_{{$card->id}}" style="display:none">
                                    <div class="card-body">
                                        <p class="text-center">Add Files</p>
                                        <form method="POST" action="/users/files/upload" id="file" enctype="multipart/form-data">
                                            @csrf
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="file[]" multiple required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <input type="hidden" name="board_id" value="{{$card->board->id}}">
                                            <input type="hidden" name="list_id" value="{{$card->list->id}}">
                                            <input type="hidden" name="card_id" value="{{$card->id}}">
                                            <button type="submit" class="btn btn-info">Upload</button>
                                        </form>
                                    </div>
                                </div>
                            </ol>
                        </div>

                        <div class="sidebar-module">
                            <h6>ACTIONS</h6>
                            <ol class="list-unstyled">
                                <li>
                                    <i class="fas fa-arrow-right"></i> <a class="moveCard" id="moveCard" data-form-id="{{$card->id}}" href="#">Move</a>
                                </li>
                                <div class="card member-card" id="move_{{$card->id}}" style="display:none">
                                    <div class="card-body">
                                        <p class="text-center">Move Card</p>
                                        <form method="POST" action="/users/cards/{{$card->id}}">
                                            @method('PATCH')
                                            @csrf
                                            <div class="form-group row">
                                                <label for="list">List</label>
                                                <select class="form-control form-control-sm" name="list_id">
                                                    @foreach($card->board->lists as $listing)
                                                        <option value="{{$listing->id}}">{{$listing->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="card_id" value="{{$card->id}}">
                                            <button type="submit" class="btn btn-success" style="float:right">Move</button>
                                        </form>
                                    </div>
                                </div>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
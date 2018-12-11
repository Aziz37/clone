@extends('layouts.admin.master')

@section('content')
	<!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h5><a href="{{URL::previous()}}"><i class="fas fa-angle-left"></i> </a> <i class="fas fa-chalkboard"></i> {{$card->title}}<br/></h5><p> in list {{$card->list->name}}</p>
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
                                    <p>
                                        <a href="javascript:{}" class="description" style="display:visible; color:inherit;">{{$card->description}}</a>
                                    </p>
                                @else
                                    <a href="javascript:{}" class="description" style="display:visible; color:inherit;">Click here to add a more detailed description...</a>
                                @endif
                                <div class="form-group" id="showDescriptionForm" style="display:none">
                                    <form method="POST" action="/admin/cards/{{$card->id}}">
                                        @method('PATCH')
                                        @csrf
                                        <textarea class="form-control" name="description">{{$card->description}}</textarea>
                                        <input type="hidden" name="card_id" value="{{$card->id}}">
                                        <input type="hidden" name="desc" value="desc">
                                        <br/>
                                        <button type="submit" class="btn btn-success">Save</button>
                                        &nbsp&nbsp<a href="javascript:{}" id="hideDescriptionForm"><i class="fas fa-times"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    @if(count($card->files)>0)
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><i class="fas fa-paperclip"></i> Attachments</div>
                                <div class="card-text">
                                    @foreach($card->files as $attachment)
                                        <p>
                                            <img class="img-thumbnail" src="{{ Storage::url($attachment->path) }}" alt="{{$attachment->filename}}" style="max-width:70px">
                                            <a href="/admin/files/download/{{$attachment->id}}">
                                                {{$attachment->filename}}
                                            </a>
                                        </li>
                                            <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('deleteFile_{{$attachment->id}}').submit();" style="float:right; padding-right:10px">
                                                Delete
                                            </a>
                                        </p>
                                        <form method="POST" action="/admin/files/{{$attachment->id}}" id="deleteFile_{{$attachment->id}}" style="display:none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    @endforeach
                                    <p>
                                        <a class="showAttachment" id="showAttachment" data-form-id="{{$card->id}}" href="#">Add an attachment...</a>
                                        <div class="card member-card" id="attachment_{{$card->id}}" style="display:none">
                                            <div class="card-body">
                                                <p class="text-center">Attach Files</p>
                                                <form method="POST" action="/admin/files/upload" id="file" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" name="file[]" multiple>
                                                        <label class="custom-file-label" for="customFile">Choose file(s)</label>
                                                        <input type="hidden" name="admin" value="admin">
                                                        <input type="hidden" name="board_id" value="{{$card->board->id}}">
                                                        <input type="hidden" name="list_id" value="{{$card->list->id}}">
                                                        <input type="hidden" name="card_id" value="{{$card->id}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </form>
                                            </div>
                                        </div>
                                    </p>
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
                                    <form method="POST" action="/admin/comments">
                                        @csrf
                                        <textarea class="form-control" name="body">Write a comment</textarea>
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
                                            <strong>{{$comment->admin->name}}</strong> <span style="font-size:12px">{{$comment->created_at->diffForHumans()}}</span>
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
                                    <i class="far fa-user"></i> <a class="showMembers" id="showMembers" data-form-id="{{$card->id}}" href="#">Members</a>
                                </li>
                                <div class="card member-card" id="members_{{$card->id}}" style="display:none">
                                    <div class="card-body">
                                        <p class="text-center">Members</p>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <li>
                                    <i class="far fa-clock"></i> <a class="changeDate" id="changeDate" data-form-id="{{$card->id}}" href="#">Due Date</a>
                                </li>
                                <div class="card member-card" id="date_{{$card->id}}" style="display:none">
                                    <div class="card-body">
                                        <p class="text-center">Change Due Date</p>
                                        <form method="POST" action="/admin/cards/{{$card->id}}">
                                            @method('PATCH')
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date">Date</label>
                                                    <input id="datepicker_{{$card->id}}" class="form-control" name="date" value="{{$card->due_date}}"/>
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
                                        <form method="POST" action="/admin/cards/{{$card->id}}">
                                            @method('PATCH')
                                            @csrf
                                            <input type="hidden" name="clear">
                                            <input type="hidden" name="card_id" value="{{$card->id}}">
                                            <button type="submit" class="btn btn-danger" style="float:right">Remove</button>
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
                                        <form method="POST" action="/admin/cards/{{$card->id}}">
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
                                <li>
                                    <i class="far fa-trash-alt"></i> <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('deleteCard_{{$card->id}}').submit();">
                                    Delete</a>
                                </li>
                                <form method="POST" action="/admin/cards/{{$card->id}}" id="deleteCard_{{$card->id}}" style="display:none">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
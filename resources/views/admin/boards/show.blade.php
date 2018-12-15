@extends('layouts.admin.master')

@section('content')
    <div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="inviteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inviteModalLabel">Invite Members to this board</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form method="POST" action="/admin/boards/addUser">
                        @csrf
                        <select class="js-example-basic-single" name="member" style="width:100%">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" value="{{$board->id}}" name="board_id">
                        <button type="submit" class="btn btn-primary add-member">Add members</button>
                    </form>
                </div>
                <h6>Invited Members</h6>
                <ul class="list-group list-group-flush">
                    @foreach($board->users as $user)
                        <li class="list-group-item">{{$user->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!--create list modal-->
    <div class="modal fade" id="createList" tabindex="-1" role="dialog" aria-labelledby="createListLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="/admin/lists">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Enter list title...">
                            <input type="hidden" name="board_id" value="{{$board->id}}">
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add List</button>
                    </form>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end create list modal-->

	<!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 main">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom board-title">
            <h5>
                <a href="/admin"><i class="fas fa-angle-left"></i> </a><i class="fas fa-columns"></i> {{ $board->title }}  |
                <span class="h6"><i class="fas fa-user-plus"></i> <a href="#" data-toggle="modal" data-target="#inviteModal">Invite</a></span>
            </h5> 
            <h6>   
                Project Progress: {{$percentage}}%
                 <div class="progress" style="width:600px">
                    <div class="progress-bar bg-success" style="width:{{$percentage}}%">
                    </div>
                </div>
            </h6>

            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <h5 class="card-header">Objective</h5>
                        <div class="card-body">
                            <div class="card-text">{{$board->objective}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <h5 class="card-header">{{$board->title}} Due Date</h5>
                        <div class="card-body">
                            <div class="card-text">
                                @if(isset($board->due_date) && isset($board->due_time))
                                    <div id="dueDate">
                                    {{$board->date_format($board->due_date)}} at {{$board->time_format($board->due_time)}}
                                    <a href="#" id="noDate" style="float:right">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </div>
                                @else
                                    <a href="#" id="noDate">No Dates set yet. Click to set date</a>
                                @endif
                                <div id="setDate" style="display:none">
                                <form method="POST" action="/admin/boards/{{$board->id}}" >
                                    @method('PATCH')
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="date">Date</label>
                                            <input type="date" id="datepicker_{{$board->id}}" class="form-control" name="date" value="{{$board->due_date}}"/>
                                        </div>
                                        <div class="col">
                                            <label for="time">Time</label>
                                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true" >
                                                <input type="text" name="time" class="form-control" value="{{$board->due_time}} ">
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <input type="hidden" name="board_id" value="{{$board->id}}">
                                    <button type="submit" class="btn btn-success" style="float:left">Change</button>
                                </form>
                                <form method="POST" action="/admin/boards/{{$board->id}}">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="clear">
                                    <input type="hidden" name="board_id" value="{{$board->id}}">
                                    <button type="submit" class="btn btn-danger" style="float:right">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <section class="lists-container">
            @if(count($board->lists)>0)
                @foreach($board->lists as $list)
                    <div class="list">
                        <h3 class="list-title">
                            {{$list->name}}
                            <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('deleteList_{{$list->id}}').submit();">
                                <i class="fas fa-times" style="float:right"></i>
                            </a>
                            <form method="POST" action="/admin/lists/{{$list->id}}" id="deleteList_{{$list->id}}" style="display:none">
                                @method('DELETE')
                                @csrf
                            </form>
                        </h3>
                        <ul class="list-items">
                            @foreach($list->cards as $card)
                                <li class="{{$card->color}}"><a href="/admin/cards/{{$card->id}}">
                                    {{$card->title}}
                                    <a href="#" class="options" data-toggle="modal" data-target="#options_{{$card->id}}"> 
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @if(isset($card->due_date) || isset($card->due_time))
                                    <div class="badges">
                                        @if($card->due_date > Carbon\Carbon::now()->toDateString() && $card->due_time > Carbon\Carbon::now()->addHours(12)->toTimeString())
                                            <div class="badge green-badge">
                                        @elseif($card->due_date == Carbon\Carbon::now()->toDateString() && $card->due_time > Carbon\Carbon::now()->addHours(6)->toTimeString())
                                            <div class="badge yellow-badge">
                                        @elseif($card->due_date <= Carbon\Carbon::now()->toDateString() && $card->due_time < Carbon\Carbon::now()->addHours(6)->toTimeString())
                                            <div class="badge red-badge">
                                        @endif
                                            <i class="far fa-clock"></i> 
                                            <span class="badge-text">{{$card->date_format($card->due_date)}}</span>
                                        </div>
                                    </div>
                                    @endif

<!-- Options Modal -->
<div class="modal fade" id="options_{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="optionsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="optionsLabel">{{$card->title}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>
                        <i class="fas fa-palette"></i> <a class="setColor" id="setColor" data-form-id="{{$card->id}}" href="#">Set Color</a>
                    </li>
                    <div class="card member-card" id="colors_{{$card->id}}" style="display:none">
                        <div class="card-body">
                            <div class="row text-center">
                                <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('red_{{$card->id}}').submit();">
                                    <span class="border colors red"></span>
                                </a>
                                <form method="POST" action="/admin/cards/{{$card->id}}" id="red_{{$card->id}}" style="display:none">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="card_id" value="{{$card->id}}">
                                    <input type="hidden" name="color" value="red">
                                </form>
                                <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('purple_{{$card->id}}').submit();">
                                    <span class="border colors purple"></span>
                                </a>
                                <form method="POST" action="/admin/cards/{{$card->id}}" id="purple_{{$card->id}}" style="display:none">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="card_id" value="{{$card->id}}">
                                    <input type="hidden" name="color" value="purple">
                                </form>
                                <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('blue_{{$card->id}}').submit();">
                                    <span class="border colors blue"></span>
                                </a>
                                <form method="POST" action="/admin/cards/{{$card->id}}" id="blue_{{$card->id}}" style="display:none">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="card_id" value="{{$card->id}}">
                                    <input type="hidden" name="color" value="blue">
                                </form>
                                <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('orange_{{$card->id}}').submit();">
                                    <span class="border colors orange"></span>
                                </a>
                                <form method="POST" action="/admin/cards/{{$card->id}}" id="orange_{{$card->id}}" style="display:none">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="card_id" value="{{$card->id}}">
                                    <input type="hidden" name="color" value="orange">
                                </form>
                                <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('yellow_{{$card->id}}').submit();">
                                    <span class="border colors yellow"></span>
                                </a>
                                <form method="POST" action="/admin/cards/{{$card->id}}" id="yellow_{{$card->id}}" style="display:none">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="card_id" value="{{$card->id}}">
                                    <input type="hidden" name="color" value="yellow">
                                </form>
                                <a href="javascript:{}" onclick="event.preventDefault(); document.getElementById('white_{{$card->id}}').submit();">
                                    <span class="border colors white"></span>
                                </a>
                                <form method="POST" action="/admin/cards/{{$card->id}}" id="white_{{$card->id}}" style="display:none">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="card_id" value="{{$card->id}}">
                                    <input type="hidden" name="color" value="white">
                                </form>
                            </div>
                        </div>
                    </div>
                    <li>
                        <i class="far fa-user"></i> <a class="showMembers" id="showMembers" data-form-id="{{$card->id}}" href="#">Change members</a>
                    </li>
                    <div class="card member-card" id="members_{{$card->id}}" style="display:none">
                        <div class="card-body">
                            <div>
                                <form method="POST" action="/admin/cards/addUser">
                                    @csrf
                                    <select class="js-example-basic-single" name="member" style="width:100%">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{$card->id}}" name="card_id">
                                    <button type="submit" class="btn btn-success add-member">Add user</button>
                                </form>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($card->admins as $admin)
                                    <li class="list-group-item">{{$admin->name}}</li>
                                @endforeach
                                @foreach($card->users as $user)
                                    <li class="list-group-item">{{$user->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
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
                                        @foreach($board->lists as $listing)
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
                        <i class="far fa-clock"></i> <a class="changeDate" id="changeDate" data-form-id="{{$card->id}}" href="#">Change Due Date</a>
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
                                        <input type="date" id="datepicker_{{$card->id}}" class="form-control" name="date" value="{{$card->due_date}}"/>
                                    </div>
                                    <div class="col">
                                        <label for="time">Time</label>
                                        <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true" >
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
                </ul>
            </div>
        </div>
    </div>
</div>
<!--End Options Modal-->
                                </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#" class="add-card-btn btn showForm user-end" id="showForm_{{$list->id}}" data-form-id="{{$list->id}}"><i class="fas fa-plus"></i> Add a card</a>
                        <div id="{{$list->id}}" style="display:none">
                            <form method="POST" action="/admin/cards" style="margin:5px">
                                @csrf
                                <input type="text" class="form-control" name="title" placeholder="Enter a title for this card...">
                                <input type="hidden" name="board_id" value="{{$board->id}}">
                                <input type="hidden" name="list_id" value="{{$list->id}}"><br/>
                                <button type="submit" class="btn btn-success">Add Card</button>
                                <a href="#" class="closeForm" data-form-id="{{$list->id}}"><i class="fas fa-times"></i></a>
                            </form>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="add-list-btn btn" data-toggle="modal" data-target="#createList"><i class="fas fa-plus"></i> Add another list</button>
            @else
                <button type="button" class="add-list-btn btn" data-toggle="modal" data-target="#createList"><i class="fas fa-plus"></i> Add a list</button>
            @endif
        </section>
    </main>
@endsection
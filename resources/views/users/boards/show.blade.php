@extends('layouts.user.master')

@section('content')
	<!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 main">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom board-title">
            <h5>
            	<a href="/users/home"><i class="fas fa-angle-left"></i> </a><i class="fas fa-columns"></i> {{ $board->title }}
            </h5>
            <h6>
                <i class="fas fa-user-plus"></i> <a href="#" data-toggle="modal" data-target="#inviteModal">Invite</a>
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
                                <form method="POST" action="/users/boards/{{$board->id}}" >
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
                                <form method="POST" action="/users/boards/{{$board->id}}">
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
@endsection
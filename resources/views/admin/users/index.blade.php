@extends('layouts.admin.master')

@section('content')
	<!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h5><a href="{{URL::previous()}}"><i class="fas fa-angle-left"></i> </a> <i class="fas fa-users"></i> All Users</h5>
            <a href="/admin/users/create" class="btn btn-success"><i class="fas fa-user-plus"></i> Add New User</a>
        </div>

        <div class="content">
        	<div class="row">
        		<div class="col-md-12">
        			@if(count($users)>0)
	        			<table class="table table-striped text-center">
	        				<thead>
	        					<tr>
	        						<th>Name</th>
									<th>Department</th>
									<th>Email Address
									<th colspan=2>Actions</th>
	        					</tr>
	        				</thead>
	        				@foreach($users as $user)
	        					<tr>
	        						<td>{{$user->name}}</td>
	        						<td>{{$user->department}}</td>
	        						<td>{{$user->email}}</td>
	        						<td>
										<a class="btn btn-info" href="/admin/users/{{ $user->id }}/edit"><i class="fas fa-pencil-alt"></i>&nbsp&nbspEdit User Details</a>
									</td>
									<td>
										<form method="POST" action="/admin/users/{{ $user->id }}">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp&nbspDelete User</button>
										</form>
									</td>
								</tr>
	        				@endforeach
	        			</table>
	        			{{$users->links()}}
        			@else
        				<p>There are no users yet</p>
        			@endif
        		</div>
        	</div>
        </div>
    </main>
@endsection
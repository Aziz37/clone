@extends('layouts.admin.master')

@section('content')
	<!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h5><a href="{{URL::previous()}}"><i class="fas fa-angle-left"></i> </a> <i class="fas fa-user"></i> User Information</h5>
        </div>

        <div class="content">
        	<div class="row">
        		<div class="col-md-6">
        			<div class="card">
        				<div class="card-header">
        					<h5>Edit User Details</h5>
        				</div>
        				<div class="card-body">
		        			<form method="POST" action="/admin/users/{{ $user->id }}">
								@method('PATCH')
								@csrf
								<div class="form-group">
									<label for="name">Name</label>
									<input class="form-control" type="text" name="name" value="{{ $user->name }}" disabled>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
								</div>
								<div class="form-group">
									<label for="department">Department</label>
									<input class="form-control" type="text" name="department" value="{{ $user->department }}" required>
								</div>
								<button type="submit" class="btn btn-primary btn-round">Change</button>
							</form>
						</div>
					</div>
        		</div>

        		<div class="col-md-6">
        			<div class="card">
        				<div class="card-header">
        					<h5>Change Password</h5>
        				</div>
        				<div class="card-body">
		        			<form method="POST" action="/admin/users/{{ $user->id }}">
								@method('PATCH')
								@csrf
								<div class="form-group">
									<label for="password">New Password </label>
									<input type="password" class="form-control" name="password" placeholder="enter new password">
								</div>
								<div class="form-group">
										<label for="password-confirm">Confirm Password</label>
										<input type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
								</div>
								<button type="submit" class="btn btn-primary btn-round" style="float:right">Change Password</button>
							</form>
						</div>
					</div>
        		</div>
        	</div>
        </div>
    </main>
@endsection
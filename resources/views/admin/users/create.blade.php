@extends('layouts.admin.master')

@section('content')
	<!--main section-->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h5><a href="{{URL::previous()}}"><i class="fas fa-angle-left"></i> </a> <i class="fas fa-user-plus"></i> Add New User</h5>
        </div>

        <div class="content">
        	<div class="row">
        		<div class="col-md-12">
        			<form method="post" action="/admin/users">
						@csrf
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<label for="email">Department</label>
							<input type="text" class="form-control" name="department" required>
						</div>
						<div class="form-row">
							<div class="col">
								<label for="password">Password</label>
								<input type="password" class="form-control" name="password" required>
							</div>
							<div class="col">
								<label for="password-confirm">Confirm Password</label>
								<input type="password" class="form-control" name="password_confirmation" required>
							</div>
						</div>
						<br/>
						<button type="submit" class="btn btn-primary btn-round">Create user</button>
					</form>
        		</div>
        	</div>
        </div>
    </main>
@endsection
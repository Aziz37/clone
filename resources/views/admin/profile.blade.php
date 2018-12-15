@extends('layouts.admin.master')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h5><i class="fas fa-user-circle"></i> Profile</h5>
    </div>
	<div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    
                    <div class="card-header">
                        <h3 class="title">
   							Edit Details
   						</h3>
   					</div>
   					 <div class="card-body">
						<h6>
							<form method="POST" action="/admin/profile/{{ $admin->id }}">
								@method('PATCH')
								@csrf
								<div class="form-group">
									<label for="name">Name</label>
									<input class="form-control" type="text" name="name" value="{{ $admin->name }}" disabled>
								</div>
								<div class="form-group">
									<lable for="department">Department</lable>
									<input class="form-control" type="text" name="department" value="{{$admin->department}}">
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input class="form-control" type="email" name="email" value="{{ $admin->email }}" required>
								</div>
								<button type="submit" class="btn btn-primary btn-round">Change</button>
							</form>
						</h6>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h3 class="title">
							Change Password
						</h3>
					</div>
					<div class="card-body">
						<h6>
							<form method="POST" action="/admin/profile/{{ $admin->id }}">
								@method('PATCH')
								@csrf
								
								<div class="form-group">
									<label for="current_password">Current Password </label>
									<input type="password" class="form-control" name="current_password" placeholder="enter current password">
								</div>
								<div class="form-group">
									<label for="password">Password </label>
									<input type="password" class="form-control" name="password" placeholder="enter new password" required>
								</div>
								<div class="form-group">
										<label for="password-confirm">Confirm Password</label>
										<input type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required>
								</div>
								<button type="submit" class="btn btn-primary btn-round" style="float:right">Change Password</button>
								<br/>
							</form>
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection
@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Profile &amp; User Settings</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if (Session::has('success'))
						<div class="alert alert-success">
							{{ Session::get('success') }}
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
							</div>
						</div>

						<div class="form-group suggestion-container">
							<label class="col-md-4 control-label">School</label>
							<div class="col-md-6">
								<div class="">
									<div class="input-group">
										<input type="text" class="form-control suggestion-input" data-submit-to="{{ url('/schools/search/') }}"  data-suggestion-submit-to="{{ url('/schools/search/') }}" data-return-field="schools" name="school" value="{{ old('school', $school->name) }}" autocomplete="false" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
										</span>
									</div>
									<ul class="list-group suggestion-list school-suggestions"></ul>
								</div>
							</div>

							<input type="hidden" class="suggestion-id" id="school-select-id" name="school_id" value="{{ old('school_id', $school->id) }}" />
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Update
								</button>
								<button type="reset" class="btn">
									Reset
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

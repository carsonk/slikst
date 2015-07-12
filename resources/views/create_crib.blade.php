@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create Crib</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/cribs/create') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group suggestion-container">
							<label class="col-md-4 control-label">Course</label>
							<div class="col-md-6">
								<div class="input-group">
									<input type="text" class="form-control suggestion-input" data-suggestion-submit-to="{{ url('/courses/search/' . $my_school->id) }}"
									data-return-field="courses" name="course" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</span>
								</div>
								<ul class="list-group suggestion-list school-suggestions"></ul>
							</div>

							<input type="hidden" class="suggestion-id" name="course_id" value="{{ old('course_id') }}" />
						</div>

						<div class="form-group suggestion-container">
							<label class="col-md-4 control-label">Professor</label>
							<div class="col-md-6">
								<div class="input-group">
									<input type="text" class="form-control suggestion-input" data-suggestion-submit-to="{{ url('/professors/search/' . $my_school->id) }}"
									data-return-field="professors" name="professor" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</span>
								</div>
								<ul class="list-group suggestion-list school-suggestions"></ul>
							</div>

							<input type="hidden" class="suggestion-id" name="professor_id" value="{{ old('professor_id') }}" />
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
								<textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Crib PDF</label>
							<div class="col-md-6">
								<input type="file" name="file" class="file file-upload" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create Crib
								</button>
								<button type="reset">
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

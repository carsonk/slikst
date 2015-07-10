@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Add Professor</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/professors/add') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">School</label>
							<div class="col-md-6">
								<div class="input-group">
									<input type="text" class="form-control" data-submit-to="{{ url('/schools/search/') }}" id="school-select" name="school" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</span>
								</div>
								<ul class="list-group suggesion-list school-suggestions"></ul>
							</div>

							<input type="hidden" id="school-select-id" name="school_id" value="{{ old('school_id') }}" />
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create School
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

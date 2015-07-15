@extends('app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">
                        <input type="text" class="form-control" name="" placeholder="Search courses..." />
                </div>
            </div>

            <ul class="list-group">

            </ul>

        </div>
        <div class="col-md-8">

    		<div class="panel panel-default">
                <div class="panel-heading">
                    Cribs
                </div>
                <div class="panel-body">

                    @forelse($cribs as $key => $crib)

						<p class="pull-right">
							<a href="{{ url('cribs/download/' . $crib->id) }}" class="btn btn-success" target="_blank">
								<span class="glyphicon glyphicon-download" aria-hidden="true"></span>&nbsp;
								Download
							</a>
						</p>
                        <h4>
                            {{ $crib->name }}
                            <small> / {{ $crib->course->name }} / {{ $crib->professor->name }}</small>
                        </h4>
                        <p>{{ $crib->description }}</p>

                        <hr />
                    @empty
                        <div class="alert alert-info" role="alert">No results found!</div>
                    @endforelse

                    <div class="clearfix">
                        <a href="{{ url('cribs/create') }}" class="btn btn-primary pull-right">Upload Crib</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection

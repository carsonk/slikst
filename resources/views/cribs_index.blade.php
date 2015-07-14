@extends('app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="" placeholder="Search courses..." />
                    </div>
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
                        <h4>
                            {{ $crib->name }}
                            <small> / {{ $crib->course->name }} / {{ $crib->professor->name }}</small>
                        </h4>
                        <p>{{ $crib->description }}</p>

                        @if(($key + 1) < count($cribs))
                         <hr />
                        @endif
                    @empty
                        <div class="alert alert-info" role="alert">No results found!</div>
                    @endforelse
                </div>
            </div>
        </div>
	</div>
</div>
@endsection

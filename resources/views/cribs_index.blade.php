@extends('app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
        <div class="col-md-8">
    		<div class="panel panel-default">
                <div class="panel-heading">
                    Cribs
                </div>
                <div class="panel-body">
                    <div class="alert alert-info" role="alert">No results found!</div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection

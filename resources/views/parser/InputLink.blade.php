@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Введите ссылку на страницу</div>

                <div class="panel-body">
                    <h1>{{ $page_name }}</h1>
                    <form method='POST' action='{{ $action }}' enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<div class="form-group">
							<label class="control-label" for="html">{{ $link }}:</label>
							<input class="form-control" id="html" name="html" type="text">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-md pull-right">FIND</button>
						</div>
						<a href="/" class="btn btn-default">CANCEL</a>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

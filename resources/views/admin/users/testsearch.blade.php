@extends('admin.layouts.app')
@section('title', 'SB Admin 2 - Bootstrap Admin Theme')
@section('javascriptUp')
    <!-- App js angular Core JavaScript -->
    <script src="<?= asset('public/app/controllers/users.js') ?>"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 class="text-primary" style="text-align: center;">Laravel 5 Search Using Elasticsearch</h1>
    </div>
</div>

<div class="container">
	<div class="panel panel-primary">
	  <div class="panel-body">
	    	<div class="row">
		  		<div class="col-lg-12">
					@if(!empty($listUsers))
						@foreach($listUsers as $key => $value)
							<h3 class="text-danger">{{ $value['email'] }}</h3>
						@endforeach
						{!! $listUsers->appends(Input::all())->render() !!}
					@endif
				</div>
		  	</div>

	  </div>
	</div>
</div>
@endsection
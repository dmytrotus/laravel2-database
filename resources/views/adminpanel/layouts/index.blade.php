@extends('adminpanel.main')
@section('content')

<div class="container">
	<div class="row">

		<div class="col-md-4">
			<div class="card" style="width: 18rem;">
			  <img class="card-img-top" src="..." alt="Card image cap">
			  <div class="card-body">
			    <h5 class="card-title">Filter</h5>
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			    <a href="#" class="btn btn-primary">Go somewhere</a>
			  </div>
			</div>
		</div>

		<div class="col-md-8">
			<h4 class="text-center">Lista użytkowników</h4>
			<ul class="list-group">
				@foreach($customers as $customer)
			  <li class="list-group-item disabled">
			  	<div class="row">
			  		<div class="col-md-3">
			  			<b>Imię: </b>{{ $customer->name }}
			  		</div>
			  		<div class="col-md-3">
			  			<b>Adres: </b>{{ $customer->adress }}
			  		</div>
			  		<div class="col-md-3">
			  			<b>Wiek: </b>{{ $customer->age }}
			  		</div>
			  		<div class="col-md-3">
			  			<b>Płeć: </b>{{ __($customer->gender) }}
			  		</div>
			  	</div>
			  	
			  </li>
			  	@endforeach
			</ul>
		</div>

		<div class="p-2 m-auto">
			{{ $customers->links('vendor.pagination.bootstrap-4') }}
		</div>
		

	</div>	
</div>

@endsection
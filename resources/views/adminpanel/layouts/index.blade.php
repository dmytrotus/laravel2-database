@extends('adminpanel.main')
@section('content')

<div class="container">
	<div class="row">

		<div class="col-md-4">
			<div class="card">
			  <div class="card-body">
			    <h4 class="card-title text-center">Filter</h4>
			    <form action="/dashboard">
			    	<div class="form-group">
			    		<label for="name">Imię</label>
			    		<input value="{{request()->name}}" class="form-control" type="text" name="name">
			    	</div>

			    	<div class="form-group">
			    		<label for="adress">Adres</label>
			    		<input value="{{request()->adress}}" class="form-control" type="text" name="adress">
			    	</div>

			    	<div class="form-group">
			    	<select name="gender" class="form-control">
			    		<option>Wybierz</option>
			    		@foreach(['male', 'female'] as $gender)
			    		<option @if(request()->gender == $gender) selected @endif value="{{ $gender }}">
			    		{{ __($gender) }}
			    		</option>
			    		@endforeach
			    	</select>
			    	</div>

			    	<div class="form-group">
			    		<label for="age">Wiek</label>
			    		<input class="form-control" type="number" name="age">
			    	</div>

			    <button type="submit" class="btn w-100 btn-primary">Filtruj</button>
			    </form>
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
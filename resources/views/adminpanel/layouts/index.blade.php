@extends('adminpanel.main')
@section('content')

<div class="container">
	<div class="row">

		<div class="col-12">
		@if(session()->has('success'))
	      <li class="alert alert-success">
	        {{ session()->get('success') }}
	      </li>
      	@endif

      	@if(session()->has('errors'))
	      	@foreach($errors->all() as $error)
	            <li class="alert alert-danger">{{$error}}</li>
	        @endforeach
	    @endif
	    </div>

		<div class="col-md-4">
			<div class="card">
			  <div class="card-body">
			    <h4 class="card-title text-center">Filter</h4>
			    <form action="{{ route('customers.index') }}">
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
			    		<option value="">Wybierz</option>
			    		@foreach(['male', 'female'] as $gender)
			    		<option @if(request()->gender == $gender) selected @endif value="{{ $gender }}">
			    		{{ __($gender) }}
			    		</option>
			    		@endforeach
			    	</select>
			    	</div>

			    	<div class="form-group">
			    		<label for="age">Wiek</label>
			    		<input value="{{request()->age}}" class="form-control" type="number" name="age">
			    	</div>

			    <button type="submit" class="btn w-100 btn-primary">Filtruj</button>
			    </form>
			  </div>
			</div>

			<div class="card mt-2">
			  <div class="card-body">
			    <h4 class="card-title text-center">Działania</h4>
				</div>

				<a href="##" id="add_customer_button" class="btn btn-sm btn-success">Dodaj użytkownika</a>
				<form id="add-customer-form" method="POST" class="d-none p-2" action="{{ route('customers.store')}}">
					@csrf
					<div class="form-group">
			    		<label for="new_customer_name">Imię</label>
			    		<input class="form-control" placeholder="Wpisz imię" type="text" name="new_customer_name">
			    	</div>

			    	<div class="form-group">
			    		<label for="new_customer_adress">Adres</label>
			    		<input class="form-control" placeholder="Wpisz adres" type="text" name="new_customer_adress">
			    	</div>

			    	<div class="form-group">
			    	<select name="new_customer_gender" class="form-control">
			    		<option>Wybierz płeć</option>
			    		@foreach(['male', 'female'] as $gender)
			    		<option value="{{ $gender }}">
			    		{{ __($gender) }}
			    		</option>
			    		@endforeach
			    	</select>
			    	</div>

			    	<div class="form-group">
			    		<label for="new_customer_age">Wiek</label>
			    		<input min="18" max="60" class="form-control" type="number" name="new_customer_age">
			    	</div>

			    	<button class="btn btn-sm btn-success" type="submit">Zapisz</button>
				</form>
				

				<form class="form-group" id="destroy-customer-form" method="POST" action="#">
					@method('delete')
					@csrf
					<input id="destroy-customer-input" type="hidden">
					<button class="btn w-100 btn-sm btn-danger mt-2" disabled type="submit">Usuń wybranego uzytkownika</button>
				</form>
			</div>
		</div>

		<div class="col-md-8">
			<h4 class="text-center">Lista użytkowników</h4>
			<ul class="list-group">
				@foreach($customers as $customer)
			  <li class="list-group-item">
			  	<div class="row">
			  		<div class="col-md-3">
			  			<b>Imię: </b>{{ $customer->name }}
			  		</div>
			  		<div class="col-md-3">
			  			<b>Adres: </b>{{ $customer->adress }}
			  		</div>
			  		<div class="col-md-1">
			  			<b>Wiek: </b>{{ $customer->age }}
			  		</div>
			  		<div class="col-md-3">
			  			<b>Płeć: </b>{{ __($customer->gender) }}
			  		</div>
			  		<div class="col-md-2">
			  			<button data-id="{{ $customer->id }}"
			  			class="choose_customer btn btn-primary btn-sm">Wybierz</button>	
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

@section('scripts')
<script>
	$('#add_customer_button').click(function(e){
		e.preventDefault();
		$('#add-customer-form').toggleClass('d-none');
	})

	$('.choose_customer').click(function(e){
		e.preventDefault();
		$user_id = $(this).attr('data-id');
		if($user_id == $('#destroy-customer-input').val())
		{
			$('.list-group-item').removeClass('bg-danger');
			$('#destroy-customer-input').val('')
			$('#destroy-customer-form > button').attr('disabled', true)
		} else {
			$('#destroy-customer-input').val($user_id);
			$('.list-group-item').removeClass('bg-danger');
			$(this).parent().parent().parent().addClass('bg-danger');
			$('#destroy-customer-form > button').attr('disabled', false)
		}
		$('#destroy-customer-form').attr('action', '/dashboard/customers/' + $('#destroy-customer-input').val())
		
	})
</script>

@endsection
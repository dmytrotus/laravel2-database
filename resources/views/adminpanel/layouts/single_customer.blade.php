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
			    <h4 class="card-title text-center">Edycja</h4>
			    <a class="btn btn-sm btn-primary" href="{{ route('customers.index')}}">Cofnij</a>
			  </div>
			</div>

		</div>

		<div class="col-md-8">
			<h4 class="text-center">{{ $customer->name }}</h4>
			<div class="form-group">
				<form method="POST" action="{{ url('dashboard/customers') }}/{{ $customer->id }}">
					@csrf
					@method('put')
				<div class="form-group">
					<label for="name">Imię</label>
					<input type="text" class="form-control" name="name" value="{{ $customer->name }}">
				</div>

				<div class="form-group">
					<label for="adress">Adres</label>
					<input type="text" class="form-control" name="adress" value="{{ $customer->adress }}">
				</div>

				<div class="form-group">
					<label for="age">Wiek</label>
					<input type="number" class="form-control" name="age" value="{{ $customer->age }}">
				</div>

				<div class="form-group">
					<label for="name">Płeć</label>
					<select name="gender" class="form-control">
						<option value="">Wybierz</option>
			    		@foreach(['male', 'female'] as $gender)
			    		<option @if($customer->gender == $gender) selected @endif value="{{ $gender }}">
			    		{{ __($gender) }}
			    		</option>
			    		@endforeach
					</select>
				</div>
				<button type="submit" class="btn btn-sm btn-success">Zapisz</button>
				</form>
			</div>

		</div>

		

	</div>	
</div>
@endsection
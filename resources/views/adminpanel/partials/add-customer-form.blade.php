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
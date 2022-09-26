<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-8 mb-3">
				<label for="numeroTarjeta" class="form-label">Numero de tarjeta</label>
				<input type="text" class="form-control" id="numeroTarjeta" name="numeroTarjeta" placeholder="4242424242424242" value="4242424242424242" max="16" max="16" required>
			</div>
			<div class="col-md-4 mb-3">
				<label for="cvv" class="form-label">CVV</label>
				<input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" value="123" min="3" max="3" required>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 mb-3">
				<label for="mesVencimiento" class="form-label">Mes de vencimiento</label>
				<select class="form-select" id="mesVencimiento" name="mesVencimiento">
					@for ($i = 1; $i <=12; $i++)
						<option value="{{ $i }}">0{{ $i }}</option>
					@endfor
				</select>
			</div>

			<div class="col-md-6 mb-3">
				<label for="anioVencimiento" class="form-label">Año de vencimiento</label>
				<select class="form-select" id="anioVencimiento" name="anioVencimiento">
					@for ($i = date('Y'); $i < (intval(date('Y')) + 11); $i++)
						<option value="{{ $i }}">{{ $i }}</option>
					@endfor
				</select>
			</div>
		</div>

		<div class="mb-3">
			<label for="emailCliente" class="form-label">Email</label>
			<input type="email" class="form-control" id="emailCliente" name="emailCliente" value="wisusdev@gmail.com">
		</div>

		<div class="mb-3">
			<label for="nombreCliente" class="form-label">Nombre completo</label>
			<input type="text" class="form-control" id="nombreCliente" name="nombreCliente" value="Jesús Avelar">
		</div>
	</div>
</div>

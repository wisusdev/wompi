<template>
	<div class="card">
		<div class="card-body">
			<input type="hidden" v-model="form.payMethod">
			<div class="mb-3">
				<label for="emailCliente" class="form-label">Email</label>
				<input type="email" class="form-control" id="emailCliente" v-model="form.emailCliente">
			</div>

			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="nombreClienteBTC" class="form-label">Nombre</label>
					<input type="text" class="form-control" id="nombreClienteBTC" v-model="form.nombreClienteBTC">
				</div>

				<div class="col-md-6 mb-3">
					<label for="apellidoCliente" class="form-label">Apellido</label>
					<input type="text" class="form-control" id="apellidoCliente" v-model="form.apellidoCliente">
				</div>
			</div>


			<div class="mb-3">
				<label for="direccionCliente" class="form-label">Dirección</label>
				<input type="text" class="form-control" id="direccionCliente" v-model="form.direccionCliente">
			</div>

			<div class="mb-3">
				<label for="documentoIdentidadCliente" class="form-label">DUI</label>
				<input type="text" class="form-control" id="documentoIdentidadCliente" v-model="form.documentoIdentidadCliente">
			</div>

			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="idRegion" class="form-label">Región</label>
					<input type="text" class="form-control" id="idRegion" v-model="form.idRegion">
				</div>

				<div class="col-md-6 mb-3">
					<label for="idTerritorio" class="form-label">Territorio</label>
					<input type="text" class="form-control" id="idTerritorio" v-model="form.idTerritorio">
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "BitcoinComponent",
		data: function () {
			return {
				form: {
					payMethod: "bitcoin",
					emailCliente: "wisusdev@gmail.com",
					nombreClienteBTC: "Jesús",
					apellidoCliente : "Avelar",
					direccionCliente: "Barrio El Centro, Chalatenango, El Salvador",
					documentoIdentidadCliente: "01234567-8",
					idRegion: "SV",
					idTerritorio: "SV-CH"
				}
			}
		},

		mounted() {
			this.$emit('bitcoinPayData', this.form);
		}
	}
</script>

<style scoped>

</style>
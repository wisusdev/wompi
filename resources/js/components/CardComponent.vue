<template>
	<div class="card">
		<div class="card-body">
			<input type="hidden" v-model="form.payMethod">
			<div class="row">
				<div class="col-md-8 mb-3">
					<label for="numeroTarjeta" class="form-label">Numero de tarjeta</label>
					<input type="text" class="form-control" id="numeroTarjeta" v-model="form.numeroTarjeta" placeholder="4242424242424242" min="16" max="16" required>
				</div>
				<div class="col-md-4 mb-3">
					<label for="cvv" class="form-label">CVV</label>
					<input type="text" class="form-control" id="cvv" v-model="form.cvv" placeholder="123" min="3" max="3" required>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="mesVencimiento" class="form-label">Mes de vencimiento</label>
					<select class="form-select" id="mesVencimiento" v-model="form.mesVencimiento">
						<option v-for="n in 12" :value="n">{{n}}</option>
					</select>
				</div>

				<div class="col-md-6 mb-3">
					<label for="anioVencimiento" class="form-label">Año de vencimiento</label>
					<select class="form-select" id="anioVencimiento" v-model="form.anioVencimiento">
						<option v-for="(n, i) in 11" :value="i + currentYear">{{ i + currentYear}}</option>
					</select>
				</div>
			</div>

			<div class="mb-3">
				<label for="emailCliente" class="form-label">Email</label>
				<input type="email" class="form-control" id="emailCliente" v-model="form.emailCliente">
			</div>

			<div class="mb-3">
				<label for="nombreCliente" class="form-label">Nombre completo</label>
				<input type="text" class="form-control" id="nombreCliente" v-model="form.nombreCliente">
			</div>
		</div>
	</div>

</template>

<script>
	import moment from "moment";

	export default {
		name: "CardComponent",

		data() {
			return {
				currentYear: 0,
				form: {
					payMethod: "card",
					numeroTarjeta: "4242424242424242",
					cvv: "123",
					mesVencimiento: "",
					anioVencimiento: "",
					emailCliente: "wisusdev@gmail.com",
					nombreCliente: "Jesús Avelar",
				},
			}
		},

		mounted() {
			this.currentYear = moment().year();

			this.$emit('cardPayData', this.form);
		}
	}
</script>

<style scoped>

</style>
<template>
	<div class="card">
		<img :src="asset('images/product.jpeg')" class="img-fluid" alt="product">
		<div class="card-body">
			<label for="monto" class="form-label">¿Cuánto quieres pagar?</label>
			<input type="number" class="form-control" step="0.01" v-model="amount" id="monto" required>
		</div>
	</div>
</template>

<script>
	export default {
		name: "ItemComponent",

		data: function () {
			return {
				amount: 0
			}
		},

		mounted() {
			this.amount = Math.floor(Math.random() * (10000 - 100) + 100) / 100;

			this.$emit('payAmount', this.amount);
		},
	}
</script>

<style scoped>

</style>
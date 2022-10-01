<template>
	<div class="card">
		<img :src="asset('images/product.jpeg')" class="img-fluid" alt="product">
		<div class="card-body">
			<label for="monto" class="form-label">¿Cuánto quieres pagar?</label>
			<input type="number" class="form-control" min="5" step="0.01" name="monto" :value="ramdomNumber" id="monto" required>
		</div>
	</div>
</template>

<script>
	export default {
		name: "ItemComponent",
		data: () => ({
			ramdomNumber: 0
		}),
		created() {
			this.ramdomNumber = Math.floor(Math.random() * (10000 - 100) + 100) / 100;
		},
		methods: {

		}
	}
</script>

<style scoped>

</style>
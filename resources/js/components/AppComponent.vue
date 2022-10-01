<template>
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="me-2" role="presentation">
			<button class="btn btn-outline-primary active" id="pills-card-tab" data-bs-toggle="pill" data-bs-target="#pills-card" type="button" role="tab" aria-controls="pills-card" aria-selected="true">Tarjeta</button>
		</li>
		<li class="me-2" role="presentation">
			<button class="btn btn-outline-warning" id="pills-bitcoin-tab" data-bs-toggle="pill" data-bs-target="#pills-bitcoin" type="button" role="tab" aria-controls="pills-bitcoin" aria-selected="false">Bitcoin</button>
		</li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-card" role="tabpanel" aria-labelledby="pills-card-tab" tabindex="0">
			<card-component></card-component>
		</div>
		<div class="tab-pane fade" id="pills-bitcoin" role="tabpanel" aria-labelledby="pills-bitcoin-tab" tabindex="0">
			<bitcoin-component></bitcoin-component>
		</div>
	</div>
</template>

<script>
	import CardComponent from "./CardComponent";
	import BitcoinComponent from "./BitcoinComponent";
	export default {
		name: "AppComponent",
		components: {
			BitcoinComponent,
			CardComponent
		}
	}
</script>

<style scoped>

</style>
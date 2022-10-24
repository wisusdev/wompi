<template>
	<form @submit.prevent="submitPay">
		<div class="card mb-3">
			<div class="card-body">
				<div class="row">

					<div class="col-md-9 mb-3">
						<div class="bg-light border rounded p-2 mb-3">
							<button class="btn btn-primary me-2" @click.prevent="show('card')">Tarjeta <i class="bi bi-credit-card"></i></button>
							<button class="btn btn-warning me-2" @click.prevent="show('bitcoin')">Bitcoin <i class="bi bi-currency-bitcoin"></i></button>
						</div>
						<div>
							<div v-if="isShowTabCard">
								<card-component @cardPayData="dataPayCard"></card-component>
							</div>
							<div v-if="isShowTabBitcoin">
								<bitcoin-component @bitcoinPayData="dataPayBitcoin"></bitcoin-component>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<item-component @payAmount="dataPayAmount"></item-component>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary float-end">Pagar</button>
			</div>
		</div>
	</form>
</template>

<script>
	import ItemComponent from "./ItemComponent";
	import CardComponent from "./CardComponent";
	import BitcoinComponent from "./BitcoinComponent";
	import Swal from "sweetalert2";
	import moment from "moment";

	export default {
		name: "FormComponent",
		components: {ItemComponent, CardComponent, BitcoinComponent},

		data: function () {
			return {
				isShowTabCard: true,
				isShowTabBitcoin: false,
				dataPay: {
					monto: 0,
					data: {

					}
				},
			}
		},

		methods: {
			show(tab) {
				this.isShowTabCard = tab === 'card';
				this.isShowTabBitcoin = tab === 'bitcoin';
			},

			dataPayAmount(data){
				this.dataPay.monto = data;
			},

			dataPayCard(data){
				this.dataPay.data = data;
			},

			dataPayBitcoin(data){
				this.dataPay.data = data;
			},

			submitPay(){
				axios.post('/wompi', this.dataPay)
				.then(response => {
					console.log(response.data);

					if(response.data.formaPago === "PagoNormal"){
						Swal.fire(
								`${response.data.mensaje}`,
								`Pago normal por $${response.data.monto}`,
								'success'
						);
					} else {
						Swal.fire({
							title: `$${response.data.monto}`,
							html: `
								<p>Forma de pago ${response.data.formaPago} <br> Precio en bitcoin <b>${response.data.datosBitcoin.ammountInBitcoins}</b></p>
								<p>Fecha vencimiento ${moment(response.data.datosBitcoin.fechaVencimiento).format('h:mm:ss a')}</p>
							`,
							imageUrl: `${response.data.datosBitcoin.urlQR}`,
							imageWidth: 400,
							imageHeight: 400,
							imageAlt: `${response.data.datosBitcoin.qrData}`,
						})
					}

				}).catch(error => {
					console.log(error.data());
					Swal.fire(
						'Oops...',
						'Lo sentimos, ocurrio un error',
						'error'
					);
				});
			}
		}
	}
</script>

<style scoped>

</style>
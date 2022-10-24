<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class WompiService {

	protected string $baseAuthUri;
	protected string $baseUri;
	protected string $key;
	protected string $secret;
	protected string $token;

	public function __construct(){
		$this->baseAuthUri = config('services.wompi.auth_uri');
		$this->baseUri = config('services.wompi.base_uri');
		$this->key = config('services.wompi.client_key');
		$this->secret = config('services.wompi.client_secret');
		$this->token = '';
	}

	public function handlePaymentCard($data) {
		$rules = [
			'numeroTarjeta' => 'required',
			'cvv' => 'required',
			'mesVencimiento' => 'required',
			'anioVencimiento' => 'required',
			'monto' => 'required',
			'emailCliente' => 'required',
			'nombreCliente' => 'required'
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes()){

			$this->getToken();

			$payment = $this->createCardPayment(
				$data['numeroTarjeta'],
				$data['cvv'],
				$data['mesVencimiento'],
				$data['anioVencimiento'],
				$data['monto'],
				$data['emailCliente'],
				$data['nombreCliente']
			);

			return $payment;
		}

		return $response = 'Lo sentimos, ocurrio un error';
	}

	public function handlePaymentBitcoin($data){

		$rules = [
			'monto' => "required",
			'emailCliente' => "required",
			'nombreClienteBTC' => "required",
			'apellidoCliente'=> "required",
			'direccionCliente' => "required",
			'documentoIdentidadCliente' => "required",
			'idRegion' => "required",
			'idTerritorio' => "required"
		];

		$validator = Validator::make($data, $rules);

		if ($validator->passes()) {

			$this->getToken();

			$response = $this->createbitcoinPayment(
				$data['monto'],
				$data['emailCliente'],
				$data['nombreClienteBTC'],
				$data['apellidoCliente'],
				$data['direccionCliente'],
				$data['documentoIdentidadCliente'],
				$data['idRegion'],
				$data['idTerritorio']
			);

			return $response;
		}

		return $response = 'Lo sentimos, ocurrio un error';
	}

	public function getToken(): void
	{
		$client = new Client([
			'base_uri' => $this->baseAuthUri,
		]);

		$response = $client->request('POST', '/connect/token', [
			'headers' => [],
			'form_params' => [
				'grant_type' => 'client_credentials',
				'client_id' => $this->key,
				'client_secret' => $this->secret,
				'audience' => 'wompi_api'
			],
		]);

		$response = $response->getBody()->getContents();
		$response = $this->decodeResponse($response);

		$this->token = $response->access_token;
	}

	public function createCardPayment($numeroTarjeta, $cvv, $mesVencimiento, $anioVencimiento, $monto, $emailCliente, $nombreCliente) {

		$data = [
			"tarjetaCreditoDebido" => [
				"numeroTarjeta" => $numeroTarjeta,
				"cvv" => $cvv,
				"mesVencimiento" => intval($mesVencimiento),
				"anioVencimiento" => intval($anioVencimiento)
			],
			"monto" => intval($monto),
			"emailCliente" => $emailCliente,
			"nombreCliente" => $nombreCliente
		];

		$client = new Client([
			'base_uri' => $this->baseUri,
		]);

		$response = $client->request('POST', '/TransaccionCompra', [
			'headers' => [
				'authorization' => "Bearer $this->token",
				'content-type' => 'application/json'
			],
			'body' => json_encode($data),
		]);

		$response = $response->getBody()->getContents();

		return $this->decodeResponse($response);

	}

	public function createbitcoinPayment($monto, $emailCliente, $nombreClienteBTC, $apellidoCliente, $direccionCliente, $documentoIdentidadCliente, $idRegion, $idTerritorio ){
		$data = [
			"monto" => $monto,
			"emailCliente" 	=> $emailCliente,
			"nombreCliente" => $nombreClienteBTC,
			"apellidoCliente"	=> $apellidoCliente,
			"direccionCliente"	=> $direccionCliente,
			"documentoIdentidadCliente"	=> $documentoIdentidadCliente,
			"idRegion"	=> $idRegion,
			"idTerritorio" => $idTerritorio
		];

		$client = new Client([
			'base_uri' => $this->baseUri,
		]);

		$response = $client->request('POST', '/TransaccionCompra/Bitcoin', [
			'headers' => [
				'authorization' => "Bearer $this->token",
				'content-type' => 'application/json'
			],
			'body' => json_encode($data),
		]);

		$response = $response->getBody()->getContents();

		return $this->decodeResponse($response);
	}

	public function decodeResponse($response) {
		return json_decode($response);
	}
}
<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

	public function handlePayment(Request $request) {
		$request->validate([
			'numeroTarjeta' => 'required',
			'cvv' => 'required',
			'mesVencimiento' => 'required',
			'anioVencimiento' => 'required',
			'monto' => 'required',
			'emailCliente' => 'required',
			'nombreCliente' => 'required'
		]);

		$this->getToken();

		$payment = $this->createPayment(
			$request->numeroTarjeta,
			$request->cvv,
			$request->mesVencimiento,
			$request->anioVencimiento,
			$request->monto,
			$request->emailCliente,
			$request->nombreCliente
		);

		if ($payment->esAprobada === true) {
			return redirect()->back()->withSuccess('¡Pago realizado con exito!');
		}

		return redirect()->back()->withErrors('Lo sentimos, ocurrio un error');
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

	public function createPayment($numeroTarjeta, $cvv, $mesVencimiento, $anioVencimiento, $monto, $emailCliente, $nombreCliente) {

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

	public function decodeResponse($response) {
		return json_decode($response);
	}
}
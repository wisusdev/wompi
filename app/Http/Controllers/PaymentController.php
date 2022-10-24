<?php

namespace App\Http\Controllers;

use App\Services\WompiService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
	public function pay(Request $request)
	{
		$rules = [
			'monto' => ['required', 'numeric', 'min:5'],
		];

		$request->validate($rules);

		$data = $request->input('data');
		$data['monto'] = $request->input('monto');

		$wompi = new WompiService();

		if ($data['payMethod'] == 'card'){
			$response = $wompi->handlePaymentCard($data);
		} else {
			$response = $wompi->handlePaymentBitcoin($data);
		}

		return response()->json($response);


	}

}

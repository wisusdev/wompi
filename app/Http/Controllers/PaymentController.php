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

		dd($request->all());

		$request->validate($rules);

		$wompi = new WompiService();

		return $wompi->handlePayment($request);
	}

}

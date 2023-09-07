<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class discountController extends Controller
{
    public function showSimpleUI()
    {
        return view('simple_ui');
    }

    public function processForm(Request $request)
    {
        // Retrieve and process form data here
        $price = $request->input('price');
        $promoCode = $request->input('promo_code');

        // Perform any necessary actions (e.g., validation, calculations, database operations)

        // Redirect back to the form with a success message or perform other actions

        // For example, redirecting back to the form with a success message:
        return redirect()->route('showSimpleUI')->with('success', 'Form submitted successfully');
    }
}

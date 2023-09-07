<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class discountController extends Controller
{

    public function showSimpleUI()
    {
        return view('simple-ui');
    }

    public function processForm(Request $request)
    {
print_r($request->all());exit;

        // Retrieve and process form data here
        $price = $request->input('price');
        $promoCode = $request->input('promo_code');
        // Perform any necessary actions (e.g., validation, calculations, database operations)

        // Redirect back to the form with a success message or perform other actions

        // For example, redirecting back to the form with a success message:
        return redirect()->route('showSimpleUI')->with('success', 'Form submitted successfully');
    }
    public function redeem(Request $request)
    {
        $code = $request->input('promo_code');
        $user = auth()->user(); // Assuming the user is authenticated

        // Check if the promo code exists
        $promoCode = PromoCode::where('code', $code)->first();

        if (!$promoCode) {
            return redirect()->back()->with('error', 'Invalid promo code.');
        }

        // Check if the promo code has already been redeemed by the user
        if ($promoCode->is_redeemed) {
            return redirect()->back()->with('error', 'This promo code has already been redeemed.');
        }

        // Implement your promo code validation logic here
        // You can use the $promoCode and $user variables to apply specific rules

        // For example, if it's a percentage discount, calculate the discounted price
        if ($promoCode->type === 'percentage') {
            $discountedPrice = $user->original_price * ($promoCode->value / 100);
        } else {
            // If it's a fixed discount, subtract the value from the original price
            $discountedPrice = $user->original_price - $promoCode->value;
        }

        // Mark the promo code as redeemed
        $promoCode->update([
            'is_redeemed' => true,
            'user_id' => $user->id,
        ]);

        return view('promo-code-result', [
            'user' => $user,
            'originalPrice' => $user->original_price,
            'discountedPrice' => $discountedPrice,
        ]);
    }
}

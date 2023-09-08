<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PromoCode;
use App\User;
class discountController extends Controller
{

    public function showSimpleUI()
    {
        return view('simple-ui');
    }

    public function processForm(Request $request)
    {
// print_r($request->all());exit;

        // Retrieve and process form data here
        $original_price = $request->input('price');
        $code = $request->input('promo_code');
        
        // For example, redirecting back to the form with a success message:
        // return redirect()->route('showSimpleUI')->with('success', 'Form submitted successfully');
    
        // $code = $request->input('promo_code');
        $user = auth()->user(); // Assuming the user is authenticated
        // $user = PromoCode->auth($credentials);

        // echo '<pre/>';print_r($user);exit;
// echo "inside redeem";
        // Check if the promo code exists
        $promoCode = PromoCode::where('code', $code)->first();
        // echo "<pre/>";print_r($promoCode);
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
            $discountedPrice = $original_price * ($promoCode->value / 100);
        } else {
            // If it's a fixed discount, subtract the value from the original price
            $discountedPrice = $original_price - $promoCode->value;
        }

        // Mark the promo code as redeemed
        $promoCode->update([
            'is_redeemed' => true,
            'user_id' => $user->id,
        ]);
// echo "stop here";exit;
        return view('promo-code-result', [
            'user' => $user,
            'originalPrice' => $original_price,
            'discountedPrice' => $discountedPrice,
        ]);
    }
}

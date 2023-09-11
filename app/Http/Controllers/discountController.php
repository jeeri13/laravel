<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PromoCode;
use App\Models\userRedeems;
use App\Models\User as users;
use App\User;

class discountController extends Controller
{

    public function showSimpleUI()
    {
        return view('simple-ui');
    }

    public function processForm(Request $request)
    {
        // $price = $request->input(price);
        // print_r($request->input(price));
        $id = session('id');
        $name = session('name');
        $email = session('email');

        $original_price = $request->input('price');
        $code = $request->input('promo_code');
        $id = session('id');
        // $allSessionData = session()->all();
        // echo '<pre>'; 
        // print_r($allSessionData);
        $user = users::getUser($id);
        // print_r($user);
        $promoCode = PromoCode::where('code', $code)->first();
        // print_r($promoCode->value);
        // $discounted_price = $original_price - $promoCode->value;
        
        if (!$promoCode) {
            return redirect()->back()->with('error', 'Invalid promo code.');
        }
        if ($promoCode && $promoCode->user_specific != 0) {
        // Check if the user ID matches the promo code's user_id
            if ($promoCode->user_id === $id) {
                $this->insertredeems($id, $promoCode->id);
                $discountedPrice = $this->calculation($promoCode->type, $promoCode->value, $original_price);
            }else{
                return redirect()->back()->with('error', 'Not eligible: Invalid promo code.');
            }
        }else if($promoCode && $promoCode->user_specific == 0){
            $this->insertredeems($id, $promoCode->id);
            $discountedPrice = $this->calculation($promoCode->type, $promoCode->value, $original_price);
        }
        return view('promo-code-result', [
            'user' => $user,
            'originalPrice' => $original_price,
            'discountedPrice' => $discountedPrice,
        ]);
    }
    public function insertredeems($user_id, $promo_id){
        $query = userRedeems::where('user_id', $user_id)
                            ->where('promo_id', $promo_id);
        //  $sql = $query->toSql();
        // dd($sql);
        $userRedeems = $query->get();
        if($userRedeems->count() == 0){
            userRedeems::insert(['user_id' => $user_id, 'promo_id' => $promo_id, 'is_redeemd' => 1, 'created_at' => now(), 'updated_at' => now()]);
        }else{
            return redirect()->back()->with('error', 'This promo code has already been redeemed.');
        }
    }
    public function calculation($promoCode_type, $promoCode_value, $original_price){
        if ($promoCode_type === 'percentage') {
            $discountedPrice = $original_price - ($original_price * ($promoCode_value / 100));
        } else {
            $discountedPrice = $original_price - $promoCode_value;
        }
        return $discountedPrice;
    }
}

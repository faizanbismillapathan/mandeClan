<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\locality;
use App\store_category;
use App\product;
use App\wishlist;
use App\product_item;
use Auth;
use View;
use \Cart as Cart;
use App\customer;
use App\store;
use App\store_cart;
use App\service;
use App\Traits\MailerTraits;
use App\admin;
use App\OTP;
use Twilio\Rest\Client;
use Exception;

class addToCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use MailerTraits;


    public function addcartcustomiseitembyajax(Request $request)
    {




        $items = DB::table('products')
            ->join('product_items', 'products.id', 'product_items.product_id')
            ->join('product_categories', 'products.product_category', 'product_categories.id')
            ->leftjoin('product_subcategories', 'products.product_subcategory', 'product_subcategories.id')
            ->select('products.id', 'products.product_name', 'product_items.item_price', 'product_items.item_offer_discount', 'product_items.item_description', 'products.store_id', 'product_items.id as item_id', 'product_items.item_attr_varient', 'products.product_category as category', 'product_categories.product_category', 'product_subcategories.product_subcategory', 'product_items.array_combine', 'product_items.item_img1', 'products.store_id', 'product_items.item_shipping_weight', 'product_items.item_shipping_weight_unit')
            ->where('product_items.id', $request->item_id)
            ->first();


        $attributes = unserialize($items->array_combine);


        // $record1=DB::table('commission_settings')->first();
        // $percentage=$record1->commission_rate;

        // $store1=store::find($this->id);

        $percents = DB::table('commission_settings')->where('commission_store_id', $items->category)->first();

        $percentage1 = 0;


        if (!empty($percents)) {
            $percentage1 = $percents->commission_rate;
        }

        $record1 = DB::table('commission_settings')->first();

        $percentage2 = $record1->commission_rate;

        $percentage = $percentage1 + $percentage2;




        // ...
        //         if (!empty($items->item_offer_discount)) {

        //               $item_price = $items->item_price - ($items->item_price * ($items->item_offer_discount / 100));
        //        }else{
        //               $item_price=$items->item_price;
        //        }

        // $percent=($percentage / 100) * $item_price;

        // $item_selling_price=$item_price+$percent;

        $percent = ($percentage / 100) * $items->item_price;


        $item_price = $items->item_price + $percent;

        // ...
        $item_selling_price = round($item_price, 2);

        if (!empty($items->item_offer_discount)) {

            $item_selling_price = round($item_price - ($item_price * ($items->item_offer_discount / 100)), 2);
        }


        $addon_group_list = DB::table('product_addons')
            ->whereIn('product_addons.id', explode(',', $request->all_check_id))
            ->pluck('product_addons.addon_name', 'product_addons.addon_price')
            ->toArray();

        $addon_grouplist = DB::table('product_addons')
            ->whereIn('product_addons.id', explode(',', $request->all_check_id))
            ->pluck('product_addons.id', 'product_addons.addon_group_id')
            ->toArray();


        $tax_price = $item_selling_price * (18 / 100);

        if (!empty($items->item_offer_discount)) {
            $price = $items->item_price - ($items->item_price * ($items->item_offer_discount / 100));
        } else {
            $price = $items->item_price;
        }



        $commission_amount = ($percentage / 100) * $price;



        $items1 = (object) [
            'id' => $items->id,
            'product_name' => $items->product_name,
            'basic_item_price' => $items->item_price,
            'item_offer_discount' => $items->item_offer_discount,
            'item_description' => $items->item_description,
            'store_id' => $items->store_id,
            'id' => $items->id,
            'item_attr_varient' => $items->item_attr_varient,
            'product_category' => $items->product_category,
            'product_category' => $items->product_category,
            'product_subcategory' => $items->product_subcategory,
            'array_combine' => $items->array_combine,
            'item_img1' => $items->item_img1,
            'store_id' => $items->store_id,
            'item_shipping_weight' => $items->item_shipping_weight,
            'item_shipping_weight_unit' => $items->item_shipping_weight_unit,
            'addon_list' => $addon_group_list,
            'addon_id' => $addon_grouplist,

            'commission_percent' => $percentage,
            'commission_amount' => $commission_amount,
            'item_price' => $item_price,
            'item_selling_price' => $item_selling_price + $request->addon_price,
            'item_shipping_charge' => 0,
            'total_tax' => 18,
            'tax_price' => $tax_price,

        ];




        \Cart::add([
            'id' => $request->item_id,
            'name' => $items->product_name,
            'store_id' => $items->store_id,
            'price' => $item_selling_price + $request->addon_price,
            'quantity' => (int) $request->quantity,
            'attributes' => $attributes,
            'associatedModel' => $items1,
        ]);






        if (!Auth::guest() && Auth::user()->role == 3) {

            $userId = Auth::user()->id;


            $datadata = DB::table('customers')
                ->where('user_id', $userId)
                ->select('customer_userid', 'user_id')
                ->first();



            if (!empty($datadata)) {



                DB::table('store_carts')->insert(
                    [
                        'product_id' => $items->id,
                        'item_id' => $request->item_id,
                        'store_id' => $items->store_id,
                        'product_name' => $items->product_name,
                        'quantity' => $request->quantity,
                        'sell_price' => $request->price,
                        'cwitemid' => $request->id,
                        'user_unique_id' => $datadata->customer_userid,
                        'user_id' => $datadata->user_id,
                        'add_by' => 'Web',
                    ]

                );
            }
        }









        $counter = Cart::getContent()->count();




        return response()->json(['counter' => $counter]);
    }



    public function addcartitembyajax(Request $request)
    {




        $items = DB::table('products')
            ->join('product_items', 'products.id', 'product_items.product_id')
            ->join('product_categories', 'products.product_category', 'product_categories.id')
            ->leftjoin('product_subcategories', 'products.product_subcategory', 'product_subcategories.id')
            ->select('products.id', 'products.product_name', 'product_items.item_price', 'product_items.item_offer_discount', 'product_items.item_description', 'products.store_id', 'product_items.id as item_id', 'product_items.item_attr_varient', 'products.product_category as category', 'product_categories.product_category', 'product_subcategories.product_subcategory', 'product_items.array_combine', 'product_items.item_img1', 'products.store_id', 'product_items.item_shipping_weight', 'product_items.item_shipping_weight_unit')
            ->where('product_items.id', $request->item_id)
            ->first();


        $attributes = unserialize($items->array_combine);


        $percents = DB::table('commission_settings')->where('commission_store_id', $items->category)->first();

        $percentage1 = 0;


        if (!empty($percents)) {
            $percentage1 = $percents->commission_rate;
        }

        $record1 = DB::table('commission_settings')->first();

        $percentage2 = $record1->commission_rate;

        $percentage = $percentage1 + $percentage2;




        //   if (!empty($items->item_offer_discount)) {
        //               $item_price = $items->item_price - ($items->item_price * ($items->item_offer_discount / 100));
        //        }else{
        //               $item_price=$items->item_price;
        //        }
        // $percent=($percentage / 100) * $item_price;
        // $item_selling_price=$item_price+$percent;



        $percent = ($percentage / 100) * $items->item_price;

        $item_price = $items->item_price + $percent;
        // ...
        $item_selling_price = round($item_price, 2);

        if (!empty($items->item_offer_discount)) {

            $item_selling_price = round($item_price - ($item_price * ($items->item_offer_discount / 100)), 2);
        }


        $addon_group_list = DB::table('product_addons')
            ->whereIn('product_addons.id', explode(',', $request->all_check_id))
            ->pluck('product_addons.addon_name', 'product_addons.addon_price')
            ->toArray();

        $addon_grouplist = DB::table('product_addons')
            ->whereIn('product_addons.id', explode(',', $request->all_check_id))
            ->pluck('product_addons.id', 'product_addons.addon_group_id')
            ->toArray();

        $tax_price = $item_selling_price * (18 / 100);


        if (!empty($items->item_offer_discount)) {
            $price = $items->item_price - ($items->item_price * ($items->item_offer_discount / 100));
        } else {
            $price = $items->item_price;
        }



        $commission_amount = ($percentage / 100) * $price;



        $items1 = (object) [
            'id' => $items->id,
            'product_name' => $items->product_name,
            'basic_item_price' => $items->item_price,
            'item_offer_discount' => $items->item_offer_discount,
            'item_description' => $items->item_description,
            'store_id' => $items->store_id,
            'id' => $items->id,
            'item_attr_varient' => $items->item_attr_varient,
            'product_category' => $items->product_category,
            'product_category' => $items->product_category,
            'product_subcategory' => $items->product_subcategory,
            'array_combine' => $items->array_combine,
            'item_img1' => $items->item_img1,
            'store_id' => $items->store_id,
            'item_shipping_weight' => $items->item_shipping_weight,
            'item_shipping_weight_unit' => $items->item_shipping_weight_unit,
            'addon_list' => $addon_group_list,
            'addon_id' => $addon_grouplist,

            'commission_percent' => $percentage,
            'commission_amount' => $commission_amount,
            'item_price' => $item_price + $request->addon_price,
            'item_selling_price' => $item_selling_price + $request->addon_price,
            'item_shipping_charge' => 0,
            'total_tax' => 18,
            'tax_price' => $tax_price,
        ];




        \Cart::add([
            'id' => $request->item_id,
            'name' => $items->product_name,
            'store_id' => $items->store_id,
            'price' => $item_selling_price + $request->addon_price,
            'quantity' => (int) $request->quantity,
            'attributes' => $attributes,
            'associatedModel' => $items1,
        ]);






        if (!Auth::guest() && Auth::user()->role == 3) {

            $userId = Auth::user()->id;


            $datadata = DB::table('customers')
                ->where('user_id', $userId)
                ->select('customer_userid', 'user_id')
                ->first();



            if (!empty($datadata)) {



                DB::table('store_carts')->insert(
                    [
                        'product_id' => $items->id,
                        'item_id' => $request->item_id,
                        'store_id' => $items->store_id,
                        'product_name' => $items->product_name,
                        'quantity' => $request->quantity,
                        'sell_price' => $request->price,
                        'cwitemid' => $request->id,
                        'user_unique_id' => $datadata->customer_userid,
                        'user_id' => $datadata->user_id,
                        'add_by' => 'Web',
                    ]

                );
            }
        }


        //       \Cart::add([
        //        'id' => $request->item_id,
        //        'name' => $items->product_name,
        //        'store_id'=>$items->store_id,
        //        'price' =>  $item_selling_price,
        //        'quantity' => (int)$request->quantity,
        //        'attributes' => $attributes,
        //        'associatedModel' => $items
        //    ]);


        //       if(!Auth::guest() && Auth::user()->role==3){

        //          $userId = Auth::user()->id;


        //            $datadata = DB::table('customers')
        //            ->where('user_id',$userId)
        //            ->select('customer_userid','user_id')
        //            ->first();



        //            if (!empty($datadata)) {



        //             DB::table('store_carts')->insert(
        //               [
        //                'product_id' => $items->id,
        //                'item_id' => $request->item_id,
        //                'store_id' => $items->store_id,
        //                'product_name' => $items->product_name,
        //                'quantity' => $request->quantity,
        //                'sell_price' => $item_selling_price,
        //                'cwitemid' => $request->id,
        //                'user_unique_id'=>$datadata->customer_userid,
        //                'user_id'=>$datadata->user_id,
        //                'add_by'=>'Web',
        //            ]

        //        );
        //         }





        // }




        $counter = Cart::getContent()->count();




        return response()->json(['counter' => $counter]);
    }





    public function removecarts(Request $request)
    {

        Cart::clear();


        return json_encode('success');
    }



    public function send_client_otp(Request $request)
    {


        // return json_encode(str_replace(' ','',$request->mobile));


        $otp = $request->otp;
        $user_name = $request->user_name;
        $mobile = str_replace(' ', '', $request->mobile);
        $DefaultUsers = DB::table('customers')->where('customer_mobile', $mobile)->value('status');

        //if ($DefaultUsers == 'Active') {
        $otp = mt_rand(1111, 9999);
        Session::put('otp', $otp);
        //} else if ($DefaultUsers == 'Deactive') {
        //return "You_are_deactivated";
        //}

        $account_sid = "AC4d75b77e507668c360c8cad6ed28bb1c";
        $auth_token = "a076dffeeae59d3b3928f5467dee32dd";
        $twilio_number = "+12708189125";

        // $account_sid = getenv("TWILIO_SID");
        // $auth_token = getenv("TWILIO_TOKEN");
        // $twilio_number = getenv("TWILIO_FROM");

        // Twilio
        try {
            $client = new Client($account_sid, $auth_token);
            $response = $client->messages->create("+" . $request->user_country_code . $mobile, [
                'from' => $twilio_number,
                'body' => 'This is your Mandeclan verification code : ' . $otp
            ]);
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }

        $response = '{
            "account_sid": "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
            "api_version": "2010-04-01",
            "body": "Hi there",
            "date_created": "Thu, 30 Jul 2015 20:12:31 +0000",
            "date_sent": "Thu, 30 Jul 2015 20:12:33 +0000",
            "date_updated": "Thu, 30 Jul 2015 20:12:33 +0000",
            "direction": "outbound-api",
            "error_code": null,
            "error_message": null,
            "from": "+14155552345",
            "messaging_service_sid": null,
            "num_media": "0",
            "num_segments": "1",
            "price": null,
            "price_unit": null,
            "sid": "SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
            "status": "sent",
            "subresource_uris": {
              "media": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Media.json"
            },
            "to": "+14155552345",
            "uri": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.json"
          }';
        // $sendSMS = $this->generateOTP($request->contact);
        // $sendSMS->sendSMS($request->contact);
        // comment by fk
        // $authkey = "200724AR8yxdF4IH5a9a6fe2";
        // $otplength = "4";
        // $otpexpiry = "5";
        // $sender = "IAMFRE";
        // $dlt_te_id="1207164933408332267";
        // $template_id="6276603bcfc15f33d50cebcb";
        // $status="sentotp";




        //        if($status=='verifyotp'){
        //                 $sentotpotp = "https://api.msg91.com/api/v5/otp/verify?template_id=".$template_id."&authkey=".$authkey."&mobile=".$mobile."&otp=".$otp."&DLT_TE_ID=".$dlt_te_id."";
        //             }
        //             elseif($status=='sentotp'){
        //                 $sentotpotp = "https://api.msg91.com/api/v5/otp?template_id=".$template_id."&otp_length=".$otplength."&authkey=".$authkey."&sender=".$sender."&mobile=".$mobile."&otp_expiry=".$otpexpiry."&DLT_TE_ID=".$dlt_te_id."";
        //             }elseif($status=='voiceotp'){
        //                 $sentotpotp = "http://api.msg91.com/api/retryotp.php?template_id=".$template_id."&authkey=".$authkey."&mobile=".$mobile."&retrytype=voice"."&DLT_TE_ID=".$dlt_te_id."";
        //             }else{}
        // comment by fk


        // $curl = curl_init();
        // curl_setopt_array(
        //     $curl,
        //     array(
        //         //   CURLOPT_URL => $sentotpotp, // comment by fk
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_ENCODING => "",
        //         CURLOPT_MAXREDIRS => 10,
        //         CURLOPT_TIMEOUT => 30,
        //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //         CURLOPT_CUSTOMREQUEST => "POST",
        //         CURLOPT_POSTFIELDS => "",
        //         CURLOPT_SSL_VERIFYHOST => 0,
        //         CURLOPT_SSL_VERIFYPEER => 0,
        //     )
        // );

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);


        $new_response = json_decode($response, true);

        // return json_encode($new_response);


        if (!$new_response) {
            $data = [
                'status' => 'false',
                'error' => 'true',
                // 'response' => $err
            ];
            return $data;
        } else {
            $msg = json_decode($response, true);
            $data = [
                'status' => 'true',
                'error' => 'false',
                'response' => $new_response,
                'otp' => Session::get('otp', $otp)
                // 'type' => $msg['type']
            ];
            return $data;
        }
    }




    public function check_new_user_name(Request $request)
    {


        $mobile = $request->check_user_name;


        $users = DB::table('users')->where('mobile', $mobile)->where('status', 'Default')->first();

        if (!empty($users)) {

            return ['status' => 'custome', 'mobile' => $mobile];
        } else {


            $mobile_record = User::where('mobile', $mobile)->first();

            if (!empty($mobile_record)) {



                if ($mobile_record->role == 3) {

                    if ($mobile_record->status == 'Archive') {

                        return ['status' => 'archive', 'mobile' => $mobile];
                    } else {

                        return ['status' => 'exist', 'mobile' => $mobile];
                    }
                } else {

                    return ['status' => 'not_permit', 'mobile' => $mobile];
                }
            }
        }


        return ['status' => 'notexist', 'mobile' => $mobile];
    }




    public function send_client_otp_signup(Request $request)
    {

        $mobile = str_replace(' ', '', $request->mobile);
        $otp = (int) $request->otp;
        $email = $request->email;



        $authkey = "200724AR8yxdF4IH5a9a6fe2";
        $otplength = "4";
        $otpexpiry = "5";
        $sender = "IAMFRE";
        $dlt_te_id = "1207164933408332267";
        $template_id = "6276603bcfc15f33d50cebcb";
        $status = "verifyotp";



        if ($status == 'verifyotp') {
            $sentotpotp = "https://api.msg91.com/api/v5/otp/verify?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&otp=" . $otp . "&DLT_TE_ID=" . $dlt_te_id . "";
        } elseif ($status == 'sentotp') {
            $sentotpotp = "https://api.msg91.com/api/v5/otp?template_id=" . $template_id . "&otp_length=" . $otplength . "&authkey=" . $authkey . "&sender=" . $sender . "&mobile=" . $mobile . "&otp_expiry=" . $otpexpiry . "&DLT_TE_ID=" . $dlt_te_id . "";
        } elseif ($status == 'voiceotp') {
            $sentotpotp = "http://api.msg91.com/api/retryotp.php?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&retrytype=voice" . "&DLT_TE_ID=" . $dlt_te_id . "";
        } else {
        }

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $sentotpotp,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        $new_response = json_decode($response, true);

        // return json_encode($new_response);


        if ($new_response['message'] == 'OTP verified success' || $new_response['message'] == 'Mobile no. already verified' || $new_response['message'] == 'Mobile no. not found' || $new_response['message'] == 'OTP expired') {



            $msg = json_decode($response, true);

            if (str_contains($mobile, '+91') == false) {
                $mobile = '+91' . $mobile;
            } else if (str_contains($mobile, '+') == false) {
                $mobile = '+' . $mobile;
            }


            $user_data = array(
                'name' => $request->input('user_name'),
                'email' => $email,
                'mobile' => $mobile,
                'password' => bcrypt($otp),
                'role' => '3',
                'status' => 'Active'

            );

            $users = new user($user_data);
            $users->save();



            $data = array(
                'customer_name' => $request->input('user_name'),
                'customer_email' => $email,
                'customer_mobile' => $mobile,
                'customer_password' => $otp,
                'user_id' => $users->id,
                'status' => 'Active',
                'customer_userid' => 'Cust' . $users->id . date('Y'),


            );


            $customer = new customer($data);
            $customer->save();



            $enquiry = [];
            $enquiry['name'] = $users->name;
            $enquiry['email'] = $users->email;
            $enquiry['user_id'] = \Crypt::encrypt($users->id);




            $mailstatus = $this->VendorSignupVerifyEmail($enquiry);

            // return json_encode($mailstatus);
            $data = [
                'status' => 'true',
                'error' => 'false',
                'response' => $new_response,
                'type' => $msg['type']
            ];


            return "success";
        } else {
            $data = [
                'status' => 'false',
                'error' => 'true',
                'response' => $err
            ];

            return "error";

            // return $data;



        }







        // return redirect::back();


    }



    public function send_client_otp_sigin(Request $request)
    {
        $mobile = str_replace(' ', '', $request->mobile);
        $otp = (int) $request->otp;
        //if ($otp == '' && $mobile == 9545843646) {
        //  $otp = 1234;
        //} else {
        $otp = mt_rand(1111, 9999);
        //}
        // $account_sid = "AC4d75b77e507668c360c8cad6ed28bb1c";
        // $auth_token = "a076dffeeae59d3b3928f5467dee32dd";
        // $twilio_number = "+12708189125";
        // $account_sid = getenv("TWILIO_SID");
        // $auth_token = getenv("TWILIO_TOKEN");
        // $twilio_number = getenv("TWILIO_FROM");
        // Twilio
        // try {
        //     $client = new Client($account_sid, $auth_token);
        //     $response = $client->messages->create("+" . $request->user_country_code . $mobile, [
        //         'from' => $twilio_number,
        //         'body' => 'This is your Mandeclan verification code : ' . $otp
        //     ]);
        // } catch (Exception $e) {
        // dd("Error: " . $e->getMessage());
        // }
        // $response = '{
        //     "account_sid": "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //     "api_version": "2010-04-01",
        //     "body": "Hi there",
        //     "date_created": "Thu, 30 Jul 2015 20:12:31 +0000",
        //     "date_sent": "Thu, 30 Jul 2015 20:12:33 +0000",
        //     "date_updated": "Thu, 30 Jul 2015 20:12:33 +0000",
        //     "direction": "outbound-api",
        //     "error_code": null,
        //     "error_message": null,
        //     "from": "+14155552345",
        //     "messaging_service_sid": null,
        //     "num_media": "0",
        //     "num_segments": "1",
        //     "price": null,
        //     "price_unit": null,
        //     "sid": "SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
        //     "status": "sent",
        //     "subresource_uris": {
        //       "media": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Media.json"
        //     },
        //     "to": "+14155552345",
        //     "uri": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.json"
        //   }';
        // comment by fk
        //   $authkey = "200724AR8yxdF4IH5a9a6fe2";
        //   $otplength = "4";
        //   $otpexpiry = "5";
        //  $sender = "IAMFRE";
        //                     $dlt_te_id="1207164933408332267";
        //             $template_id="6276603bcfc15f33d50cebcb";
        //   $status="verifyotp";
        // comment by fk
        // return json_encode($new_response);
        // $rooms = DB::table('users')->where('mobile', $mobile)->first();
        // $room = DB::table('users')->where('mobile', $mobile)->first();
        // $otp = OTP::where('user_id', $rooms->id)->first();
        // $now = now();
        // if ($otp && $now->isBefore($otp->expire_at)) {
        //     return $otp;
        // }
        // return OTP::create([
        //     // 'user_id' => $rooms->id,
        //     'otp' => rand(1234, 9999),
        //     'expire_at' => $now->addMinutes(5)
        // ]);
        $DefaultUsers = DB::table('users')->where('mobile', $mobile)->where('status', 'Default')->where('password', $otp)->first();
        if (!empty($DefaultUsers)) {
            $user = User::find($DefaultUsers->id);
            Auth::login($user);
        } else {
            // $otp = OTP::where('user_id', $rooms->id)->first();
            // $now = now();
            // if ($otp && $now->isBefore($otp->expire_at)) {
            //     return $otp;
            // }
            // return OTP::create([
            //     // 'user_id' => $rooms->id,
            //     'otp' => rand(1234, 9999),
            //     'expire_at' => $now->addMinutes(5)
            // ]);
            // comment by fk
            // if ($status == 'verifyotp') {
            //     $sentotpotp = "https://api.msg91.com/api/v5/otp/verify?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&otp=" . $otp . "&DLT_TE_ID=" . $dlt_te_id . "";
            // } elseif ($status == 'sentotp') {
            //     $sentotpotp = "https://api.msg91.com/api/v5/otp?template_id=" . $template_id . "&otp_length=" . $otplength . "&authkey=" . $authkey . "&sender=" . $sender . "&mobile=" . $mobile . "&otp_expiry=" . $otpexpiry . "&DLT_TE_ID=" . $dlt_te_id . "";
            // } elseif ($status == 'voiceotp') {
            //     $sentotpotp = "http://api.msg91.com/api/retryotp.php?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&retrytype=voice" . "&DLT_TE_ID=" . $dlt_te_id . "";
            // } else {
            // } // comment by fk
            // $curl = curl_init();
            // curl_setopt_array(
            //     $curl,
            //     array(
            //         // CURLOPT_URL => $sentotpotp, // comment by fk
            //         CURLOPT_RETURNTRANSFER => true,
            //         CURLOPT_ENCODING => "",
            //         CURLOPT_MAXREDIRS => 10,
            //         CURLOPT_TIMEOUT => 30,
            //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //         CURLOPT_CUSTOMREQUEST => "POST",
            //         CURLOPT_POSTFIELDS => "",
            //         CURLOPT_SSL_VERIFYHOST => 0,
            //         CURLOPT_SSL_VERIFYPEER => 0,
            //     )
            // );
            // $response = curl_exec($curl);
            // $err = curl_error($curl);
            // curl_close($curl);
            // $new_response = json_decode($response, true);
            // return $new_response;
            // || $new_response['message'] == 'Mobile no. already verified' || $new_response['message'] == 'Mobile no. not found' || $new_response['message'] == 'OTP expired'
            if ($otp = Session::get('otp')) {
                $users = DB::table('users')
                    ->where('mobile', $mobile)
                    ->first();
                if (!empty($users)) {
                    $user = User::find($users->id);
                    Auth::login($user);
                    $data = [
                        'last_login_date' => Carbon::now()->toDateTimeString(),
                        'last_login_ip' => $request->getClientIp()
                    ];
                    // dd($user);
                    $last = \DB::table('users')
                        ->where('id', $user->id)
                        ->update($data);
                    return "success";
                } elseif (!empty($mobile_users)) {
                    $user = User::find($mobile_users->id);
                    Auth::login($user);
                    $data = [
                        'last_login_date' => Carbon::now()->toDateTimeString(),
                        'last_login_ip' => $request->getClientIp()
                    ];
                    // dd($user);
                    $last = \DB::table('users')
                        ->where('id', $user->id)
                        ->update($data);
                    return "success";
                } else {
                    return "not_in_same_role";
                }
                return "success";
            } else {
                $data = [
                    'status' => 'false',
                    'error' => 'true',
                    // 'response' => $err
                ];
                return "error";
                // return $data;
            }
        }
        return "success";
    }



    public function check_new_vendor_credntial(Request $request)
    {




        $mobile = $request->check_user_name;

        $users = DB::table('users')->where('mobile', $mobile)->where('status', 'Default')->first();

        if (!empty($users)) {


            return ['status' => 'custome', 'mobile' => $mobile];
        }


        $mobile_record = User::where('mobile', $mobile)->first();

        if (!empty($mobile_record)) {




            if ($mobile_record->role == 2 || $mobile_record->role == 5) {

                if ($mobile_record->status == 'Archive') {

                    return ['status' => 'archive', 'mobile' => $mobile];
                } else {
                    return ['status' => 'exist', 'mobile' => $mobile];
                }
            } else {

                return ['status' => 'not_permit', 'mobile' => $mobile];
            }
        }


        return ['status' => 'notexist', 'mobile' => $mobile];
    }


    public function check_user_name(Request $request)
    {

        // return $request->check_user_name;

        if (!empty($request->check_user_name)) {

            $record = User::where('email', $request->check_user_name)->first();

            if (!empty($record)) {
                return "exist";
            } else {
                return "notexist";
            }
        }
        if (!empty($request->check_user_name_edit)) {

            $record = User::where('email', $request->check_user_name_edit)->where('id', '<>', $request->user_id)->first();

            if (!empty($record)) {
                return "exist";
            } else {
                return "notexist";
            }
        }
    }


    public function customer_login(Request $request)
    {

        if (!\Auth::guest()) {

            $role = \Auth::user()->role;

            // dd($role);
            switch ($role) {
                case '1':
                    return redirect::to('/admin/dashboard');
                    break;

                case '2':
                    return redirect::to('/seller/dashboard');
                    break;

                case '3':
                    return redirect::to('/customer/dashboard');
                    break;

                case '4':
                    return redirect::to('/service-partner/dashboard');
                    break;

                case '5':
                    return redirect::to('/service/dashboard');
                    break;

                default:
                    return view('auth.login');;
                    break;
            }
        }

        return view('frontend.customer-login');
    }

    public function vendor_sign_up(Request $request)
    {

        $categories = DB::table('store_categories')
            ->select('category_name', 'id')
            ->where('status', 'Active')
            ->orderBy('category_name', 'asc')->pluck('category_name', 'id');

        $countries = \DB::table('countries')
            ->where('status', 'Active')
            ->pluck('countries.country_name', 'countries.id');

        $cities = \DB::table('cities')
            ->where('status', 'Active')
            ->pluck('cities.city_name', 'cities.id');

        $localities = \DB::table('localities')
            ->where('status', 'Active')
            ->where('city_id', Session::get('store_city'))
            ->pluck('localities.locality_name', 'localities.id');


        $servic_categories = DB::table('service_categories')
            ->orderby('sort', 'asc')
            ->where('status', 'Active')
            ->pluck('category_name', 'id')->toarray();

        if (!\Auth::guest()) {

            $role = \Auth::user()->role;

            // dd($role);
            switch ($role) {
                case '1':
                    return redirect::to('/admin/dashboard');
                    break;

                case '2':
                    return redirect::to('/seller/dashboard');
                    break;

                case '3':
                    return redirect::to('/customer/dashboard');
                    break;

                case '4':
                    return redirect::to('/service-partner/dashboard');
                    break;


                case '5':
                    return redirect::to('/service/dashboard');
                    break;

                default:
                    return view('auth.login');;
                    break;
            }
        }


        // $service['store_owner_name']='requeststore_owner_name';
        // $service['store_owner_email']='requeststore_owner_email';
        // $service['store_owner_mobile']='mobile';
        // $service['store_owner_gendor']='requeststore_owner_gendor';
        // $service['category_name']='category_name';
        // $service['store_name']='requeststore_name';
        // $service['created_at']='ssssss';
        // $service['store_website']='requeststore_website';
        // $service['store_description']='requestdescription';
        // $service['city_name']='localitycitycity_name';
        // $service['locality_name']='localitylocality_name';
        // $service['store_pincode']='localitypincode';

        //     $admin=admin::first();

        // $mailstatus = $this->VendorSignupVerifyEmail($admin,$service);

        // dd($mailstatus);

        return view('frontend.vendor-signup', compact('categories', 'countries', 'cities', 'servic_categories', 'localities'));
    }


    public function vendor_login(Request $request)
    {
        if (!\Auth::guest()) {
            $role = \Auth::user()->role;
            // dd($role);
            switch ($role) {
                case '1':
                    return redirect::to('/admin/dashboard');
                    break;
                case '2':
                    return redirect::to('/seller/dashboard');
                    break;
                case '3':
                    return redirect::to('/customer/dashboard');
                    break;
                case '4':
                    return redirect::to('/service-partner/dashboard');
                    break;
                case '5':
                    return redirect::to('/service/dashboard');
                    break;
                default:
                    return view('auth.login');;
                    break;
            }
        }
        // $mobile='+918830373357';
        //    if (str_contains($mobile,'+91') == false) {
        //     $mobile= '+91'.$mobile;
        // }else if (str_contains($mobile,'+') == false) {
        //        $mobile= '+'.$mobile;
        // }
        // dd($mobile);
        return view('frontend.vendor-login');
    }



    public function check_store_owner_mobile(Request $request)
    {

        // return $request->check_store_owner_mobile;

        if (!empty($request->check_store_owner_mobile)) {

            $record = User::where('mobile', $request->check_store_owner_mobile)->first();

            if (!empty($record)) {
                return "exist";
            } else {
                return "notexist";
            }
        }
        if (!empty($request->check_store_owner_mobile_edit)) {


            $record = User::where('mobile', $request->check_store_owner_mobile_edit)->where('id', '<>', $request->user_id)->first();

            if (!empty($record)) {
                return "exist";
            } else {
                return "notexist";
            }
        }
    }



    public function vendor_store(Request $request)
    {
        // dd($request);
        $otp = $request->otp;
        $user_name = $request->store_name;
        $mobile = str_replace(' ', '', $request->store_owner_mobile);
        // if ($otp == '' && $mobile == 9545843646) {
        //     $otp = 1234;
        // } else {
        $otp = mt_rand(1111, 9999);
        // }
        // $account_sid = "AC4d75b77e507668c360c8cad6ed28bb1c";
        // $auth_token = "a076dffeeae59d3b3928f5467dee32dd";
        // $twilio_number = "+12708189125";
        // $account_sid = getenv("TWILIO_SID");
        // $auth_token = getenv("TWILIO_TOKEN");
        // $twilio_number = getenv("TWILIO_FROM");
        // Twilio
        // try {
        //     $client = new Client($account_sid, $auth_token);
        //     $response = $client->messages->create("+" . $request->user_country_code . $mobile, [
        //         'from' => $twilio_number,
        //         'body' => 'This is your Mandeclan verification code : ' . $otp
        //     ]);
        // } catch (Exception $e) {
        //     dd("Error: " . $e->getMessage());
        // }
        // Twilio end
        $response = '{
            "account_sid": "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
            "api_version": "2010-04-01",
            "body": "Hi there",
            "date_created": "Thu, 30 Jul 2015 20:12:31 +0000",
            "date_sent": "Thu, 30 Jul 2015 20:12:33 +0000",
            "date_updated": "Thu, 30 Jul 2015 20:12:33 +0000",
            "direction": "outbound-api",
            "error_code": null,
            "error_message": null,
            "from": "+14155552345",
            "messaging_service_sid": null,
            "num_media": "0",
            "num_segments": "1",
            "price": null,
            "price_unit": null,
            "sid": "SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
            "status": "sent",
            "subresource_uris": {
            "media": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Media.json"
            },
            "to": "+14155552345",
            "uri": "/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.json"
        }';
        $msg = json_decode($response, true);
        $data = [
            'status' => 'true',
            'error' => 'false',
            'response' => $msg,
            'type' => $msg['status']
        ];
        // Session::put('user_country_code',$request->user_country_code);
        Session::put('store_owner_mobile', str_replace(' ', '', $request->store_owner_mobile));
        Session::put('store_owner_email', $request->store_owner_email);
        Session::put('store_owner_name', $request->store_owner_name);
        Session::put('store_name', $request->store_name);
        Session::put('store_category', $request->store_category);
        Session::put('store_city', $request->store_city);
        Session::put('store_password', $request->store_password);
        Session::put('store_owner_gendor', $request->store_owner_gendor);
        Session::put('type', $request->type);
        Session::put('service_category', $request->service_category);
        Session::put('store_website', $request->store_website);
        Session::put('store_locality', $request->store_locality);
        Session::put('store_pincode', $request->store_pincode);
        Session::put('otp', $otp);

        $owner_country_code = $request->user_country_code;
        $owner_mobile = $request->user_country_code . str_replace(' ', '', $request->store_owner_mobile);
        $owner_email = $request->store_owner_email;
        $owner_name = $request->store_owner_name;
        $store_name = $request->store_name;
        $category = $request->store_category;
        $store_city = $request->store_city;
        $store_password = $request->store_password;

        $store_owner_gendor = $request->store_owner_gendor;
        $type = $request->type;
        $service_category = $request->service_category;
        $store_website = $request->store_website;
        $store_locality = $request->store_locality;
        $store_pincode = $request->store_pincode;



        //return ['status'=>'success','owner_mobile'=>$owner_mobile,'owner_email'=>$owner_email,'owner_name'=>$owner_name,'store_name'=>$store_name,'category'=>$category,'store_city'=>$store_city];

        return response()->json(['status' => 'success', 'owner_country_code' => $owner_country_code, 'owner_mobile' => $owner_mobile, 'owner_email' => $owner_email, 'owner_name' => $owner_name, 'store_name' => $store_name, 'category' => $category, 'store_city' => $store_city, 'store_owner_gendor' => $store_owner_gendor, 'type' => $type, 'service_category' => $service_category, 'store_website' => $store_website, 'store_locality' => $store_locality, 'store_pincode' => $store_pincode, 'store_password' => $store_password, 'OTP' => Session::get('otp', $otp)]);



        //dd($user_name);
        die;

        // return json_encode($user_name);


        // $authkey = "200724AR8yxdF4IH5a9a6fe2";
        // $otplength = "4";
        // $otpexpiry = "5";
        // $sender = "IAMFRE";
        // $dlt_te_id = "1207164933408332267";
        // $template_id = "6276603bcfc15f33d50cebcb";
        // $status = "sentotp";



        // if ($status == 'verifyotp') {
        //     $sentotpotp = "https://api.msg91.com/api/v5/otp/verify?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&otp=" . $otp . "&DLT_TE_ID=" . $dlt_te_id . "";
        // } elseif ($status == 'sentotp') {
        //     $sentotpotp = "https://api.msg91.com/api/v5/otp?template_id=" . $template_id . "&otp_length=" . $otplength . "&authkey=" . $authkey . "&sender=" . $sender . "&mobile=" . $mobile . "&otp_expiry=" . $otpexpiry . "&DLT_TE_ID=" . $dlt_te_id . "";
        // } elseif ($status == 'voiceotp') {
        //     $sentotpotp = "http://api.msg91.com/api/retryotp.php?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&retrytype=voice" . "&DLT_TE_ID=" . $dlt_te_id . "";
        // } else {
        // }


        // $curl = curl_init();
        // curl_setopt_array(
        //     $curl,
        //     array(
        //         CURLOPT_URL => $sentotpotp,
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_ENCODING => "",
        //         CURLOPT_MAXREDIRS => 10,
        //         CURLOPT_TIMEOUT => 30,
        //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //         CURLOPT_CUSTOMREQUEST => "POST",
        //         CURLOPT_POSTFIELDS => "",
        //         CURLOPT_SSL_VERIFYHOST => 0,
        //         CURLOPT_SSL_VERIFYPEER => 0,
        //     )
        // );

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);



        // $new_response = json_decode($response, true);

        // return json_encode($new_response);

        // if ($err) {
        //     $data = [
        //         'status' => 'false',
        //         'error' => 'true',
        //         'response' => $err
        //     ];
        //     return $data;
        // } else {
        //     $msg = json_decode($response, true);
        //     $data = [
        //         'status' => 'true',
        //         'error' => 'false',
        //         'response' => $new_response,
        //         'type' => $msg['type']
        //     ];

        //     Session::put('store_owner_mobile', str_replace(' ', '', $request->store_owner_mobile));
        //     Session::put('store_owner_email', $request->store_owner_email);
        //     Session::put('store_owner_name', $request->store_owner_name);
        //     Session::put('store_name', $request->store_name);
        //     Session::put('store_category', $request->store_category);
        //     Session::put('store_city', $request->store_city);
        //     Session::put('store_password', $request->store_password);

        //     Session::put('store_owner_gendor', $request->store_owner_gendor);
        //     Session::put('type', $request->type);
        //     Session::put('service_category', $request->service_category);
        //     Session::put('store_website', $request->store_website);
        //     Session::put('store_locality', $request->store_locality);
        //     Session::put('store_pincode', $request->store_pincode);

        //     $owner_mobile = str_replace(' ', '', $request->store_owner_mobile);
        //     $owner_email = $request->store_owner_email;
        //     $owner_name = $request->store_owner_name;
        //     $store_name = $request->store_name;
        //     $category = $request->store_category;
        //     $store_city = $request->store_city;
        //     $store_password = $request->store_password;

        //     $store_owner_gendor = $request->store_owner_gendor;
        //     $type = $request->type;
        //     $service_category = $request->service_category;
        //     $store_website = $request->store_website;
        //     $store_locality = $request->store_locality;
        //     $store_pincode = $request->store_pincode;




        //     return response()->json(['status' => 'success', 'owner_mobile' => $owner_mobile, 'owner_email' => $owner_email, 'owner_name' => $owner_name, 'store_name' => $store_name, 'category' => $category, 'store_city' => $store_city, 'store_owner_gendor' => $store_owner_gendor, 'type' => $type, 'service_category' => $service_category, 'store_website' => $store_website, 'store_locality' => $store_locality, 'store_pincode' => $store_pincode, 'store_password' => $store_password]);
        // return $data;
        // }



        // $currentURL=Session::get('url.role');

        // $notification = array(
        // 'message' => 'Your form was successfully submit!',
        //  'alert-type' => 'success'
        // );

        // return ['status'=>'success','owner_mobile'=>$owner_mobile,'owner_email'=>$owner_email,'owner_name'=>$owner_name,'store_name'=>$store_name,'category'=>$category,'store_city'=>$store_city];


    }

    public function send_vendor_otp_signup(Request $request)
    {
        $mobile = str_replace(' ', '', $request->store_owner_mobile);
        $otp = (int) $request->otp;
        $email = $request->store_owner_email;
        if ($otp == Session::get('otp')) {
            // $msg = json_decode($response, true);
            $store_category = $request->store_category;
            if (empty($request->store_category)) {
                $store_category = $request->service_category;
                $categoryname = DB::table('service_categories')->where('id', $store_category)->first();
                $category_name = $categoryname->category_name;
            } else {
                $categoryname = DB::table('store_categories')->where('id', $store_category)->first();
                $category_name = $categoryname->category_name;
            }

            // if (str_contains($mobile, '+91') == false) {
            //     $mobile = '+91' . $mobile;
            // } else if (str_contains($mobile, '+') == false) {
            //     $mobile = '+' . $mobile;
            // }
            // $response = $client->messages->create("+" . $request->user_country_code . $mobile, [

            // if (str_contains($mobile, $request->user_country_code) == false) {
            //     $mobile = '+'.$request->user_country_code . $mobile;
            // } else if (str_contains($mobile, '+') == false) {
            //     $mobile = '+' . $mobile;
            // }

            $mobile = '+' . $request->user_country_code . str_replace(' ', '', $request->store_owner_mobile);

            // return json_encode($request->type);
            if ($request->type == 'Service') {
                $role = 5;
            } else {
                $role = 2;
            }
            $user_data = array(
                'name' => $request->input('store_owner_name'),
                'mobile' => $mobile,
                'email' => $request->input('store_owner_email'),
                'password' => bcrypt($request->store_password),
                'role' => $role,
                'status' => 'Deactive'
            );
            $users = new user($user_data);
            $users->save();
            if ($request->type == 'Store') {
                $aaa = array(
                    ' ' => '-',
                    '/' => '-',
                    ',' => '-',
                    '---' => '-',
                    '--' => '-',
                    '_' => '-',
                );
                $store_name = str_replace(
                    array_keys($aaa),
                    array_values($aaa),
                    $request->store_name
                );
                $subcat = DB::table('store_categories')->where('id', $store_category)->select('category_url')->first();
                $locality = DB::table('localities')->where('id', $request->store_locality)->select('locality_url')->first();
                $store_link = strtolower($store_name . '-' . $subcat->category_url . '-' . $locality->locality_url);
                // dd($store_link);
                // die();
                $city = DB::table('cities')
                    ->where('id', $request->store_city)
                    ->first();
                $plans = DB::table('store_subscriptions')
                    ->where('store_plan_name', 'Free')
                    ->first();
                $data = array(
                    'store_unique_id' => 'Str' . $users->id . date('Y'),
                    'store_category' => $store_category,
                    'store_owner_name' => $request->input('store_owner_name'),
                    'store_owner_email' => $request->input('store_owner_email'),
                    'store_owner_gendor' => $request->input('store_owner_gendor'),
                    'store_owner_mobile' => $mobile,
                    'store_name' => $request->store_name,
                    'store_website' => $request->store_website,
                    'store_description' => $request->description,
                    'store_locality' => $request->store_locality,
                    'store_pincode' => $request->store_pincode,
                    'status' => "Deactive",
                    'user_id' => $users->id,
                    'store_city' => $request->input('store_city'),
                    'created_by' => 'Frontend',
                    'store_mobile' => $mobile,
                    'store_email' => $request->input('store_owner_email'),
                    'store_email' => $request->input('store_owner_email'),
                    'store_plan_id' => $plans->id,
                    'store_link' => $store_link,
                    'store_password' => $request->store_password,
                    'store_country' => $city->country_id,
                    'store_state' => $city->state_id,
                    'store_description' => $request->description,
                );
                $comman_table = new store($data);
                $comman_table->save();
            } else if ($request->type == 'Service') {
                $aaa = array(
                    ' ' => '-',
                    '/' => '-',
                    ',' => '-',
                    '---' => '-',
                    '--' => '-',
                    '_' => '-',
                );
                $store_name = str_replace(
                    array_keys($aaa),
                    array_values($aaa),
                    $request->store_name
                );
                $subcat = DB::table('service_categories')->where('id', $store_category)->select('category_url')->first();
                $locality = DB::table('localities')->where('id', $request->store_locality)->select('locality_url')->first();
                // $store_link = strtolower($store_name . '-' . $subcat->category_url . '-' . $locality->locality_url);
                $city = DB::table('cities')
                    ->where('id', $request->store_city)
                    ->first();
                $plans = DB::table('service_subscriptions')
                    ->where('service_plan_name', 'Free')
                    ->first();
                $data = array(
                    'service_unique_id' => 'Serv' . $users->id . date('Y'),
                    'service_category' => $store_category,
                    'service_owner_name' => $request->input('store_owner_name'),
                    'service_owner_email' => $request->input('store_owner_email'),
                    'service_owner_gendor' => $request->input('store_owner_gendor'),
                    'service_owner_mobile' => $mobile,
                    'service_mobile' => $mobile,
                    'service_name' => $request->store_name,
                    'service_website' => $request->store_website,
                    'service_description' => $request->description,
                    'service_locality' => $request->store_locality,
                    'service_pincode' => $request->store_pincode,
                    'status' => "Deactive",
                    'user_id' => $users->id,
                    'service_city' => $request->input('store_city'),
                    'created_by' => 'Frontend',
                    'service_email' => $request->input('store_owner_email'),
                    'service_email' => $request->input('store_owner_email'),
                    'service_plan_id' => $plans->id,
                    // 'service_link' => $store_link,
                    'service_password' => $request->store_password,
                    'service_country' => $city->country_id,
                    'service_state' => $city->state_id,
                    'service_description' => $request->description,
                );
                $comman_table = new service($data);
                $comman_table->save();
            }
            $locality = locality::where('id', $request->store_locality)->first();
            $service = [];
            $service['store_owner_name'] = $request->store_owner_name;
            $service['store_owner_email'] = $request->store_owner_email;
            $service['store_owner_mobile'] = $mobile;
            $service['store_owner_gendor'] = $request->store_owner_gendor;
            $service['category_name'] = $category_name;
            $service['store_name'] = $request->store_name;
            $service['created_at'] = Carbon::now()->toDateString();
            $service['store_website'] = $request->store_website;
            $service['store_description'] = $request->description;
            $service['city_name'] = $locality->city->city_name;
            $service['locality_name'] = $locality->locality_name;
            $service['store_pincode'] = $locality->pincode;
            $admin = admin::first();
            $mailstatus1 = $this->VendorSignupAdminSendEmail($admin, $service);
            $enquiry = [];
            $enquiry['name'] = $users->name;
            $enquiry['email'] = $users->email;
            $enquiry['user_id'] = \Crypt::encrypt($users->id);
            $mailstatus = $this->VendorSignupVerifyEmail($enquiry);
            // dd($mailstatus);
            if (!empty($users)) {
                $user = User::find($users->id);
                Auth::login($user);
                $tokenobj = \Auth::User()->createToken('name');
                $token = $tokenobj->accessToken;
                if ($user->role == 2) {
                    $roles = 'Store';
                } elseif ($user->role == 5) {
                    $roles = 'Service';
                }
                $data = array();
                $data['user_id'] = $user->id;
                $data['id'] = $comman_table->id;
                $data['name'] = $user->name;
                $data['email'] = $user->email;
                $data['role'] = $roles;
                return 'success';
            } else {
                return "not_in_same_role";
            }
        } else {
            $data = [
                'status' => 'false',
                'error' => 'true',
                'response' => 'err'
            ];
            return "error";
        }
        $authkey = "200724AR8yxdF4IH5a9a6fe2";
        $otplength = "4";
        $otpexpiry = "5";
        $sender = "IAMFRE";
        $dlt_te_id = "1207164933408332267";
        $template_id = "6276603bcfc15f33d50cebcb";
        $status = "verifyotp";
        if ($status == 'verifyotp') {
            $sentotpotp = "https://api.msg91.com/api/v5/otp/verify?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&otp=" . $otp . "&DLT_TE_ID=" . $dlt_te_id . "";
        } elseif ($status == 'sentotp') {
            $sentotpotp = "https://api.msg91.com/api/v5/otp?template_id=" . $template_id . "&otp_length=" . $otplength . "&authkey=" . $authkey . "&sender=" . $sender . "&mobile=" . $mobile . "&otp_expiry=" . $otpexpiry . "&DLT_TE_ID=" . $dlt_te_id . "";
        } elseif ($status == 'voiceotp') {
            $sentotpotp = "http://api.msg91.com/api/retryotp.php?template_id=" . $template_id . "&authkey=" . $authkey . "&mobile=" . $mobile . "&retrytype=voice" . "&DLT_TE_ID=" . $dlt_te_id . "";
        } else {
        }
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $sentotpotp,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            )
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $new_response = json_decode($response, true);
        // return json_encode($new_response);
        if ($new_response['message'] == 'OTP verified success' || $new_response['message'] == 'Mobile no. already verified' || $new_response['message'] == 'Mobile no. not found' || $new_response['message'] == 'OTP expired') {
            $msg = json_decode($response, true);
            $store_category = $request->store_category;
            if (empty($request->store_category)) {
                $store_category = $request->service_category;
                $categoryname = DB::table('service_categories')->where('id', $store_category)->first();
                $category_name = $categoryname->category_name;
            } else {
                $categoryname = DB::table('store_categories')->where('id', $store_category)->first();
                $category_name = $categoryname->category_name;
            }
            if (str_contains($mobile, '+91') == false) {
                $mobile = '+91' . $mobile;
            } else if (str_contains($mobile, '+') == false) {
                $mobile = '+' . $mobile;
            }
            // return json_encode($request->type);
            if ($request->type == 'Service') {
                $role = 5;
            } else {
                $role = 2;
            }
            $user_data = array(
                'name' => $request->input('store_owner_name'),
                'mobile' => $mobile,
                'email' => $request->input('store_owner_email'),
                'password' => bcrypt($request->store_password),
                'role' => $role,
                'status' => 'Deactive'
            );
            $users = new user($user_data);
            $users->save();
            if ($request->type == 'Store') {
                $aaa = array(
                    ' ' => '-',
                    '/' => '-',
                    ',' => '-',
                    '---' => '-',
                    '--' => '-',
                    '_' => '-',
                );
                $store_name = str_replace(
                    array_keys($aaa),
                    array_values($aaa),
                    $request->store_name
                );
                $subcat = DB::table('store_categories')->where('id', $store_category)->select('category_url')->first();
                $locality = DB::table('localities')->where('id', $request->store_locality)->select('locality_url')->first();
                $store_link = strtolower($store_name . '-' . $subcat->category_url . '-' . $locality->locality_url);
                $city = DB::table('cities')
                    ->where('id', $request->store_city)
                    ->first();
                $plans = DB::table('store_subscriptions')
                    ->where('store_plan_name', 'Free')
                    ->first();
                $data = array(
                    'store_unique_id' => 'Str' . $users->id . date('Y'),
                    'store_category' => $store_category,
                    'store_owner_name' => $request->input('store_owner_name'),
                    'store_owner_email' => $request->input('store_owner_email'),
                    'store_owner_gendor' => $request->input('store_owner_gendor'),
                    'store_owner_mobile' => $mobile,
                    'store_name' => $request->store_name,
                    'store_website' => $request->store_website,
                    'store_description' => $request->description,
                    'store_locality' => $request->store_locality,
                    'store_pincode' => $request->store_pincode,
                    'status' => "Deactive",
                    'user_id' => $users->id,
                    'store_city' => $request->input('store_city'),
                    'created_by' => 'Frontend',
                    'store_mobile' => $mobile,
                    'store_email' => $request->input('store_owner_email'),
                    'store_email' => $request->input('store_owner_email'),
                    'store_plan_id' => $plans->id,
                    'store_link' => $store_link,
                    'store_password' => $request->store_password,
                    'store_country' => $city->country_id,
                    'store_state' => $city->state_id,
                    'store_description' => $request->description,
                );
                $comman_table = new store($data);
                $comman_table->save();
            } else if ($request->type == 'Service') {
                $aaa = array(
                    ' ' => '-',
                    '/' => '-',
                    ',' => '-',
                    '---' => '-',
                    '--' => '-',
                    '_' => '-',
                );
                $store_name = str_replace(
                    array_keys($aaa),
                    array_values($aaa),
                    $request->store_name
                );
                $subcat = DB::table('service_categories')->where('id', $store_category)->select('category_url')->first();
                $locality = DB::table('localities')->where('id', $request->store_locality)->select('locality_url')->first();
                $store_link = strtolower($store_name . '-' . $subcat->category_url . '-' . $locality->locality_url);
                $city = DB::table('cities')
                    ->where('id', $request->store_city)
                    ->first();
                $plans = DB::table('service_subscriptions')
                    ->where('service_plan_name', 'Free')
                    ->first();
                $data = array(
                    'service_unique_id' => 'Serv' . $users->id . date('Y'),
                    'service_category' => $store_category,
                    'service_owner_name' => $request->input('store_owner_name'),
                    'service_owner_email' => $request->input('store_owner_email'),
                    'service_owner_gendor' => $request->input('store_owner_gendor'),
                    'service_owner_mobile' => $mobile,
                    'service_mobile' => $mobile,
                    'service_name' => $request->store_name,
                    'service_website' => $request->store_website,
                    'service_description' => $request->description,
                    'service_locality' => $request->store_locality,
                    'service_pincode' => $request->store_pincode,
                    'status' => "Deactive",
                    'user_id' => $users->id,
                    'service_city' => $request->input('store_city'),
                    'created_by' => 'Frontend',
                    'service_email' => $request->input('store_owner_email'),
                    'service_email' => $request->input('store_owner_email'),
                    'service_plan_id' => $plans->id,
                    'service_link' => $store_link,
                    'service_password' => $request->store_password,
                    'service_country' => $city->country_id,
                    'service_state' => $city->state_id,
                    'service_description' => $request->description,
                );
                $comman_table = new service($data);
                $comman_table->save();
            }
            $locality = locality::where('id', $request->store_locality)->first();
            $service = [];
            $service['store_owner_name'] = $request->store_owner_name;
            $service['store_owner_email'] = $request->store_owner_email;
            $service['store_owner_mobile'] = $mobile;
            $service['store_owner_gendor'] = $request->store_owner_gendor;
            $service['category_name'] = $category_name;
            $service['store_name'] = $request->store_name;
            $service['created_at'] = Carbon::now()->toDateString();
            $service['store_website'] = $request->store_website;
            $service['store_description'] = $request->description;
            $service['city_name'] = $locality->city->city_name;
            $service['locality_name'] = $locality->locality_name;
            $service['store_pincode'] = $locality->pincode;
            $admin = admin::first();
            $mailstatus1 = $this->VendorSignupAdminSendEmail($admin, $service);
            $enquiry = [];
            $enquiry['name'] = $users->name;
            $enquiry['email'] = $users->email;
            $enquiry['user_id'] = \Crypt::encrypt($users->id);
            $mailstatus = $this->VendorSignupVerifyEmail($enquiry);
            // dd($mailstatus);
            if (!empty($users)) {
                $user = User::find($users->id);
                Auth::login($user);
                $tokenobj = \Auth::User()->createToken('name');
                $token = $tokenobj->accessToken;
                if ($user->role == 2) {
                    $roles = 'Store';
                } elseif ($user->role == 5) {
                    $roles = 'Service';
                }
                $data = array();
                $data['user_id'] = $user->id;
                $data['id'] = $comman_table->id;
                $data['name'] = $user->name;
                $data['email'] = $user->email;
                $data['role'] = $roles;
                return 'success';
            } else {
                return "not_in_same_role";
            }
        } else {
            $data = [
                'status' => 'false',
                'error' => 'true',
                'response' => $err
            ];
            return "error";
        }
    }

    public function updatecartviewproductajax(Request $request)
    {

        // dd();


        if (!Auth::guest() && Auth::user()->role == 3) {

            $check = DB::table('store_carts')
                ->where('user_id', Auth::user()->id)
                ->where('item_id', $request->item_id)
                ->first();


            if (!empty($check)) {

                $record = store_cart::find($check->id);

                $record->update(
                    [
                        'quantity' => $request->mainqty,
                    ]
                );
            }
        }



        Cart::update($request->item_id, ['quantity' => $request->mainqty]);

        $counter = Cart::getContent()->count();




        $carts = Cart::getContent();
        // $carts = $carts->sort();

        $products = [];
        $prodt = [];

        $total_weight = 0;
        $total_weight_gram = 0;
        $total_weight_kg = 0;
        $total_weight_lb = 0;
        $total_weight_oz = 0;



        $total_price = 0;
        $discount_price = 0;
        $total_main_price = 0;

        $total_tax_price = 0;

        foreach ($carts as $index => $data) {

            $store_name = $this->stores_functions($data->associatedModel->store_id);



            // $total_price+=$data->price*$data->quantity;

            // $total_main_price+=round($data->associatedModel->item_price,2)*$data->quantity;

            // $discount_price=round($total_main_price-$total_price,2);

            $products[$store_name][$data->id] = $data;


            $total_weight += $data->associatedModel->item_shipping_weight;


            $total_main_price += round($data->associatedModel->item_price, 2) * $data->quantity;

            $total_price += $data->associatedModel->item_selling_price * $data->quantity;

            $discount_price = round($total_main_price - $total_price, 2);
            $total_tax_price = round($total_price * (18 / 100), 2);





            if ($data->associatedModel->item_shipping_weight_unit == 'g') {
                $total_weight_gram += $data->associatedModel->item_shipping_weight * $data->quantity;
            }

            if ($data->associatedModel->item_shipping_weight_unit == 'kg') {
                $total_weight_kg += $data->associatedModel->item_shipping_weight * $data->quantity;
            }


            if ($data->associatedModel->item_shipping_weight_unit == 'lb') {
                $total_weight_lb += $data->associatedModel->item_shipping_weight * $data->quantity;
            }


            if ($data->associatedModel->item_shipping_weight_unit == 'oz') {
                $total_weight_oz += $data->associatedModel->item_shipping_weight * $data->quantity;
            }
        }


        $kg_g = $total_weight_kg * 1000;

        $lb_g = $total_weight_lb * 453.592;

        $oz_g = $total_weight_oz * 28.3495;


        $all_gram = $total_weight_gram + $kg_g + $lb_g + $oz_g;

        $all_kg = $all_gram / 1000;
        // return json_encode($total_main_price);
        // $loadbutton = view("frontend.view_cart_list",compact('carts','products','all_kg'))->render();
        $subtotal = round($total_main_price - $discount_price + $total_tax_price, 2);




        $loadbutton = View::make("frontend.view_cart_list")->with(['carts' => $carts, 'products' => $products, 'all_kg' => $all_kg, 'discount_price' => $discount_price, 'total_main_price' => $total_main_price, 'total_tax_price' => $total_tax_price, 'subtotal' => $subtotal, 'total_price' => $total_price])->render();

        $loadCheckoutbutton = View::make("frontend.checkout_list")->with(['products' => $carts, 'all_kg' => $all_kg, 'total_tax_price' => $total_tax_price, 'subtotal' => $subtotal, 'total_price' => $total_price])->render();


        return response()->json(['loadbutton' => $loadbutton, 'counter' => $counter, 'loadCheckoutbutton' => $loadCheckoutbutton]);
    }



    public function stores_functions($store_id)
    {

        $result = DB::table('stores')
            ->select('store_name', 'id', 'store_category')
            ->where('id', $store_id)
            ->first();

        $category = DB::table('store_categories')
            ->select('category_name', 'id')
            ->where('id', $result->store_category)
            ->first();


        return $result->store_name . '(' . $category->category_name . ')';
    }

    public function updatecartproductajax(Request $request)
    {

        // dd();


        if (!Auth::guest() && Auth::user()->role == 3) {

            $check = DB::table('store_carts')
                ->where('user_id', Auth::user()->id)
                ->where('item_id', $request->item_id)
                ->first();


            if (!empty($check)) {

                $record = store_cart::find($check->id);

                $record->update(
                    [
                        'quantity' => $request->mainqty,
                    ]
                );
            }
        }



        Cart::update($request->item_id, ['quantity' => $request->mainqty]);

        $counter = Cart::getContent()->count();


        return response()->json(['counter' => $counter]);
    }

    // ................................


    public function RemoveCartProduct(Request $request)
    {


        if (!Auth::guest() && Auth::user()->role == 3) {


            $check = DB::table('store_carts')
                ->where('user_id', Auth::user()->id)
                ->where('item_id', $request->item_id)
                ->first();



            $counter = DB::table("store_carts")
                ->where('store_carts.user_id', \Auth::user()->id)
                ->select('store_carts.user_id')
                ->groupby('item_id')
                ->count();



            if (!empty($check)) {

                $check = DB::table('store_carts')
                    ->where('user_id', Auth::user()->id)
                    ->where('item_id', $request->item_id)
                    ->delete();
            }

            Cart::remove($request->item_id);
        } else {




            $details = Cart::get($request->item_id);


            $check = DB::table('abandoned_store_carts')
                ->where('ip_address', \Request::ip())
                ->where('item_id', $request->item_id)
                ->first();


            if (!empty($check)) {

                $record = abandoned_store_cart::where('id', $check->id)->delete();
            }

            Cart::remove($request->item_id);
            $counter = Cart::getContent()->count();
        }



        return response()->json(['counter' => $counter]);
    }



    public function thanku(Request $request)
    {

        return view('frontend.thanku');
    }




    public function thank_u(Request $request)
    {

        return view('frontend.thank-u');
    }


    public function check_careere_email(Request $request)
    {

        $email = $request->check_user_email;
        // return $email;
        $careers = DB::table('careers')->where('email', $email)
            ->where('created_at', '>', now()->subDays(180)->endOfDay())
            ->first();

        if (!empty($careers)) {
            return "exist";
        } else {
            return "notexist";
        }
    }



    public function check_careere_mobile(Request $request)
    {

        $mobile = $request->check_user_mobile;

        // rturn $mobile;
        $careers = DB::table('careers')->where('mobile_no', $mobile)
            ->where('created_at', '>', now()->subDays(180)->endOfDay())
            ->first();

        if (!empty($careers)) {
            return "exist";
        } else {
            return "notexist";
        }
    }
}
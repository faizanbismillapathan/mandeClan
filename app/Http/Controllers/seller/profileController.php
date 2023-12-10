<?php

namespace App\Http\Controllers\seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\store;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Toast;
use Image;
use File;
use App\user;
use App\Traits\MailerTraits;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use MailerTraits;
    public function __construct()
    {
        $this->middleware('auth');
        // dd('4');
        $this->middleware(function ($request, $next) {
            $uspermit = \Auth::user();
            // dd(!in_array($uspermit->role, array(1,2)));
            if (!in_array($uspermit->role, array('1', '2'), false)) {
                // dd('1');
                return redirect()->action('frontend\frontendController@index');
            } else {
                if ($uspermit->role == '1' && empty(session::get('store_id'))) {
                    // dd('2');
                    return redirect()->action('frontend\frontendController@index');
                }
            }
            if (\Auth::user()->role == "2") {
                $store_id = DB::table('stores')
                    ->where('user_id', \Auth::user()->id)
                    ->select('id', 'user_id', 'status', 'kyc_status')
                    ->first();
                if ($store_id->kyc_status == 'deactive') {
                    return redirect()->action('frontend\frontendcontroller@index');
                }
                $this->id = $store_id->id;
                $this->user_id = $store_id->user_id;
            } elseif (\Auth::user()->role == "1") {
                $this->id = session::get('store_id');
                $this->user_id = session::get('store_user_id');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        // dd( $this->id);
        $record = store::find($this->id);
        $countries = DB::table('countries')
            ->select('country_name', 'id')
            ->where('status', 'Active')
            ->orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $categories = DB::table('store_categories')
            ->select('category_name', 'id')
            ->where('status', 'Active')
            ->orderBy('category_name', 'asc')->pluck('category_name', 'id');
        $use = DB::table('commission_settings')
            ->select('commission_rate', 'commission_type', 'id')
            ->where('status', 'Active')
            ->where('commission_for', 'Store')
            ->orderBy('commission_rate', 'asc')->select('commission_rate', 'id', 'commission_type')->get();
        $commissions = array();
        foreach ($use as $user) {
            if ($user->commission_type == 'Percentage') {
                $type = '%';
            } else {
                $type = '$';
            }
            $commissions[$user->id] = $user->commission_rate . $type;
        }
        $subscriptions = DB::table('store_subscriptions')
            ->select('store_plan_name', 'id')
            ->where('status', 'Active')
            ->orderBy('store_plan_name', 'asc')->pluck('store_plan_name', 'id');
        $states = DB::table('states')
            ->where('states.country_id', '=', $record['store_country'])
            ->where("states.status", 'Active')
            ->pluck('states.state_name', 'states.id');
        // dd($states);
        $cities = DB::table('cities')
            ->where('cities.state_id', '=', $record['store_state'])
            ->where("cities.status", 'Active')
            ->pluck('cities.city_name', 'cities.id');
        $localities = DB::table('localities')
            ->where('localities.city_id', '=', $record['store_city'])
            ->where("localities.status", 'Active')
            ->pluck('localities.locality_name', 'localities.id');
        // dd($localities);
        $user_id = $record->user_id;
        $users = user::find($user_id);
        return view('seller.profile.index', compact('commissions', 'countries', 'categories', 'subscriptions', 'record', 'states', 'cities', 'localities', 'user_id', 'users'));
    }
    public function show($id)
    {
        $record = store::find($id);
        // Session::put('store_id',$id);
        // Session::put('store_name',$record->store_name);
        return view('seller.profile.index', compact('record'));
    }
    public function update(Request $request, $id)
    {
        $stores = store::find($id);
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $extension = $request->file('store_logo')->getClientOriginalExtension();
            $store_logo = date('d_m_Y_h_i_s', time()) . '1.' . $extension;
            $destinationPaths = base_path() . '/public/images/store_logo';
            $thumb_img = Image::make($file->getRealPath())->orientate()->resize(100, 100);
            $thumb_img->save($destinationPaths . '/' . $store_logo, 80);
        } else {
            $store_logo = $stores->store_logo;
        }
        if ($request->hasFile('store_cover_photo')) {
            $file = $request->file('store_cover_photo');
            $extension = $request->file('store_cover_photo')->getClientOriginalExtension();
            $store_cover_photo = date('d_m_Y_h_i_s', time()) . '2.' . $extension;
            $destinationPaths = base_path() . '/public/images/store_cover_photo/';
            $thumb_img = Image::make($file->getRealPath())->orientate()->resize(400, 250);
            $thumb_img->save($destinationPaths . '/' . $store_cover_photo, 80);
        } else {
            $store_cover_photo = $stores->store_cover_photo;
        }
        $users = user::find($stores->user_id);
        $data = array(
            'store_cover_photo' => $store_cover_photo,
            'store_logo' => $store_logo,
            'store_owner_name' => $request->input('store_owner_name'),
            'store_owner_email' => $request->input('store_owner_email'),
            'store_owner_mobile' => str_replace(' ', '', $request->input('store_owner_mobile')),
            // 'store_name'=>$request->input('store_name'),
            // 'store_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_mobile')),
            // 'store_phone'=>$request->input('store_phone'),
            // 'store_email'=>$request->input('store_email'),
            'store_gstin_no' => $request->input('store_gstin_no'),
            'store_website' => $request->input('store_website'),
            'store_facebook_url' => $request->input('store_facebook_url'),
            'store_instagram_url' => $request->input('store_instagram_url'),
            'store_you_tube_url' => $request->input('store_you_tube_url'),
            'store_twitter_url' => $request->input('store_twitter_url'),
            'store_pincode' => $request->input('store_pincode'),
            'store_address' => $request->input('store_address'),
            'store_longitude' => $request->input('store_longitude'),
            'store_latitude' => $request->input('store_latitude'),
            // 'store_paypal_email'=>$request->input('store_paypal_email'),
            // 'store_paytm_mobile'=>'+'.$request->user_country_code.str_replace(' ','',$request->input('store_paytm_mobile')),
            // 'str_bank_account_no'=>$request->input('str_bank_account_no'),
            // 'str_bank_account_name'=>$request->input('str_bank_account_name'),
            // 'str_bank_bank_name'=>$request->input('str_bank_bank_name'),
            // 'str_bank_ifsc_code'=>$request->input('str_bank_ifsc_code'),
            // 'str_bank_branch'=>$request->input('str_bank_branch'),
            // 'str_bank_branch_addr'=>$request->input('str_bank_branch_addr'),
            // 'str_bank_account_type'=>$request->input('str_bank_account_type'),
            // 'store_commission_id'=>$request->input('store_commission_id'),
            // 'store_email'=>$request->input('store_email'),
            // 'store_password'=>$request->input('store_password'),
            // 'store_category'=>$request->input('store_category'),
            'store_country' => $request->input('store_country'),
            'store_state' => $request->input('store_state'),
            'store_city' => $request->input('store_city'),
            // 'store_payout_option'=>$request->input('store_payout_option'),
            // 'store_plan_id'=>$request->input('store_plan_id'),
            // 'store_email_option'=>$request->input('store_email_option'),
            // 'store_sms_option'=>$request->input('store_sms_option'),
            // 'store_stock_management'=>$request->input('store_stock_management'),
            // 'store_invoice_period'=>$request->input('store_invoice_period'),
            // 'str_verified_status'=>$request->input('str_verified_status'),
            'store_description' => $request->input('store_description'),
            'store_owner_gendor' => $request->input('store_owner_gendor'),
            'store_locality' => $request->input('store_locality'),
            'store_open_time' => $request->input('store_open_time'),
            'store_close_time' => $request->input('store_close_time'),
        );
        DB::table('users')
            ->where('id', $stores->user_id)
            ->update(
                [
                    'name' => $request->input('store_name'),
                    // 'email' => $request->input('store_email'),
                    // 'password' => bcrypt($request->input('store_password')),
                    // 'mobile' => str_replace(' ','',$request->input('store_mobile')),
                ]
            );
        $stores->update($data);
        $notification = array(
            'message' => 'Your form was successfully Update!',
            'alert-type' => 'success'
        );
        return Redirect::to('seller/profile')->with($notification);
    }
    public function status_update(Request $request)
    {
        // dd($request);
        $record = store::find($this->id);
        if ($record['status'] == 'Active') {
            $updatevender = \DB::table('stores')->where('id', $this->id)
                ->update([
                    'status' => 'Deactive',
                ]);
            $updatevender = \DB::table('users')->where('id', $record->user_id)
                ->update([
                    'status' => 'Deactive',
                ]);
            // \Auth::logout();
            return Redirect::back();
        } else {
            $updateuser = \DB::table('stores')->where('id', $this->id)
                ->update([
                    'status' => 'Active',
                ]);
            $updatevender = \DB::table('users')->where('id', $record->id)
                ->update([
                    'status' => 'Active',
                ]);
            // \Auth::logout();
            return Redirect::back();
            // return json_encode("Active");
        }
    }
    public function status_email_verify(Request $request)
    {
        $users = DB::table('users')->where('id', $this->user_id)->first();
        $enquiry = [];
        $enquiry['name'] = $users->name;
        $enquiry['email'] = $users->email;
        $enquiry['user_id'] = \Crypt::encrypt($users->id);
        $mailstatus = $this->VerifyEmail($enquiry);
        $notification = array(
            'message' => 'Send email successfully .Please Check email ',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }
}
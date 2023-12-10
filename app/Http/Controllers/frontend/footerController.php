<?php
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

use Auth;
use App\admin;
use App\contact_us;
use App\requested_store;
use App\career;
use App\Traits\MailerTraits;

class footerController extends Controller
{

    use MailerTraits;


    public function getFaqsPage(Request $request)
    {   
        $header_not_display='Yes';

        $records=DB::table('faqs')
        ->where('status','Active')
        ->get();
        $admin=admin::first();

        return view('frontend.faqs',compact('header_not_display','records','admin'));

    }


    public function getAboutUsPage(Request $request)
    {   
        $header_not_display='Yes';

        $admin=admin::first();
        $record=DB::table('pages')->where('page_slug','about-us')->first();

        return view('frontend.comman_page',compact('header_not_display','admin','record'));

        // return view('frontend.about_us',compact('header_not_display','admin','record'));

    }

    public function getsecurityPage(Request $request)
    {   
        $header_not_display='Yes';

        $admin=admin::first();
        $record=DB::table('pages')->where('page_slug','security')->first();

        return view('frontend.comman_page',compact('header_not_display','admin','record'));

        // return view('frontend.security',compact('header_not_display','admin'));

    }

    public function getContactUsPage(Request $request)
    {   
        $header_not_display='Yes';

        $admin=admin::first();

        $record=DB::table('pages')->where('page_slug','about-us')->first();

        return view('frontend.comman_page',compact('header_not_display','admin','record'));

        // return view('frontend.contact_us',compact('header_not_display','admin'));

    }






    public function getPrivacyPolicyPage(Request $request)
    {           

        $header_not_display='Yes';
        $admin=admin::first();

        $record=DB::table('pages')->where('page_slug','privacy-policy')->first();
        return view('frontend.comman_page',compact('header_not_display','admin','record'));

        // return view('frontend.privacy_policy',compact('header_not_display','admin'));

    }
    public function getReturnPolicyPage(Request $request)
    {           

        $header_not_display='Yes';
        $admin=admin::first();
        $record=DB::table('pages')->where('page_slug','return-policy')->first();

        return view('frontend.comman_page',compact('header_not_display','admin','record'));

        // return view('frontend.return_policy',compact('header_not_display','admin'));

    }




    public function getTermsConditionsPage(Request $request)
    {   
        $header_not_display='Yes';

        $admin=admin::first();

    // $record=DB::table('term_conditions')->where('role','Customer')->first();
        $record=DB::table('pages')->where('page_slug','terms-and-conditions')->first();

        return view('frontend.comman_page',compact('header_not_display','admin','record'));

        // return view('frontend.terms_conditions',compact('header_not_display','admin','record'));

    }


    public function getcareersPage(Request $request)
    {   
        $header_not_display='Yes';
        $admin=admin::first();

        return view('frontend.careers',compact('header_not_display','admin'));

    }


    public function business_with_us(Request $request)
    {   
        $header_not_display='Yes';


        $categories=DB::table('store_categories')
        ->orderby('sort','asc')
        ->where('status','Active')
        ->pluck('category_name','id')->toarray();


        $servic_categories=DB::table('service_categories')
        ->orderby('sort','asc')
        ->where('status','Active')
        ->pluck('category_name','id')->toarray();


        $admin=admin::first();


        $cities=DB::table('cities')
        ->where('status','Active')
        ->pluck('city_name','id')->toarray();


// dd($cities);

        return view('frontend.business_with_us',compact('header_not_display','categories','admin','servic_categories','cities'));

    }


    public function contact_us_store(Request $request)
    {

                // dd($request);

       $data = array(
           'name'=>$request->input('name'),
           'mobile_no'=>$request->input('mobile_no'),
           'email'=>$request->input('email'),
           'message'=>$request->input('message'),
           'message'=>$request->input('message'),
           'status'=>'Pending',
       );

       $contact_us = new contact_us($data);
       $contact_us->save();


       $admin=admin::first();

       $mailstatus = $this->ContactUsEnquiryAdmin($admin,$contact_us);

       $notification = array(
        'message' => 'Your form was successfully submit!', 
        'alert-type' => 'success'
    );

       return Redirect::to('thank-u')->with($notification);

   }




   public function business_with_us_store(Request $request)
   {

    $store_category=$request->store_category;

    if (empty($request->store_category)) {

      $store_category=$request->service_category;

  }
  $data = array(
    'store_owner_name'=>$request->store_owner_name,
    'store_owner_email'=>$request->store_owner_email,
    'store_owner_mobile'=>$request->store_owner_mobile,
    'store_owner_gendor'=>$request->store_owner_gendor,
    'store_category'=>$store_category,
    'store_name'=>$request->store_name,
    'store_website'=>$request->store_website,
    'store_description'=>$request->store_description,
    'store_address'=>$request->store_address,

    'store_type'=>$request->store_type,
    'store_city'=>$request->store_city,
    'store_locality'=>$request->store_locality,
    'store_pincode'=>$request->store_pincode,
);



  $requested_store = new requested_store($data);
  $requested_store->save();

// dd($requested_store->category->category_name);
  $admin=admin::first();

  $requested_store=requested_store::find($requested_store->id);



  $mailstatus = $this->BusinessWithUsEnquiryAdmin($admin,$requested_store);


// dd($mailstatus);

  $notification = array(
    'message' => 'Your form was successfully submit!', 
    'alert-type' => 'success'
);

  return Redirect::to('thank-u')->with($notification);

}





public function careers_store(Request $request)
{

                // dd($request);

    $data = array(
        'name'=>$request->input('name'),
        'mobile_no'=>$request->input('mobile_no'),
        'email'=>$request->input('email'),
        'apply_for'=>$request->input('apply_for'),
        'message'=>$request->input('message'),
        'status'=>'Pending'
    );



    $career = new career($data);
    $career->save();



    $notification = array(
        'message' => 'Your form was successfully submit!', 
        'alert-type' => 'success'
    );

    $admin=admin::first();

    $mailstatus = $this->CareersEnquiryAdmin($admin,$career);

    return Redirect::to('thank-u')->with($notification);

}


 public function append_state(Request $request)
    {   
             $countryId= $request->id;
         $disticts =\DB::table('states')
                      ->join('countries', 'states.country_id', '=', 'countries.id')
                      ->select('states.*','countries.country_name')
                       ->where("states.country_id",$countryId)
                       ->where("states.status",'Active')
                      ->pluck('states.state_name','states.id');

        

        return json_encode($disticts);
    }


        public function append_city(Request $request)
    {   
             $stateId= $request->id;
         $disticts =\DB::table('cities')
                      ->join('states', 'cities.state_id', '=', 'states.id')
                       ->where("cities.state_id",$stateId)
                       ->where("cities.status",'Active')
                      ->pluck('cities.city_name','cities.id');
                      
        return json_encode($disticts);
    }



    //  public function append_locality(Request $request)
    // {   
    //          $cityId= $request->id;
    //      $disticts =\DB::table('localities')
    //                   ->join('cities', 'localities.city_id', '=', 'cities.id')
    //                    ->where("localities.city_id",$cityId)
    //                    ->where("localities.status",'Active')
    //                   ->pluck('localities.locality_name','localities.id');
                      
    //     return json_encode($disticts);
    // }



    //  public function append_pincode(Request $request)
    // {   
    //          $Id= $request->id;
    //      $disticts =\DB::table('localities')
    //                  ->where("localities.id",$Id)
    //                   ->select('localities.pincode','localities.id')->first();
                      
    //     return json_encode($disticts->pincode);
    // }


public function append_locality(Request $request)
{   
   $cityId= $request->id;
   $disticts =\DB::table('localities')
   ->join('cities', 'localities.city_id', '=', 'cities.id')
   ->where("localities.city_id",$cityId)
   ->where("localities.status",'Active')
   ->pluck('localities.locality_name','localities.id');

   return json_encode($disticts);
}



public function append_pincode(Request $request)
{   
   $Id= $request->id;
   $disticts =\DB::table('localities')
   ->where("localities.id",$Id)
   ->select('localities.pincode','localities.id')->first();

   return json_encode($disticts->pincode);
}



public function our_team(Request $request)
{   

        $header_not_display='Yes';

        $admin=admin::first();

        return view('frontend.our_team',compact('header_not_display','admin'));


}




public function verification($verify)
{

// dd($request);

try {
    
$record=user::find(\Crypt::decrypt($verify));

user::where('id',$record->id)
->update([
'email_verified_at'=>Carbon::now()->toDateTimeString(),

]);

Auth::login($record);

    } catch (\Exception $e) {
        // return  $e;
    }





 return redirect()->action('frontend\frontendController@index'); 


}


}
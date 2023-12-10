<?php

namespace App\Exports;
use App\user;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Storage;
use DB;
use Image;
use Carbon\Carbon;
use App\user_guest_group;
use App\user_menu_group;
use Maatwebsite\Excel\HeadingRowImport;
use App\user_guest;

class GuestImport implements ToModel, WithHeadingRow

{




  public function model(array $row)
  {


    $headerRow = (new HeadingRowImport)->toArray(request()->file('import_file'));

    $headerRow = $headerRow[0][0];
// dd($headerRow);



    for ($x = 0; $x < count($headerRow); $x++) {
    // $arrayss[$headerRow[$x]]=$headerRow[$x];

// dd($headerRow[$x]);
     if (isset($row[$headerRow[$x]])) {

       if (!empty($row[$headerRow[$x]])) {

        $get_values[$headerRow[$x]]=str_replace('_', ' ', $headerRow[$x]).' => '.$row[$headerRow[$x]];

        $get_value_arr[$headerRow[$x]]=$row[$headerRow[$x]];

      }else{

        $get_values[]='';
        $get_value_arr[]='';

      }


    }else{

      $get_values[]='';
      $get_value_arr[]='';

    }



  }

// dd($get_value_arr);



  if (isset($get_value_arr['country'])) {
    $country=$get_value_arr['country'];
  }else{
    $country='';
  }


  if (isset($get_value_arr['city'])) {
    $city=$get_value_arr['city'];
  }else{
    $city='';
  }


  if (isset($get_value_arr['status'])) {
    $status=$get_value_arr['status'];
  }else{
    $status='';
  }


  if (isset($get_value_arr['first_name'])) {
    $first_name=$get_value_arr['first_name'];
  }else{
    $first_name='';
  }


  if (isset($get_value_arr['last_name'])) {
    $last_name=$get_value_arr['last_name'];
  }else{
    $last_name='';
  }


  if (isset($get_value_arr['email'])) {
    $email=$get_value_arr['email'];
  }else{
    $email='';
  }


  if (isset($get_value_arr['contact_no'])) {
    $contact_no=$get_value_arr['contact_no'];
  }else{
    $contact_no='';
  }

  if (isset($get_value_arr['guest_address'])) {
    $guest_address=$get_value_arr['guest_address'];
  }else{
    $guest_address='';
  }

  if (isset($get_value_arr['gendor'])) {
    $gendor=$get_value_arr['gendor'];
  }else{
    $gendor='';
  }

  if (isset($get_value_arr['guest_age'])) {
    $guest_age=$get_value_arr['guest_age'];
  }else{
    $guest_age='';
  }

  if (isset($get_value_arr['telephone_no'])) {
    $telephone_no=$get_value_arr['telephone_no'];
  }else{
    $telephone_no='';
  }

  if (isset($get_value_arr['postal_code'])) {
    $postal_code=$get_value_arr['postal_code'];
  }else{
    $postal_code='';
  }


  $count=DB::table('user_guest_groups')
  ->Where('group_name','like','%' . 'Other' . '%')
  ->where('user_id',\Auth::user()->id)
  ->first();
  
  
  

  if (!empty($count)) {

    $group_id=$count->id;
  }else{
   $data = array(
    'group_name'=>'Other',
    'user_id'=>\Auth::user()->id,
  );
   $user_guest_group = new user_guest_group($data);
   $user_guest_group->save();

   $group_id=$user_guest_group->id;
 }
 



 $count1=DB::table('user_menu_groups')
 ->Where('menu_type','like','%' . 'Other' . '%')
 ->where('user_id',\Auth::user()->id)
 ->first();
 
 if (!empty($count1)) {

  $menu_id=$count1->id;
}else{
 $data = array(
  'menu_type'=>'Other',
  'user_id'=>\Auth::user()->id,
);
 $user_menu_group = new user_menu_group($data);
 $user_menu_group->save();

 $menu_id=$user_menu_group->id;
}

$country = DB::table('country_masters')  
->select('country','id')
->Where('country','like','%' .$country . '%')
->first();

if (!empty($country)) {
  $countrys=$country->id;
} else{
  $countrys='';
}


$city = DB::table('city_masters')  
->select('city', 'id')
->where("status",'Active')
->Where('city','like','%' .$city . '%')
->first();

if (!empty($city)) {
  $citys=$city->id;
} else{
  $citys='';
}

if (preg_match('/Confirmed/', $status)) {
  $status='Confirmed';
}else if (preg_match('/Cancelled/', $status)) {
  $status='Cancelled';

}else{
  $status='Pending';

}

$arr[] = [

 'user_id' => \Auth::user()->id,
 'first_name' => $first_name,
 'last_name' => $last_name,
 'status' =>$status,
 'guest_group' => $group_id,
 'email' => $email,
 'contact_no' => $contact_no,
 'guest_address' => $guest_address,
 'gendor' => $gendor,
 'guest_age' => $guest_age,
 'menu_type' => $menu_id,
 'telephone_no' => $telephone_no,
 'country' => $countrys,
 'city' => $citys,
 'postal_code' => $postal_code,
];

 user_guest::insert($arr);                // dd($arr);

}



}
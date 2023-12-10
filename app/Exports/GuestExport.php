<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;



class GuestExport implements FromCollection, WithHeadings
{



// protected $id;

//  // function __construct($id) {
//  //        $this->id = $id;
//  // }

 
    public function collection()
    {
        // return User::all();


// dd($this->id);
       return  $data=DB::table('user_guests')
             ->join('user_guest_groups','user_guest_groups.id','user_guests.guest_group')
            ->join('user_menu_groups','user_menu_groups.id','user_guests.menu_type')
             ->leftjoin('city_masters','user_guests.city','city_masters.id')
               ->leftjoin('country_masters','user_guests.country','country_masters.id')
           ->select('user_guests.first_name','user_guests.last_name','user_guests.email','user_guests.contact_no','user_guests.telephone_no','country_masters.country','city_masters.city','user_guests.postal_code','user_guests.status','user_guest_groups.group_name','user_menu_groups.menu_type','user_guests.guest_address','user_guests.gendor','user_guests.guest_age')
           ->where('user_guest_groups.user_id',\Auth::user()->id)
->get();


    }

    public function headings(): array
    {
        return [
        'First Name','Last Name','Email','Contact No','Telephone No','Country','City','Postal Code','Status','Group','Menu','Address','Gendor','Guest Age'];
    }

}
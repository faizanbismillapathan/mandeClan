<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class return_policy extends Model
{
    protected $fillable = [
'policy_name','policy_category','deduction_percent','return_days','policy_description','return_accepted_by','status'
	 ];

}
// php artisan make:migration create_return_policies_table --create=return_policies

<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Twilio\Rest\Client;

class OTP extends Model
{
    use HasFactory;
    protected $table = 'otps';
    protected $fillable = ['user_id', 'otp', 'expire_at'];

    public function sendSMS($recieverNumber)
    {
        $message = $this->otp . " is your mandeclan verification code";

        try {
            $account_sid = "ACa61f4450ae24e0f8eeec346eb74ccdc2";
            $token = "02e92afda3c52cc7c5dfbec372f8fba0";
            $from = "+12068895298";

            $twilio = new client($account_sid, $token);
            $twilio->messages->create(
                $recieverNumber,
                array(
                    "from" => $from,
                    "body" => $message
                )
            );
            info('SMS sent');
        } catch (Exception $e) {
            info('Error ' . $e->getMessage());
        }
    }
}
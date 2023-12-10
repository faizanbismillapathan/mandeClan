<?php
namespace App\Traits;

use Mail\SendMail;
use Mail;
use PDF;

trait MailerTraits
{
    // cesarusa@2022
    // public $from_email = "mandeclandotcom@gmail.com";
    public $from_email = "fp7456209@gmail.com";
    public $from_name = "MandeClan";
    public $ccmail = "derekfk399@gmail.com";
    // public $ccmail = "zareena2086@gmail.com";
    public function OrderCustomerEmail($addressBook, $invoicepdf, $order, $order_items, $users)
    {
        if ($order->pickup_type == 'Self Pickup') {
            $email = $users->email;
            $name = $users->name;
        } else {
            $email = $addressBook->email;
            $name = $addressBook->name;
        }
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $email,
                'name' => $name,
                'ccmail' => $this->ccmail,
                'subject' => "Created New Order on MandeClan at " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.order_email_body', ['order' => $order, 'addressBook' => $addressBook, 'order_items' => $order_items, 'users' => $users], function ($message) use ($sentto, $invoicepdf) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->attachData($invoicepdf->output(), 'Invoice.pdf');
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function OrderVendorEmail($store, $addressBook, $invoicepdf, $order, $order_items, $users)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $store->store_email,
                'name' => $store->store_name,
                'ccmail' => $this->ccmail,
                'subject' => "Created New SubOrder on MandeClan at " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.order_email_body', ['order' => $order, 'addressBook' => $addressBook, 'order_items' => $order_items, 'users' => $users], function ($message) use ($sentto, $invoicepdf) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->attachData($invoicepdf->output(), 'Invoice.pdf');
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function StorePurchasePlans($store_plan_invoice, $plans, $invoicepdf)
    {
        $email = $store_plan_invoice->store_email;
        $name = $store_plan_invoice->store_name;
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $email,
                'name' => $name,
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan New Purchase Plan " . date('Y-m-d H:i:s'),
            ];
            \Mail::send('emails.store_plan_email_body', ['store_plan_invoice' => $store_plan_invoice], function ($message) use ($plans, $invoicepdf, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->attachData($invoicepdf->output(), 'Marchant' . $plans->id . '.pdf');
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function ServicePurchasePlans($service_plan_invoice, $plans, $invoicepdf)
    {
        $email = $service_plan_invoice->service_email;
        $name = $service_plan_invoice->service_name;
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $email,
                'name' => $name,
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan New Purchase Plan " . date('Y-m-d H:i:s'),
            ];
            \Mail::send('emails.service_plan_email_body', ['service_plan_invoice' => $service_plan_invoice], function ($message) use ($plans, $invoicepdf, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->attachData($invoicepdf->output(), 'Marchant' . $plans->id . '.pdf');
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function customerPurchasePlans($customer_plan_invoice, $plans, $invoicepdf)
    {
        $email = $customer_plan_invoice->customer_email;
        $name = $customer_plan_invoice->customer_name;
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $email,
                'name' => $name,
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan New Purchase Plan " . date('Y-m-d H:i:s'),
            ];
            \Mail::send('emails.customer_plan_email_body', ['customer_plan_invoice' => $customer_plan_invoice], function ($message) use ($plans, $invoicepdf, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->attachData($invoicepdf->output(), 'Marchant' . $plans->id . '.pdf');
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function BusinessWithUsEnquiryAdmin($admin, $requested_store)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $admin->admin_email,
                'name' => $admin->admin_name,
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan New Bussiness Enquiry Gnerated at " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.bussiness_enquiry', ['requested_store' => $requested_store], function ($message) use ($requested_store, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function VendorSignupAdminSendEmail($admin, $service)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $admin->admin_email,
                'name' => $admin->admin_name,
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan New Signup Verification Email " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.vendor_signup_verify_email', ['service' => $service], function ($message) use ($service, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function CareersEnquiryAdmin($admin, $career)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $admin->admin_email,
                'name' => $admin->admin_name,
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan New Career Enquiry Gnerated at " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.career_enquiry', ['career' => $career], function ($message) use ($career, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function ContactUsEnquiryAdmin($admin, $contact_us)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $admin->admin_email,
                'name' => $admin->admin_name,
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan New ContactUs Enquiry Gnerated at " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.contactus_enquiry', ['contact_us' => $contact_us], function ($message) use ($contact_us, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function BussinessStatusUpdate($enquiry)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $enquiry['email'],
                'name' => $enquiry['name'],
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan Feedback on your" . $enquiry['type'] . " Enquiry " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.status_update_mail', ['enquiry' => $enquiry], function ($message) use ($enquiry, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function UserStatusUpdate($enquiry)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $enquiry['email'],
                'name' => $enquiry['name'],
                'ccmail' => $this->ccmail,
                'subject' => $enquiry['subject'] . ' at ' . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.kyc_status_update_email', ['enquiry' => $enquiry], function ($message) use ($enquiry, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function VendorSignupVerifyEmail($enquiry)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $enquiry['email'],
                'name' => $enquiry['name'],
                'ccmail' => $this->ccmail,
                'subject' => "Welcome to MandeClan: Verify your Email ",
            ];
            Mail::send('emails.email_verify', ['enquiry' => $enquiry], function ($message) use ($enquiry, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function BussinessApprovedStatusUpdate($enquiry, $store)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $enquiry['email'],
                'name' => $enquiry['name'],
                'ccmail' => $this->ccmail,
                'subject' => "MandeClan Admin Approved your Business Enquiry at " . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.status_approved_email', ['enquiry' => $enquiry, 'store' => $store], function ($message) use ($enquiry, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function TestMailTemplet($template_name)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => 'bhaijaanchoclaty@gmail.com',
                'name' => 'Sarfaraz',
                'ccmail' => 'zareena2086@gmail.com',
                'subject' => "templete sarfaraz" . date('Y-m-d H:i:s'),
            ];
            Mail::send('emails.' . $template_name, ['template_name' => $template_name], function ($message) use ($sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function VerifyEmail($enquiry)
    {
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $enquiry['email'],
                'name' => $enquiry['name'],
                'ccmail' => $this->ccmail,
                'subject' => "Welcome to MandeClan: Verify your Email ",
            ];
            Mail::send('emails.email_verify', ['enquiry' => $enquiry], function ($message) use ($enquiry, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function sendOtpOnEmail($enquiry)
    {
        
        try {
            $sentto = [
                'from_email' => $this->from_email,
                'from_name' => $this->from_name,
                'email' => $enquiry['email'],
                'name' => $enquiry['name'],
                'ccmail' => $this->ccmail,
                'subject' => "Welcome to MandeClan: Verify your Email ",
            ];
            Mail::send('emails.change_email_otp', ['enquiry' => $enquiry], function ($message) use ($enquiry, $sentto) {
                $message->from($sentto['from_email'], $sentto['from_name']);
                $message->to($sentto['email'], $sentto['name']);
                $message->cc($sentto['ccmail']);
                $message->subject($sentto['subject']);
            });
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
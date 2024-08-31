<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Settings\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function store(Request $request, GeneralSetting $generalSetting)
    {
        dd('test');
        $request->validate([
            'name' => 'required|max:225',
            'email' => 'required|email',
            'company' => 'required|max:225',
            'phone' => 'required|max:20',
            'message' => 'required',
            'g-recaptcha-response' => 'required'
        ], [
            'g-recaptcha-response.required' => 'Please complete the recaptcha',
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'company.required' => 'Company is required',
            'phone.required' => 'Phone is required',
            'message.required' => 'Message is required',
            'email.email' => 'Email is invalid',
            'name.max' => 'Name is too long',
            'phone.max' => 'Phone is too long',
        ]);

        $chaptha = $request->input('g-recaptcha-response');
        $secretKey = config('services.recaptcha.secret');

        // recaptcha validation
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $chaptha
        ]);

        $responseKeys = json_decode($response->body(), true);

        if (intval($responseKeys["success"]) !== 1) {
            return response()->json([
                'message' => 'recaptcha_failed',
                'error' => 'Failed to validate recaptcha'
            ], 400);
        }

        DB::beginTransaction();

        try {
            // clean name,email,message,company field
            $name = strip_tags($request->name);
            $email = strip_tags($request->email);
            $company = strip_tags($request->company);
            $message = strip_tags($request->message);



            // Insert Contact to database
            $contact = Contact::create([
                'name' => $name,
                'email' => $email,
                'company' => $company,
                'message' => $message,
                'phone' => $request->phone,
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to save contact',
                'error' => $th->getMessage()
            ], 500);
        }

        try{
            // Get notification recipients
            $recipients = $generalSetting->notificationRecipients;
            $emails = collect($recipients)->map(function ($recipient) {
                return $recipient['email'];
            });

            $mailSend = 'Success';

            // Send email to admin
            Mail::to($emails)->send(new ContactMail($contact));
        } catch (\Throwable $th) {
            $mailSend = $th->getMessage();
        }

        return response()->json([
            'message' => 'Contact saved successfully',
            'mail_send' => $mailSend
        ], 201);
    }
}

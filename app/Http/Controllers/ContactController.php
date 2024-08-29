<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use App\Settings\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function store(Request $request, GeneralSetting $generalSetting)
    {
        $request->validate([
            'name' => 'required|max:225',
            'email' => 'required|email',
            'company' => 'required|max:225',
            'phone' => 'required|max:20',
            'message' => 'required'
        ]);

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

        // Get notification recipients
        $recipients = $generalSetting->notificationRecipients;
        $emails = collect($recipients)->map(function ($recipient) {
            return $recipient['email'];
        });

        // Send email to admin
        Mail::to($emails)->send(new ContactMail($contact));

        return response()->json([
            'message' => 'Contact saved successfully'
        ], 201);
    }
}

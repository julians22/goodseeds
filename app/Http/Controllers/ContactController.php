<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    public function store(Request $request)
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
            // clearn message field
            $message = strip_tags($request->message);

            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company,
                'phone' => $request->phone,
                'message' => $message
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

        return response()->json([
            'message' => 'Contact saved successfully',
            'contact' => $contact
        ], 201);
        // return back()->with('success', 'Thanks for contacting us!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{

    public function enquirySave(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required'
        ]);

        // Save the enquiry
        Contact::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);


        return redirect()->back()->with('success', 'Your enquiry has been submitted successfully.');
    }
}

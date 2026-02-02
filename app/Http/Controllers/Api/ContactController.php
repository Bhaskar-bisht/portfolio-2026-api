<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdminContactNotification;
use App\Mail\CustomerContactConfirmation;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Submit contact form
     */
    public function submit(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:500',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Save contact message to database
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'new',
            ]);

            // Send confirmation email to customer
            Mail::to($request->email)->send(new CustomerContactConfirmation($contactMessage));

            // Send notification email to admin
            Mail::to(env('ADMIN_EMAIL', 'bhaskar.s.bist@gmail.com'))
                ->send(new AdminContactNotification($contactMessage));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you soon.',
                'data' => [
                    'id' => $contactMessage->id,
                    'name' => $contactMessage->name,
                    'email' => $contactMessage->email,
                ],
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Contact form submission error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Get contact information for display
     */
    public function getContactInfo()
    {
        try {
            // You can fetch this from database or config
            $contactInfo = [
                'email' => 'bhaskar.s.bist@gmail.com',
                'phone' => '+91 9876543210', // Update with your actual number
                'location' => 'Delhi, India',
                'github' => 'https://github.com/bhaskarbisht',
                'linkedin' => 'https://linkedin.com/in/bhaskarbisht',
                'twitter' => 'https://twitter.com/bhaskarbisht',
                'timezone' => 'Asia/Kolkata',
                'availability' => 'available',
            ];

            return response()->json([
                'success' => true,
                'data' => $contactInfo,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch contact information',
            ], 500);
        }
    }
}

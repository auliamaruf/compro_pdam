<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $company = CompanySetting::current();

        return view('contact', compact('company'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'type' => 'required|in:general,complaint,suggestion,service_info,technical_support',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek harus diisi.',
            'type.required' => 'Jenis pesan harus dipilih.',
            'message.required' => 'Pesan harus diisi.',
            'message.max' => 'Pesan maksimal 2000 karakter.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan pada form. Silakan periksa kembali.');
        }

        try {
            // Store contact message
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'type' => $request->type,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Send notification email to admin (optional)
            try {
                $this->sendNotificationEmail($contactMessage);
            } catch (\Exception $e) {
                // Log email error but don't fail the whole process
                Log::warning('Failed to send contact notification email: ' . $e->getMessage());
            }

            return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim. Tim kami akan menghubungi Anda segera.');

        } catch (\Exception $e) {
            Log::error('Contact form submission failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Maaf, terjadi kesalahan sistem. Silakan coba lagi atau hubungi kami melalui telepon.');
        }
    }

    private function sendNotificationEmail($contactMessage)
    {
        $company = CompanySetting::current();

        if (!$company->email) {
            return;
        }

        $subject = "[{$company->name}] Pesan Kontak Baru: {$contactMessage->subject}";

        $emailData = [
            'contactMessage' => $contactMessage,
            'company' => $company,
        ];

        // Send email notification (you can create email templates later)
        Mail::send('emails.contact-notification', $emailData, function ($message) use ($subject, $company, $contactMessage) {
            $message->to($company->email)
                    ->subject($subject)
                    ->replyTo($contactMessage->email, $contactMessage->name);
        });
    }
}

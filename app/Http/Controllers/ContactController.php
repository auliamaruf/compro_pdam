<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Requests\SecureContactRequest;
use App\Services\SecurityService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        return view('contact');
    }

    public function store(SecureContactRequest $request, SecurityService $security)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        
        // Check if IP is blocked or flagged
        if ($security->isIpBlocked($ip)) {
            Log::warning('Blocked IP attempted contact form', [
                'ip' => $ip,
                'user_agent' => $userAgent
            ]);
            
            return back()
                ->with('error', 'Terlalu banyak percobaan. Silakan coba lagi nanti.')
                ->withInput();
        }

        // Check email sending limits
        if (!$security->canSendEmail($ip)) {
            return back()
                ->with('error', 'Batas pengiriman email tercapai. Silakan coba lagi dalam 1 jam.')
                ->withInput();
        }

        // Spam detection
        if ($security->isSpamContent($request)) {
            $security->flagAsSpam($ip, 'Contact form spam detected');
            $security->checkViolations($ip);
            
            return back()
                ->with('error', 'Pesan terdeteksi sebagai spam.')
                ->withInput();
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
                'ip_address' => $ip,
                'user_agent' => $userAgent,
            ]);

            // Increment email counter for this IP
            $security->incrementEmailCounter($ip);

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
            $security->checkViolations($ip);

            return back()
                ->withInput()
                ->with('error', 'Maaf, terjadi kesalahan sistem. Silakan coba lagi atau hubungi kami melalui telepon.');
        }
    }

    private function sendNotificationEmail($contactMessage)
    {
        // Use global $company data available through CompanyDataServiceProvider
        // This method needs access to company data, so we'll get it from view data
        $company = app('view')->getShared()['company'] ?? null;

        if (!$company || !$company->email) {
            return;
        }

        $subject = "[{$company->company_name}] Pesan Kontak Baru: {$contactMessage->subject}";

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

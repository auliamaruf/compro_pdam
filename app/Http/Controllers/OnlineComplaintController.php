<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineComplaint;
use App\Http\Requests\SecureComplaintRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OnlineComplaintController extends Controller
{
    public function index()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        return view('complaint.index');
    }

    public function store(SecureComplaintRequest $request)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        
        // Anti-spam checks
        if (Cache::get("spam_flagged:{$ip}")) {
            Log::warning('Spam complaint attempt blocked', [
                'ip' => $ip,
                'user_agent' => $userAgent,
                'form' => 'complaint'
            ]);
            
            return back()
                ->with('error', 'Terlalu banyak percobaan. Silakan coba lagi nanti.')
                ->withInput();
        }

        try {
            // Handle file uploads with enhanced security
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    // Sanitize filename
                    $originalName = $file->getClientOriginalName();
                    $safeFileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . 
                                   '.' . $file->getClientOriginalExtension();
                    
                    // Generate unique path with timestamp
                    $path = 'complaints/' . date('Y/m/d') . '/' . time() . '_' . $safeFileName;
                    
                    // Store file
                    $file->storeAs('public', $path);
                    
                    $attachments[] = [
                        'original_name' => $safeFileName, // Use sanitized name
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                        'uploaded_at' => now(),
                    ];
                }
            }

            // Create complaint record
            $complaint = OnlineComplaint::create([
                'customer_name' => $request->customer_name,
                'customer_id_number' => $request->customer_id_number,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'complaint_type' => $request->complaint_type,
                'subject' => $request->subject,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => 'pending',
                'attachments' => $attachments,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Send notification email (optional)
            try {
                $this->sendNotificationEmail($complaint);
            } catch (\Exception $e) {
                Log::warning('Failed to send complaint notification email: ' . $e->getMessage());
            }

            return redirect()->route('complaint.success.alt', $complaint->ticket_number)
                ->with('success', 'Keluhan Anda telah berhasil dikirim dengan nomor tiket: ' . $complaint->ticket_number);

        } catch (\Exception $e) {
            Log::error('Complaint submission failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Maaf, terjadi kesalahan sistem. Silakan coba lagi atau hubungi kami melalui telepon.');
        }
    }

    public function success($ticketNumber)
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        $complaint = OnlineComplaint::where('ticket_number', $ticketNumber)->firstOrFail();

        return view('complaint.success', compact('complaint'));
    }

    public function track(Request $request)
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        $complaint = null;

        if ($request->has('ticket_number')) {
            $ticketNumber = strtoupper(trim($request->ticket_number));
            $complaint = OnlineComplaint::where('ticket_number', $ticketNumber)->first();

            if (!$complaint) {
                return back()->with('error', 'Nomor tiket tidak ditemukan. Periksa kembali nomor tiket Anda.');
            }
        }

        return view('complaint.track', compact('complaint'));
    }

    private function sendNotificationEmail($complaint)
    {
        // Use global $company data available through CompanyDataServiceProvider
        $company = app('view')->getShared()['company'] ?? null;

        if (!$company || !$company->email) {
            return;
        }

        $subject = "[{$company->company_name}] Keluhan Baru: {$complaint->ticket_number}";

        $emailData = [
            'complaint' => $complaint,
            'company' => $company,
        ];

        // You can implement email sending here
        // Mail::send('emails.complaint-notification', $emailData, function ($message) use ($subject, $company, $complaint) {
        //     $message->to($company->email)
        //             ->subject($subject)
        //             ->replyTo($complaint->email, $complaint->customer_name);
        // });
    }
}

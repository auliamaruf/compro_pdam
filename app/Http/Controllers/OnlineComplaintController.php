<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineComplaint;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class OnlineComplaintController extends Controller
{
    public function index()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        return view('complaint.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_id_number' => 'nullable|string|max:50',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'complaint_type' => 'required|in:billing,water_quality,water_pressure,service_connection,pipe_damage,meter_reading,other',
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:low,medium,high,urgent',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ], [
            'customer_name.required' => 'Nama pelanggan harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'complaint_type.required' => 'Jenis keluhan harus dipilih.',
            'subject.required' => 'Subjek keluhan harus diisi.',
            'description.required' => 'Deskripsi keluhan harus diisi.',
            'priority.required' => 'Prioritas harus dipilih.',
            'attachments.*.mimes' => 'File harus berformat: jpg, jpeg, png, pdf, doc, docx.',
            'attachments.*.max' => 'Ukuran file maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan pada form. Silakan periksa kembali.');
        }

        try {
            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('complaints', 'public');
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
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

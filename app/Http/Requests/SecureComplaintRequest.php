<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecureComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\.\-\']+$/',
            ],
            'customer_id_number' => [
                'nullable',
                'string',
                'max:50',
                'regex:/^[a-zA-Z0-9\-]+$/',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[\+]?[0-9\-\(\)\s]+$/',
            ],
            'address' => [
                'required',
                'string',
                'max:500',
                'not_regex:/<script|javascript:|on\w+=/i',
            ],
            'complaint_type' => [
                'required',
                'in:billing,water_quality,water_pressure,service_connection,pipe_damage,meter_reading,other'
            ],
            'subject' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>\"\'&]/',
            ],
            'description' => [
                'required',
                'string',
                'max:2000',
                'not_regex:/<script|javascript:|on\w+=/i',
                'not_regex:/http[s]?:\/\/|www\.|\.com|\.net|\.org|\.id/i', // Block URLs
            ],
            'priority' => [
                'required',
                'in:low,medium,high,urgent'
            ],
            'attachments.*' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf,doc,docx',
                'max:2048', // 2MB max
                'mimetypes:image/jpeg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ],
            'g-recaptcha-response' => 'required|captcha',
            'honeypot' => 'nullable|max:0', // Honeypot trap
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama pelanggan harus diisi.',
            'customer_name.regex' => 'Nama hanya boleh mengandung huruf, spasi, titik, tanda hubung, dan apostrof.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
            'address.required' => 'Alamat harus diisi.',
            'address.not_regex' => 'Alamat mengandung karakter yang tidak diizinkan.',
            'complaint_type.required' => 'Jenis keluhan harus dipilih.',
            'subject.required' => 'Subjek keluhan harus diisi.',
            'subject.not_regex' => 'Subjek mengandung karakter yang tidak diizinkan.',
            'description.required' => 'Deskripsi keluhan harus diisi.',
            'description.not_regex' => 'Deskripsi mengandung karakter, script, atau URL yang tidak diizinkan.',
            'priority.required' => 'Prioritas harus dipilih.',
            'attachments.*.mimes' => 'File harus berformat: jpg, jpeg, png, pdf, doc, docx.',
            'attachments.*.max' => 'Ukuran file maksimal 2MB.',
            'attachments.*.mimetypes' => 'Tipe file tidak diizinkan.',
            'g-recaptcha-response.required' => 'Verifikasi CAPTCHA wajib diisi.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA tidak valid. Silakan coba lagi.',
            'honeypot.max' => 'Form terdeteksi sebagai spam.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'customer_name' => trim(strip_tags($this->customer_name)),
            'email' => trim(strtolower($this->email)),
            'phone' => preg_replace('/[^\d\+\-\(\)\s]/', '', $this->phone ?? ''),
            'address' => trim(strip_tags($this->address)),
            'subject' => trim(strip_tags($this->subject)),
            'description' => trim(strip_tags($this->description)),
        ]);
    }
}
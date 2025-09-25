<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecureContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\.\-\']+$/', // Only letters, spaces, dots, hyphens, apostrophes
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[\+]?[0-9\-\(\)\s]+$/', // Valid phone format
            ],
            'subject' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>\"\'&]/', // Prevent common XSS chars
            ],
            'message' => [
                'required',
                'string',
                'max:2000',
                'not_regex:/<script|javascript:|on\w+=/i', // Basic XSS prevention
                'not_regex:/http[s]?:\/\/|www\.|\.com|\.net|\.org|\.id/i', // Block URLs in message
            ],
            'type' => [
                'required',
                'in:general,complaint,suggestion,service_info,technical_support'
            ],
            'g-recaptcha-response' => 'required|captcha',
            'honeypot' => 'nullable|max:0', // Honeypot field - should be empty
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Nama hanya boleh mengandung huruf, spasi, titik, tanda hubung, dan apostrof.',
            'email.email' => 'Format email tidak valid.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
            'subject.not_regex' => 'Subjek mengandung karakter yang tidak diizinkan.',
            'message.not_regex' => 'Pesan mengandung karakter, script, atau URL yang tidak diizinkan.',
            'g-recaptcha-response.required' => 'Verifikasi CAPTCHA wajib diisi.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA tidak valid. Silakan coba lagi.',
            'honeypot.max' => 'Form terdeteksi sebagai spam.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->sanitizeInput($this->input('name')),
            'subject' => $this->sanitizeInput($this->input('subject')),
            'message' => $this->sanitizeInput($this->input('message')),
        ]);
    }

    private function sanitizeInput(?string $input): ?string
    {
        if (is_null($input)) {
            return null;
        }

        // Remove potential XSS
        $input = strip_tags($input);
        
        // Convert special characters
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        
        // Trim whitespace
        $input = trim($input);
        
        return $input;
    }
}

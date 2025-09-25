<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\SecurityService;
use Illuminate\Support\Facades\Log;

class SecureCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'commentable_type' => [
                'required',
                'string',
                'in:App\Models\News,App\Models\Page'
            ],
            'commentable_id' => [
                'required',
                'integer',
                'exists:' . $this->getTableName($this->commentable_type) . ',id'
            ],
            'name' => [
                'required',
                'string',
                'max:100',
                'min:2',
                'regex:/^[a-zA-Z\s\.]+$/', // Only letters, spaces, and dots
                'not_regex:/[<>\"\'&]/', // Prevent XSS chars
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
            ],
            'comment' => [
                'required',
                'string',
                'min:10',
                'max:2000',
                'not_regex:/<script|javascript:|on\w+=/i', // Basic XSS prevention
                'not_regex:/http[s]?:\/\/|www\.|\.com|\.net|\.org|\.id/i', // Block URLs in comments
            ],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:comments,id'
            ],
            // reCAPTCHA validation
            'g-recaptcha-response' => 'required|captcha',
            // Honeypot field for spam detection
            'honeypot' => 'nullable|max:0',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'commentable_type.required' => 'Tipe konten wajib diisi.',
            'commentable_type.in' => 'Tipe konten tidak valid.',
            'commentable_id.required' => 'ID konten wajib diisi.',
            'commentable_id.exists' => 'Konten tidak ditemukan.',
            'author_name.required' => 'Nama lengkap wajib diisi.',
            'author_name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'author_name.min' => 'Nama minimal 2 karakter.',
            'author_name.max' => 'Nama maksimal 100 karakter.',
            'author_email.required' => 'Alamat email wajib diisi.',
            'author_email.email' => 'Format email tidak valid.',
            'author_phone.regex' => 'Nomor telepon harus format Indonesia yang valid (08xxxxxxxxxx).',
            'content.required' => 'Komentar wajib diisi.',
            'content.min' => 'Komentar minimal 10 karakter.',
            'content.max' => 'Komentar maksimal 2000 karakter.',
            'content.not_regex' => 'Komentar mengandung konten yang tidak diizinkan.',
            'parent_id.exists' => 'Komentar yang dibalas tidak ditemukan.',
            'g-recaptcha-response.required' => 'Verifikasi CAPTCHA wajib diisi.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA tidak valid. Silakan coba lagi.',
            'honeypot.max' => 'Terdeteksi sebagai spam.',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $securityService = app(SecurityService::class);

            // Check honeypot
            if (!empty($this->honeypot)) {
                Log::warning('Honeypot triggered in comment form', [
                    'ip' => $this->ip(),
                    'user_agent' => $this->userAgent(),
                    'honeypot_value' => $this->honeypot
                ]);
                $validator->errors()->add('honeypot', 'Terdeteksi sebagai spam.');
                return;
            }

            // Advanced spam detection
            $content = $this->content ?? '';
            if ($securityService->isSpamContent($this)) {
                Log::warning('Spam content detected in comment', [
                    'ip' => $this->ip(),
                    'content_snippet' => substr($content, 0, 100),
                ]);
                $validator->errors()->add('content', 'Komentar mengandung konten spam.');
            }

            // Rate limiting check (per IP) - 2 comments per minute
            $rateLimitKey = 'comment_rate_limit:' . $this->ip();
            $attempts = cache()->get($rateLimitKey, 0);
            if ($attempts >= 2) {
                Log::warning('Comment rate limit exceeded', [
                    'ip' => $this->ip(),
                    'attempts' => $attempts,
                ]);
                $validator->errors()->add('general', 'Terlalu banyak komentar dalam waktu singkat. Silakan tunggu sebentar.');
            } else {
                // Increment attempt counter
                cache()->put($rateLimitKey, $attempts + 1, 60); // 1 minute
            }
        });
    }

    /**
     * Get table name from model class
     */
    private function getTableName($modelClass)
    {
        switch ($modelClass) {
            case 'App\Models\News':
                return 'news';
            case 'App\Models\Page':
                return 'pages';
            default:
                return 'comments'; // fallback
        }
    }
}
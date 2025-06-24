<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Store a newly created comment
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'commentable_type' => 'required|string|in:App\Models\News,App\Models\Page',
            'commentable_id' => 'required|integer|exists:' . $this->getTableName($request->commentable_type) . ',id',
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'author_phone' => 'nullable|string|max:20',
            'content' => 'required|string|max:2000',
            'parent_id' => 'nullable|integer|exists:comments,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan dalam pengisian form komentar.');
        }

        // Basic spam detection
        if ($this->isSpam($request->content)) {
            return back()->with('error', 'Komentar Anda terdeteksi sebagai spam.');
        }

        // Create comment
        Comment::create([
            'commentable_type' => $request->commentable_type,
            'commentable_id' => $request->commentable_id,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'author_phone' => $request->author_phone,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'status' => 'pending', // Default pending for moderation
            'meta' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'submitted_at' => now()->toISOString(),
            ]
        ]);

        return back()->with('success', 'Komentar Anda telah dikirim dan menunggu persetujuan moderator.');
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
                return '';
        }
    }

    /**
     * Basic spam detection
     */
    private function isSpam($content)
    {
        $spamKeywords = [
            'viagra', 'casino', 'poker', 'loan', 'debt', 'credit',
            'win money', 'click here', 'free money', 'earn money',
            'http://', 'https://', 'www.', '.com', '.net'
        ];

        $content = strtolower($content);

        foreach ($spamKeywords as $keyword) {
            if (strpos($content, $keyword) !== false) {
                return true;
            }
        }

        // Check for excessive uppercase
        if (strlen($content) > 10 && substr_count($content, strtoupper($content)) > 0.8) {
            return true;
        }

        // Check for excessive repeated characters
        if (preg_match('/(.)\1{4,}/', $content)) {
            return true;
        }

        return false;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SecureCommentRequest;
use App\Models\News;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(SecureCommentRequest $request)
    {
        try {
            // Validasi sudah dilakukan di SecureCommentRequest
            $validated = $request->validated();
            
            // Dapatkan model commentable berdasarkan type dan id
            $commentableType = $validated['commentable_type'];
            $commentableId = $validated['commentable_id'];
            
            $commentable = $commentableType::find($commentableId);
            
            if (!$commentable) {
                return back()->with('error', 'Data tidak ditemukan.')
                            ->withInput();
            }
            
            // Cek apakah komentar diaktifkan untuk model News
            if ($commentableType === 'App\\Models\\News' && !$commentable->comments_enabled) {
                return back()->with('error', 'Komentar tidak diaktifkan untuk artikel ini.')
                            ->withInput();
            }
            
            // Validasi parent_id jika ada (untuk reply)
            $parentId = $validated['parent_id'] ?? null;
            if ($parentId) {
                $parentComment = \App\Models\Comment::where('id', $parentId)
                    ->where('commentable_type', $commentableType)
                    ->where('commentable_id', $commentableId)
                    ->where('status', 'approved')
                    ->first();
                
                if (!$parentComment) {
                    return back()->with('error', 'Komentar yang ingin dibalas tidak ditemukan.')
                                ->withInput();
                }
            }
            
            // Buat komentar baru menggunakan morphMany relationship
            $comment = $commentable->allComments()->create([
                'author_name' => $validated['name'],
                'author_email' => $validated['email'],
                'content' => $validated['comment'],
                'status' => 'pending', // Perlu approval manual
                'parent_id' => $parentId,
                'meta' => [
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]
            ]);
            
            Log::info('New comment submitted', [
                'comment_id' => $comment->id,
                'commentable_type' => $commentableType,
                'commentable_id' => $commentableId,
                'author' => $validated['name'],
                'ip' => $request->ip()
            ]);
            
            return back()->with('success', 'Komentar Anda telah dikirim dan sedang menunggu persetujuan admin.');
            
        } catch (\Exception $e) {
            Log::error('Comment submission failed', [
                'error' => $e->getMessage(),
                'commentable_type' => $request->input('commentable_type'),
                'commentable_id' => $request->input('commentable_id'),
                'ip' => $request->ip()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat mengirim komentar. Silakan coba lagi.')
                        ->withInput();
        }
    }
}

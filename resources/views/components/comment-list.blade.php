{{-- Comments Display Component --}}
<div class="comments-section mt-8">
    <h3 class="text-xl font-semibold text-gray-800 mb-6">
        <i class="fas fa-comments text-blue-600 mr-2"></i>
        Komentar
        @if($comments->count() > 0)
            <span class="text-gray-600 font-normal">({{ $comments->count() }})</span>
        @endif
    </h3>

    @if($comments->count() > 0)
        <div class="space-y-6">
            @foreach($comments as $comment)
                <div class="comment-item bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    {{-- Comment Header --}}
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $comment->author_name }}</h4>
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        {{-- Reply button --}}
                        <button onclick="replyToComment({{ $comment->id }}, '{{ $comment->author_name }}')"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium transition duration-200">
                            <i class="fas fa-reply mr-1"></i>
                            Balas
                        </button>
                    </div>

                    {{-- Comment Content --}}
                    <div class="comment-content mb-4">
                        <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                    </div>

                    {{-- Replies --}}
                    @if($comment->replies->count() > 0)
                        <div class="replies-section ml-6 mt-4 space-y-4">
                            <div class="border-l-2 border-gray-200 pl-4">
                                @foreach($comment->replies as $reply)
                                    <div class="reply-item bg-gray-50 rounded-lg p-4 mb-3">
                                        {{-- Reply Header --}}
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-2">
                                                    <i class="fas fa-user text-green-600 text-sm"></i>
                                                </div>
                                                <div>
                                                    <h5 class="font-medium text-gray-800 text-sm">{{ $reply->author_name }}</h5>
                                                    <p class="text-xs text-gray-500">
                                                        <i class="fas fa-clock mr-1"></i>
                                                        {{ $reply->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- Reply to reply button --}}
                                            <button onclick="replyToComment({{ $comment->id }}, '{{ $reply->author_name }}')"
                                                    class="text-green-600 hover:text-green-800 text-xs font-medium transition duration-200">
                                                <i class="fas fa-reply mr-1"></i>
                                                Balas
                                            </button>
                                        </div>

                                        {{-- Reply Content --}}
                                        <div class="reply-content">
                                            <p class="text-gray-700 text-sm leading-relaxed">{{ $reply->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        {{-- No comments yet --}}
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-comments text-gray-400 text-2xl"></i>
            </div>
            <h4 class="text-gray-600 font-medium mb-2">Belum Ada Komentar</h4>
            <p class="text-gray-500 text-sm">Jadilah yang pertama memberikan komentar pada artikel ini!</p>
        </div>
    @endif
</div>

<style>
/* Comment animations */
.comment-item {
    transition: all 0.3s ease;
}

.comment-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-1px);
}

.reply-item {
    transition: all 0.2s ease;
}

.reply-item:hover {
    background-color: #f9fafb;
}

/* Reply indicator animation */
#reply-indicator {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Button hover effects */
button[onclick*="replyToComment"] {
    transition: all 0.2s ease;
}

button[onclick*="replyToComment"]:hover {
    transform: translateX(2px);
}
</style>

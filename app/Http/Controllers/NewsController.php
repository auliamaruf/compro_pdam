<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\CompanySetting;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $company = CompanySetting::current();
        $type = $request->get('type', 'all');

        $query = News::published()->latest();

        if ($type !== 'all') {
            $query->where('type', $type);
        }

        $news = $query->paginate(12);

        return view('news.index', compact('company', 'news', 'type'));
    }

    public function show($slug)
    {
        $company = CompanySetting::current();
        $article = News::where('slug', $slug)->published()->firstOrFail();

        // Increment views
        $article->incrementViews();

        // Get comments for this article (only approved comments)
        $comments = $article->comments()->with('replies')->get();

        // Get related news
        $relatedNews = News::published()
            ->where('id', '!=', $article->id)
            ->where('type', $article->type)
            ->latest()
            ->take(4)
            ->get();

        return view('news.show', compact('company', 'article', 'relatedNews', 'comments'));
    }
}

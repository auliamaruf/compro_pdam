<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Service;
use App\Models\CompanySetting;
use App\Models\Page;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $company = CompanySetting::current();
        $query = $request->get('q', '');
        $type = $request->get('type', 'all'); // all, news, services, pages
        $perPage = 10; // Results per page

        $results = collect();
        $totalResults = 0;

        if (!empty($query)) {
            // Search News
            if ($type === 'all' || $type === 'news') {
                $newsResults = News::published()
                    ->where(function($q) use ($query) {
                        $q->where('title', 'LIKE', "%{$query}%")
                          ->orWhere('excerpt', 'LIKE', "%{$query}%")
                          ->orWhere('content', 'LIKE', "%{$query}%");
                    })
                    ->latest('published_at')
                    ->get()
                    ->map(function($item) use ($query) {
                        $item->result_type = 'news';
                        $item->url = route('news.show', $item->slug);
                        $item->category_name = ucfirst($item->type);

                        // Calculate relevance score
                        $titleScore = stripos($item->title, $query) !== false ? 10 : 0;
                        $excerptScore = stripos($item->excerpt, $query) !== false ? 5 : 0;
                        $contentScore = stripos($item->content, $query) !== false ? 1 : 0;
                        $item->relevance_score = $titleScore + $excerptScore + $contentScore;

                        // Highlight search term in title and excerpt
                        $item->highlighted_title = $this->highlightSearchTerm($item->title, $query);
                        $item->highlighted_excerpt = $this->highlightSearchTerm($item->excerpt ?? '', $query);

                        return $item;
                    });

                $results = $results->merge($newsResults);
            }

            // Search Services
            if ($type === 'all' || $type === 'services') {
                $serviceResults = Service::active()
                    ->where(function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%")
                          ->orWhere('procedure', 'LIKE', "%{$query}%");
                    })
                    ->orderBy('sort_order')
                    ->get()
                    ->map(function($item) use ($query) {
                        $item->result_type = 'service';
                        $item->url = route('services.show', $item->slug);
                        $item->title = $item->name; // Normalize field name
                        $item->excerpt = $item->description;
                        $item->category_name = ucfirst(str_replace('_', ' ', $item->category));

                        // Calculate relevance score
                        $nameScore = stripos($item->name, $query) !== false ? 10 : 0;
                        $descScore = stripos($item->description, $query) !== false ? 5 : 0;
                        $procScore = stripos($item->procedure ?? '', $query) !== false ? 2 : 0;
                        $item->relevance_score = $nameScore + $descScore + $procScore;

                        // Highlight search term
                        $item->highlighted_title = $this->highlightSearchTerm($item->name, $query);
                        $item->highlighted_excerpt = $this->highlightSearchTerm($item->description, $query);

                        return $item;
                    });

                $results = $results->merge($serviceResults);
            }

            // Search Pages
            if ($type === 'all' || $type === 'pages') {
                $pageResults = Page::published()
                    ->where(function($q) use ($query) {
                        $q->where('title', 'LIKE', "%{$query}%")
                          ->orWhere('content', 'LIKE', "%{$query}%")
                          ->orWhere('excerpt', 'LIKE', "%{$query}%");
                    })
                    ->orderBy('title')
                    ->get()
                    ->map(function($item) use ($query) {
                        $item->result_type = 'page';
                        $item->url = route('home'); // You can create page routes later
                        $item->category_name = 'Halaman';

                        // Calculate relevance score
                        $titleScore = stripos($item->title, $query) !== false ? 10 : 0;
                        $excerptScore = stripos($item->excerpt ?? '', $query) !== false ? 5 : 0;
                        $contentScore = stripos($item->content, $query) !== false ? 1 : 0;
                        $item->relevance_score = $titleScore + $excerptScore + $contentScore;

                        // Highlight search term
                        $item->highlighted_title = $this->highlightSearchTerm($item->title, $query);
                        $item->highlighted_excerpt = $this->highlightSearchTerm($item->excerpt ?? '', $query);

                        return $item;
                    });

                $results = $results->merge($pageResults);
            }

            // Sort by relevance score, then by date
            $results = $results->sortByDesc(function($item) {
                return $item->relevance_score * 1000 + ($item->created_at ? $item->created_at->timestamp : 0);
            });

            $totalResults = $results->count();

            // Manual pagination
            $currentPage = $request->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $results = $results->slice($offset, $perPage);
        }

        return view('search.index', compact(
            'company',
            'query',
            'type',
            'results',
            'totalResults',
            'perPage'
        ));
    }

    private function highlightSearchTerm($text, $query)
    {
        if (empty($query) || empty($text)) {
            return $text;
        }

        return preg_replace(
            '/(' . preg_quote($query, '/') . ')/i',
            '<mark class="bg-yellow-200 px-1 rounded">$1</mark>',
            $text
        );
    }

    public function suggest(Request $request)
    {
        $query = $request->get('q', '');
        $suggestions = collect();

        if (strlen($query) >= 2) {
            // Get news suggestions
            $newsTerms = News::published()
                ->where('title', 'LIKE', "%{$query}%")
                ->take(3)
                ->pluck('title')
                ->map(function($title) {
                    return [
                        'text' => $title,
                        'type' => 'news',
                        'icon' => 'news'
                    ];
                });

            // Get service suggestions
            $serviceTerms = Service::active()
                ->where('name', 'LIKE', "%{$query}%")
                ->take(3)
                ->pluck('name')
                ->map(function($name) {
                    return [
                        'text' => $name,
                        'type' => 'service',
                        'icon' => 'service'
                    ];
                });

            $suggestions = $newsTerms->merge($serviceTerms)->take(6);
        }

        return response()->json($suggestions);
    }
}

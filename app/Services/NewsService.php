<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class NewsService
{
    public static $news;
    public static function index()
    {
        static::$news = Http::withoutVerifying()->withHeaders([])->get("https://badkokasihan.web.id/wp-json/wp/v2/posts", [
            "per_page" => 15,
            "_embed" => ''
        ])->json();
        // dd(self::paginate(static::$news, 6, null, ['path' => route('user.homepage')]));
        return self::paginate(static::$news, 6, null, ['path' => route('user.homepage')]);
    }

    public static function NewsDetail($id)
    {
        $post = Http::withoutVerifying()->withHeaders([])->get("https://badkokasihan.web.id/wp-json/wp/v2/posts", [
            "include[]" => $id,
            "_embed" => ''
        ])->json();

        // dd($post);
        $date = Carbon::parse($post[0]['date']);

        $postdetail = [
            "id"    => $id,
            "title" => $post[0]['title']['rendered'],
            "featured_image" => $post[0]['_embedded']['wp:featuredmedia'][0]['source_url'] ?? asset('images/noimage.jpg'),
            "content" => $post[0]['content']['rendered'],
            "date" => $date->isoFormat('D MMMM Y'),
            "link" => $post[0]['link'],
        ];

        return $postdetail;
    }

    private static function paginate($items, $perPage = 6, $currentPage = null, $options = [])
    {
        // 'path' => route('information.index')
        $currentPage = $currentPage ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            $options,
        );
    }
}

<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($id)
    {
        $news = NewsService::NewsDetail($id);

        return view('user.pages.news')
            ->with(compact('news'));
    }
}

<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::when($request->has('category'), function ($query) use ($request) {
            $query->whereRaw("FIND_IN_SET(?, category_id)", $request->category);
        })->get();
        // dd($trainings);
        $categories = Category::all();

        // dd(Auth::user()->verification_status);

        return view('user.pages.home')
            ->with(compact('trainings', 'categories'));
    }

    public function organizationList()
    {
        $organizations = User::where('verification_status', '=', 1)->get();
        return view('user.pages.org-list')
            ->with(compact('organizations'));
    }
}

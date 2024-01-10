<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Category;
use App\Models\Training;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Village;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::when($request->has('category'), function ($query) use ($request) {
            $query->whereRaw("FIND_IN_SET(?, category_id)", $request->category);
        })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // $categories = Category::all();
        $categories = Category::where('id', '!=', 3)->get();

        $numberOfUsersPerVillages = [];

        $villages = Village::all();

        $completeProfileNotification = false;

        if (Auth::check()) {

            $user = User::find(Auth::user()->id);

            $columnsToCheck = [
                'institution_name',
                'nspq_number',
                'supervisory_institution_name',
                'years_of_establishment',

                #Lokasi Lembaga
                'address',
                'village',
                'postal_code',
                'phone_number',
                'facebook',
                'instagram',
                'twitter',
                'website',
                'youtube',
                'tiktok',
                'gmap_address',

                #Perijinan
                'sk_number',
                'sk_number_starting_date',
                'sk_number_ending_date',
                'sk_file',
            ];

            foreach ($columnsToCheck as $column) {
                if (empty($user->userProfile->{$column})) {
                    $completeProfileNotification = true;
                    break;
                }
            }
        }

        foreach ($villages as $village) {
            $numberOfUsersPerVillages[] = [
                'village' => $village->village_name,
                'users' => $village->userProfile->where('user.verification_status', '=', 1)->count(),
            ];
        }

        $news = NewsService::index();

        $event_paid = Transaction::where('status', 'Lunas')->count();
        $event_with_pending_payment = Transaction::where('status', null)->count();
        $users_cart = User::has('carts')->count();

        $user_with_cart = User::has('carts')->get();
        $user_with_paid_event = Transaction::select('user_id')->with('user')->where('status', '=', 'Lunas')->distinct()->get();
        $user_with_pending_payment = Transaction::select('user_id')->with('user')->where('status', '=', null)->distinct()->get();

        // dd($user_with_pending_payment);
        return view('user.pages.home')
            ->with(compact(
                'news',
                'trainings',
                'categories',
                'numberOfUsersPerVillages',
                'completeProfileNotification',
                'event_paid',
                'event_with_pending_payment',
                'users_cart',
                'user_with_cart',
                'user_with_paid_event',
                'user_with_pending_payment'
            ));
    }

    public function organizationList()
    {
        $organizations = User::where('verification_status', '=', 1)->get();
        return view('user.pages.org-list')
            ->with(compact('organizations'));
    }

    public function organizationDetail($id)
    {
        $org = User::where(['id' => $id, 'verification_status' => 1])->firstOrFail();

        // dd($org->director($org->id)->first());

        $director = Administrator::rightJoin('staffs', 'staffs.id', '=', 'administrators.director')
            ->where('administrators.user_id', '=', $org->id)
            ->first();
        $viceDirector = Administrator::rightJoin('staffs', 'staffs.id', '=', 'administrators.vice_director')
            ->where('administrators.user_id', '=', $org->id)
            ->first();
        $secretary = Administrator::rightJoin('staffs', 'staffs.id', '=', 'administrators.secretary')
            ->where('administrators.user_id', '=', $org->id)
            ->first();
        $treasurer = Administrator::rightJoin('staffs', 'staffs.id', '=', 'administrators.treasurer')
            ->where('administrators.user_id', '=', $org->id)
            ->first();

        $administrator = [
            'director' => $director,
            'vice_director' => $viceDirector,
            'secretary' => $secretary,
            'treasurer' => $treasurer
        ];

        // dd($administrator);
        return view('user.pages.org-detail')
            ->with(compact('org', 'administrator'));
    }

    public function charter()
    {
        $user = User::find(Auth::user()->id);
        $qrCode = QrCode::size(120)->generate(route('user.verification', $user->id));
        return view('user.pages.charter')
            ->with(compact('user', 'qrCode'));
    }

    public function verification($userId)
    {
        $user = User::find($userId);
        return view('user.pages.verification')
            ->with(compact('user'));
    }
}

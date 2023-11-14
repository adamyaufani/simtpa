<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Training;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::when($request->has('category'), function ($query) use ($request) {
            $query->whereRaw("FIND_IN_SET(?, category_id)", $request->category);
        })->get();

        $categories = Category::all();

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

        return view('user.pages.home')
            ->with(compact('trainings', 'categories', 'numberOfUsersPerVillages', 'completeProfileNotification'));
    }

    public function organizationList()
    {
        $organizations = User::where('verification_status', '=', 1)->get();
        return view('user.pages.org-list')
            ->with(compact('organizations'));
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

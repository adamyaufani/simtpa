<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Services\TrainingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function show($id): View
    {
        $training = TrainingService::getTrainingById($id)->fetch();
        $leftoverQuota = TrainingService::getTrainingById($id)->quotaPerOrgLeft(Auth::id());
        return view('user.pages.training.detail')
            ->with(compact('training', 'leftoverQuota'));
    }

    public function checkout($id, Request $request)
    {
        $request = $request->validate(
            ['q' => 'numeric']
        );

        $participant = $request['q'];
        $training = TrainingService::getTrainingById($id)->fetch();
        $price = TrainingService::getTrainingById($id)->trainingPrice();
        $leftoverQuota = TrainingService::getTrainingById($id)->quotaPerOrgLeft(Auth::id());
        // dd($leftoverQuota);
        $totalPrice = $price * $request['q'];
        // dd();
        // dd($training->quotaPerOrg);
        // dd(TrainingService::getTrainingById($id)->trainingPrice());

        if ($participant > $leftoverQuota) {
            return redirect()->to(route('user.training_detail', $id))->with('error', 'Peserta yang anda daftarkan melebihi jumlah kuota anda.');
        }


        return view('user.pages.training.checkout')
            ->with([
                'participant' => $participant,
                'training' => $training,
                'price' => $price,
                'totalPrice' => $totalPrice,
                'paymentMethod' => PaymentMethodEnum::cases()
            ]);
    }
}

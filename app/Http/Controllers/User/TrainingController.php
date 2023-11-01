<?php

namespace App\Http\Controllers\User;

use App\Enums\PaymentMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\StoreParticipantRequest;
use App\Services\OrderService;
use App\Services\TrainingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    public function show($id): View
    {
        $training = TrainingService::getTrainingById($id)->fetch();
        if ($training->quotaPerOrg->quota != null) {
            $leftoverQuota = TrainingService::getTrainingById($id)->quotaPerOrgLeft(Auth::id());
            return view('user.pages.training.detail')
                ->with(compact('training', 'leftoverQuota'));
        }
        return view('user.pages.training.detail_unli')
            ->with(compact('training'));
    }



    public function checkout($id, Request $request)
    {
        $request = $request->validate(
            ['q' => 'numeric']
        );

        $participant = $request['q'];
        $training = TrainingService::getTrainingById($id)->fetch();
        $price = TrainingService::getTrainingById($id)->trainingPrice();
        $totalPrice = $price * $request['q'];

        if ($training->quotaPerOrg->quota != null) {
            $leftoverQuota = TrainingService::getTrainingById($id)->quotaPerOrgLeft(Auth::id());
            if ($participant > $leftoverQuota) {
                return redirect()->to(route('user.training_detail', $id))->with('error', 'Peserta melebihi jumlah kuota yang ditentukan.');
            }
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

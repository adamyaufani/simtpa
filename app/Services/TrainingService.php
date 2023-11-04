<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderParticipant;
use App\Models\QuotaPerOrg;
use App\Models\Training;
use App\Models\TrainingTrainer;
use App\Models\Transaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingService
{

    public static $training;

    public static function storeTraining($request)
    {
        // dd(implode(', ', $request['category_id']));
        DB::transaction(function () use ($request) {

            $data = Arr::except($request, ['trainer_id', 'image', 'quota', 'category_id']);
            $data = Arr::add($data, 'category_id', implode(',', $request['category_id']));
            // dd($data);

            if ($request['cost'] == 'free') {
                $data = Arr::except($data, [
                    // 'price_earlybird',
                    // 'earlybird_end',
                    'price_normal',
                    // 'price_onsite'
                ]);
            }

            // dd($data);

            $training = Training::create($data);
            $file = $request['image'];
            $fileName = $file->getClientOriginalName();
            $fileLocation = 'trainings/training_banner' . '/' . $training['id'] . '/';
            Storage::putFileAs($fileLocation, $file, $fileName);
            $training->update([
                'image' => $fileLocation . $fileName
            ]);

            TrainingTrainer::create([
                'training_id' => $training->id,
            ]);

            QuotaPerOrg::create([
                'quota' => $request['quota'],
                'training_id' => $training->id
            ]);
        });
    }

    public static function getTrainingById($id)
    {
        static::$training = Training::findOrFail($id);
        return new static;
    }

    public static function updateTraining($request)
    {
        DB::transaction(function () use ($request) {

            $training = static::$training;
            $idCategories = implode(',', $request['category_id']);
            $validatedRequest = $request->validated();
            $data = Arr::set($validatedRequest, 'category_id', $idCategories);
            $training->update($data);

            if ($request->has('image')) {
                $file = $request['image'];
                $fileName = $file->getClientOriginalName();
                $fileLocation = 'trainings/training_banner' . '/' . $training['id'] . '/';
                Storage::putFileAs($fileLocation, $file, $fileName);
                $training->update([
                    'image' => $fileLocation . $fileName
                ]);

                $training->update([
                    'image' => $fileLocation . $fileName
                ]);
            }
        });
    }

    public static function fetch()
    {
        return static::$training;
    }

    public static function trainingPrice()
    {

        $training = static::$training;

        // dd($training->earlybird_end);
        if (now() < $training->earlybird_end) {
            return $training->price_earlybird;
        }

        if (now() == $training->start_date) {
            return $training->price_onsite;
        }

        return $training->price_normal;
    }

    public static function quotaPerOrgLeft($user_id)
    {
        $training = static::$training;

        $transactions = Transaction::where([
            'user_id' => $user_id,
        ])->get();

        if ($transactions) {
            $participants = [];
            foreach ($transactions as $transaction) {
                foreach ($transaction->orders->where('training_id', '=', $training->id) as $order) {
                    $participants[] = $order->orderParticipants->count();
                }
            }
            $usedQuota = collect($participants)->sum();
            $leftoverQuota = $training->quotaPerOrg->quota - $usedQuota;

            return $leftoverQuota;
        }

        // $order = Order::where([
        //     ['training_id', '=', $training->id],
        //     ['user_id', '=', $user_id]
        // ])->get();

        // if ($order) {
        //     $participants = [];
        //     foreach ($order as $item) {
        //         $participants[] = $item->orderParticipants->count();
        //     }
        //     // $participants = OrderParticipant::where('order_id', '=', $order->id)->count();
        //     $usedQuota = collect($participants)->sum();
        //     $leftoverQuota = $training->quotaPerOrg->quota - $usedQuota;

        //     return $leftoverQuota;
        // }

        return $training->quotaPerOrg->quota;
    }

    public static function deleteTraining()
    {
        $training = static::$training;
        $filePath = Crypt::decryptString($training->image);
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $training->delete();
    }

    public static function trainingParticipants()
    {
        $trainings = Training::with('participants')->get();
        // foreach ($trainings as $training) {
        //     foreach ($training->participants as $participant) {
        //         dump($participant->student->user->userProfile->institution_name);
        //     }
        // }
        // die();
        return $trainings;
    }
}

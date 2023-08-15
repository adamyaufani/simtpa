<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderParticipant;
use App\Models\QuotaPerOrg;
use App\Models\Training;
use App\Models\TrainingTrainer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainingService
{

    public static $training;

    public static function storeTraining($request)
    {
        // dd($request);
        DB::transaction(function () use ($request) {

            $data = Arr::except($request, ['trainer_id', 'image', 'quota']);

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
                'trainer_id' => $request['trainer_id'],
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

            $training->update(Arr::except($request, 'trainer_id'));

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

            $training_trainer = TrainingTrainer::where([
                ['training_id', '=', $training->id],
                ['trainer_id', '=', $training->trainers()->first()->id]
            ])
                ->first();
            $training_trainer->update([
                'trainer_id' => $request['trainer_id']
            ]);
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

        $order = Order::where([
            ['training_id', '=', $training->id],
            ['user_id', '=', $user_id]
        ])->first();

        if ($order) {
            $participants = OrderParticipant::where('order_id', '=', $order->id)->count();
            $leftoverQuota = $training->quotaPerOrg->quota - $participants;

            return $leftoverQuota;
        }

        return $training->quotaPerOrg->quota;
    }

    public static function trainingIndex()
    {
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GenderEnumEvent;
use App\Enums\GenderRequirementEnum;
use App\Enums\ParticipantTypeEnum;
use App\Enums\TrainingTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainingRequest;
use App\Http\Requests\Admin\UpdateTrainingRequest;
use App\Models\Category;
use App\Models\Training;
use App\Services\TrainingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingController extends Controller
{

    public function index(): View
    {
        $trainings = Training::all();

        return view('admin.pages.training.index')
            ->with(compact('trainings'));
    }

    public function create(): View
    {
        $types = TrainingTypeEnum::cases();
        $genderRequirements = GenderRequirementEnum::cases();
        $participantTypes = ParticipantTypeEnum::cases();
        return view('admin.pages.training.create')
            ->with(compact('types', 'genderRequirements', 'participantTypes'));
    }

    public function store(StoreTrainingRequest $request): RedirectResponse
    {
        // dd($request->validated());
        TrainingService::storeTraining($request->validated());
        return redirect()->back()->with('success', 'Event baru berhasil dibuat');
    }

    public function edit($id): View
    {
        $training = Training::find($id);
        $types = TrainingTypeEnum::cases();
        $genderRequirements = GenderRequirementEnum::cases();
        $trainingCategories = explode(', ', $training->category_id);
        $detailedTrainingCategories = [];
        foreach ($trainingCategories as $trainingCategory) {
            $detailedTrainingCategories[] = Category::find($trainingCategory);
        }
        // dd($detailedTrainingCategories);
        return view('admin.pages.training.edit')
            ->with(compact([
                'types',
                'training',
                'genderRequirements',
                'detailedTrainingCategories'
            ]));
    }

    public function update(UpdateTrainingRequest $request, $id): RedirectResponse
    {
        // dd($request->validated());
        TrainingService::getTrainingById($id)->updateTraining($request);
        return redirect()->back()->with('success', 'Event berhasil diperbarui');
    }

    public function destroy($id)
    {
        TrainingService::getTrainingById($id)->deleteTraining();
        return redirect()->back()->with('success', 'Event berhasil dihapus');
    }

    public function participants()
    {
        $participants = TrainingService::trainingParticipants();
        return view('admin.pages.training.participants')
            ->with(compact('participants'));
    }

    public function changeEventStatus($id)
    {
        TrainingService::getTrainingById($id)->setStatus();

        return redirect()->back()->with('success', 'Status event berhasil diperbarui');
    }
}

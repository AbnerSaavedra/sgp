<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use App\Models\Consultation;
use App\Models\MedicalHistory;

use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    //
       public function index(): Renderable
    {
        $consultations = Consultation::paginate();
        return view('consultations.index', compact('consultations'));
    }

    public function getConsultations(MedicalHistory $medicalHistory): Renderable
    {
        //dd($medicalHistory);
        $consultations = Consultation::paginate();
        return view('consultations.index', compact('consultations', 'medicalHistory'));
    }

    public function createConsultation(MedicalHistory $medicalHistory): Renderable
    {
        $consultation = new Consultation;
        $title = __('Consultation store');
        $action = route('consultations.store');
        $method = 'POST';
        $buttonText = __('Store');
        return view('consultations.form', compact('consultation', 'title', 'action', 'buttonText', 'medicalHistory', 'method'));
    }

    public function store(Request $request): RedirectResponse
    {

        //dd('Reuest: ', $request);

        $request->validate([
            'medicalHistoryId' => 'required|string|max:100',
            'reason' => 'required|string|max:100',
            'dateConsultation' => 'required|string|max:100',
            'prescriptions' => 'required|string|max:100',
            'nextConsultation' => 'required|string|max:50',

        ]);
        Consultation::create([
            'medicalHistoryId' => $request->string('medicalHistoryId'),
            'reason' => $request->string('reason'),
            'dateConsultation' => $request->string('dateConsultation'),
            'prescriptions' => $request->string('prescriptions'),
            'nextConsultation' => $request->string('nextConsultation')

        ]);
        
        return redirect()->route('consultations.index');
    }

    public function edit(Consultation $consultation): Renderable
    {
        $title = __('Consultation edit');
        $action = route('consultations.update', $consultation);
        $buttonText = __('Edit');
        $method = 'PUT';
        return view('consultations.form', compact('consultation', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Consultation $consultation): RedirectResponse
    {

        //dd('Reuest: ', $request);

        $request->validate([
            'reason' => 'required|string|max:100',
            'dateConsultation' => 'required|string|max:100',
            'prescriptions' => 'required|string|max:100',
            'nextConsultation' => 'required|string|max:50',

        ]);
        $consultation->update([
            'reason' => $request->string('reason'),
            'dateConsultation' => $request->string('dateConsultation'),
            'prescriptions' => $request->string('prescriptions'),
            'nextConsultation' => $request->string('nextConsultation')

        ]);
        
        return redirect()->route('consultations.index');
    }
}

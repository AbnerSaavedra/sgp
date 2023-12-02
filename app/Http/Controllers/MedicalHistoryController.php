<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\Patient;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    public function index(): Renderable
    {
        $medicalHistories = MedicalHistory::paginate();
        return view('medicalHistory.index', compact('medicalHistories'));
    }

    public function create(Patient $patient): Renderable
    {
        //dd('Patient: ', $patient);
        $medHistory = new MedicalHistory;
        $title = __('Medical History store');
        $action = route('medicalHistory.store');
        $buttonText = __('MedicalHistory store');
        return view('medicalHistory.form', compact('patient', 'medHistory', 'title', 'action', 'buttonText'));
    }

    public function CreateMedicalHistory(Patient $patient): Renderable
    {
        //dd('Patient: ', $patient);
        $patientId = $patient->idCard;
        $medHistory = MedicalHistory::find($patientId);

        //dd($medHistory);

        if ($medHistory){

          return view('medicalHistory.show', compact('medHistory'));   

        }else{

            $medHistory = new MedicalHistory;
            $title = __('Medical History store');
            $action = route('medicalHistory.store');
            $buttonText = __('MedicalHistory store');
            return view('medicalHistory.form', compact('patient', 'medHistory', 'title', 'action', 'buttonText'));  
        }
    }

    public function store(Request $request, Patient $patient): RedirectResponse
    {

        //dd('Patient: ', $patient, 'Reuest: ', $request);

        $request->validate([
            'patientId' => 'required|string|max:100',
            'idHistory' => 'required|string|max:100',
            'openingDate' => 'required|string|max:100',
            'personalBackground' => 'required|string|max:50',
            'familyHistory' => 'required|string|max:1000',

        ]);
        MedicalHistory::create([
            'idHistory' => $request->string('idHistory'),
            'openingDate' => $request->string('openingDate'),
            'patientId' => $request->string('patientId'),
            'personalBackground' => $request->string('personalBackground'),
            'familyHistory' => $request->string('familyHistory'),

        ]);
        
        return redirect()->route('medicalHistory.create');
    }

    public function show(MedicalHistory $medHistory): Renderable
    {
        // $patient->load('user:id,name');
        dd('Medical show');
        return view('medicalHistory.show', compact('medHistory'));
    }

    public function edit(MedicalHistory $medHistory): Renderable
    {
        $title = __('Medical History edit');
        $action = route('medicalHistory.update', $medHistory);
        $buttonText = __('MedicalHistory update');
        $method = 'PUT';
        return view('medicalHistory.form', compact('medHistory', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, MedicalHistory $medHistory): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:patients,name,' . $medHistory->id . '|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:100',
            'address' => 'required|string|max:1000',
            'birthday' => 'required|date',

        ]);
        $medHistory->update([
            'name' => $request->string('name'),
            'lastname' => $request->string('lastname'),
            'address' => $request->string('address'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'birthday' => $request->string('birthday'),

        ]);
        
        return redirect()->route('medicalHistory.index');
    }

    public function destroy(MedicalHistory $medHistory): RedirectResponse
    {
        $medHistory->delete();
        return redirect()->route('medicalHistory.index');
    }
}

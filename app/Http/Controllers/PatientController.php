<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(): Renderable
    {
        $patients = Patient::paginate();
        return view('patients.index', compact('patients'));
    }

    public function create(): Renderable
    {
        $patient = new Patient;
        $title = __('Patient store');
        $action = route('patients.store');
        $buttonText = __('Patient store');
        $method = 'POST';
        return view('patients.form', compact('patient', 'title', 'action', 'buttonText', 'method'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'idCard' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:1000',
            'birthday' => 'required|date',

        ]);
        Patient::create([
            'idCard' => $request->string('idCard'),
            'name' => $request->string('name'),
            'lastname' => $request->string('lastname'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'address' => $request->string('address'),
            'birthday' => $request->string('birthday'),

        ]);
        
        return redirect()->route('patients.index');
    }

    public function show(Patient $patient): Renderable
    {
        // $patient->load('user:id,name');
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient): Renderable
    {
        $title = __('Patient edit');
        $action = route('patients.update', $patient);
        $buttonText = __('Patient update');
        $method = 'PUT';
        return view('patients.form', compact('patient', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:patients,name,' . $patient->id . '|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:100',
            'address' => 'required|string|max:1000',
            'birthday' => 'required|date',

        ]);
        $patient->update([
            'name' => $request->string('name'),
            'lastname' => $request->string('lastname'),
            'address' => $request->string('address'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'birthday' => $request->string('birthday'),

        ]);
        
        return redirect()->route('patients.index');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();
        return redirect()->route('patients.index');
    }
}

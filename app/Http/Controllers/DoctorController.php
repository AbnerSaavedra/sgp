<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
   public function index(): Renderable
    {
        $doctors = Doctor::paginate();
        return view('doctors.index', compact('doctors'));
    }

    public function create(): Renderable
    {
        $doctor = new Doctor;
        $title = __('Doctor store');
        $action = route('doctors.store');
        $buttonText = __('Doctor store');
        return view('doctors.form', compact('doctor', 'title', 'action', 'buttonText'));
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
        Doctor::create([
            'idCard' => $request->string('idCard'),
            'name' => $request->string('name'),
            'lastname' => $request->string('lastname'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'address' => $request->string('address'),
            'birthday' => $request->string('birthday'),

        ]);
        
        return redirect()->route('doctors.index');
    }

    public function show(Doctor $doctor): Renderable
    {
        // $doctor->load('user:id,name');
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor): Renderable
    {
        $title = __('Doctor edit');
        $action = route('doctors.update', $doctor);
        $buttonText = __('Doctor update');
        $method = 'PUT';
        return view('doctors.form', compact('doctor', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:doctors,name,' . $doctor->id . '|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:100',
            'address' => 'required|string|max:1000',
            'birthday' => 'required|date',

        ]);
        $doctor->update([
            'name' => $request->string('name'),
            'lastname' => $request->string('lastname'),
            'address' => $request->string('address'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'birthday' => $request->string('birthday'),

        ]);
        
        return redirect()->route('doctors.index');
    }

    public function destroy(Doctor $doctor): RedirectResponse
    {
        $doctor->delete();
        return redirect()->route('doctors.index');
    }
}

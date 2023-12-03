<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @isset ($method)
                            @method($method)
                        @endif
                        @if ($method === 'POST')
                        <div class="mb-4">
                            <input type="hidden" name="medicalHistoryId" id="medicalHistoryId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $medicalHistory->idHistory }}">
                            @error('patienId')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        <div class="mb-4">
                            <label for="reason" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Reason') }}</label>
                            <input type="text" name="reason" id="reason" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('reason', $consultation->reason) }}">
                            @error('reason')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="dateConsultation" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Date') }}</label>
                            <input type="date" name="dateConsultation" id="dateConsultation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('dateConsultation', $consultation->dateConsultation) }}">
                            @error('dateConsultation')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="prescriptions" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Prescriptions') }}</label>
                            <input type="text" name="prescriptions" id="prescriptions" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('prescriptions', $consultation->prescriptions) }}">
                            @error('prescriptions')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nextConsultation" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Next consultation') }}</label>
                            <input type="date" name="nextConsultation" id="nextConsultation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nextConsultation', $consultation->nextConsultation) }}">
                            @error('nextConsultation')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                        @if ($method === 'POST')
                            <a href="{{ route('consultations.getConsultations', $medicalHistory) }}" class="bg-gray-500 hover:bg-gray-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Cancel') }}</a>
                        @endif
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-gray-800 font-bold py-2 px-4 rounded ml-2">{{ $buttonText }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
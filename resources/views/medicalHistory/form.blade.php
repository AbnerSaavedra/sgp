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
                        <div class="mb-4">
                            <input type="hidden" name="patientId" id="patientId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $patient->idCard }}">
                            @error('patienId')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="idHistory" class="block text-gray-700 text-sm font-bold mb-2">{{ __('History id') }}</label>
                            <input type="text" name="idHistory" id="idHistory" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('idHistory', $medHistory->idHistory) }}">
                            @error('idHistory')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="openingDate" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Opening date') }}</label>
                            <input type="date" name="openingDate" id="openingDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('openingDate', $medHistory->openingDate) }}">
                            @error('openingDate')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="personalBackground" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Personal background') }}</label>

                            <textarea rows="4", cols="54" id="personalBackground" name="personalBackground" style="resize:none, "></textarea>
                            @error('personalBackground')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="familyHistory" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Family history') }}</label>

                            <textarea rows="4", cols="54" id="familyHistory" name="familyHistory" style="resize:none, "></textarea>
                            @error('familyHistory')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('patients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Cancel') }}</a>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-gray-800 font-bold py-2 px-4 rounded ml-2">{{ $buttonText }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
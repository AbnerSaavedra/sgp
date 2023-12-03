@extends('layouts.table')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consultations') }} {{$medicalHistory->idHistory}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <a href="{{ route('consultations.createConsultation', $medicalHistory) }}" class="bg-indigo-500 hover:bg-indigo-700 text-gray-800 font-bold py-2 px-4 rounded">Consultation store</a>
                    </div>
                    <div class="mt-4">
                        <table class="table-auto w-full display compact" id="consultations-table">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">{{ __('Reason') }}</th>
                                    <th class="px-4 py-2">{{ __('Date') }}</th>
                                    <th class="px-4 py-2">{{ __('Prescriptions') }}</th>
                                    <th class="px-4 py-2">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @forelse ($consultations as $consultation)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $consultation->reason }}</td>
                                        <td class="border px-4 py-2">{{ $consultation->dateConsultation }}</td>
                                        <td class="border px-4 py-2">{{ $consultation->prescriptions }}</td>
                                        <td class="border px-4 py-2" style="width: 260px">
                                            <a href="{{ route('consultations.show', $consultation) }}" class="bg-blue-500 hover:bg-blue-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Ver') }}</a>
                                            <a href="{{ route('consultations.edit', $consultation) }}" class="bg-blue-500 hover:bg-blue-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Editar') }}</a>
                                            <a href="{{ route('medicalHistory.createMedicalHistory', $consultation) }}" class="bg-blue-500 hover:bg-blue-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Medical history') }}</a>
                                            <form action="{{ route('consultations.destroy', $consultation) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-red-400 text-white text-center">
                                        <td colspan="3" class="border px-4 py-2">{{ __('No consultations to show') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($consultations->hasPages())
                                <tfoot class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="border px-4 py-2">
                                            {{ $consultation->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                        @section('scripts')
                        <script>
                            $(document).ready(function() {
                                $('#consultations-table').DataTable();
                            });
                        </script>
                        @endsection

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
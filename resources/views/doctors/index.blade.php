@extends('layouts.table')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold">{{ __('Doctors') }}</h1>
                        <a href="{{ route('doctors.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-gray-800 font-bold py-2 px-4 rounded">Doctor store</a>
                    </div>
                    <div class="mt-4">
                        <table class="table-auto w-full display" id="doctors-table">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">{{ __('Name') }}</th>
                                    <th class="px-4 py-2">{{ __('Address') }}</th>
                                    <th class="px-4 py-2">{{ __('Email') }}</th>
                                    <th class="px-4 py-2">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @forelse ($doctors as $patient)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $patient->name }}{{ $patient->lastname }}</td>
                                        <td class="border px-4 py-2">{{ $patient->address }}</td>
                                        <td class="border px-4 py-2">{{ $patient->email }}</td>
                                        <td class="border px-4 py-2" style="width: 260px">
                                            <a href="{{ route('doctors.show', $patient) }}" class="bg-blue-500 hover:bg-blue-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Ver') }}</a>
                                            <a href="{{ route('doctors.edit', $patient) }}" class="bg-blue-500 hover:bg-blue-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Editar') }}</a>
                                            <form action="{{ route('doctors.destroy', $patient) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-800 font-bold py-2 px-4 rounded">{{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-red-400 text-white text-center">
                                        <td colspan="3" class="border px-4 py-2">{{ __('No doctors to show') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($doctors->hasPages())
                                <tfoot class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="border px-4 py-2">
                                            {{ $doctors->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                        @section('scripts')
                        <script>
                            $(document).ready(function() {
                                $('#doctors-table').DataTable();
                            });
                        </script>
                        @endsection
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
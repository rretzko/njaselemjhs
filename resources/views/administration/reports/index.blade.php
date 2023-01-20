<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Main Menu') }}
        </h2>

        <div class="text-lg mt-4">
            <a href="{{ route('dashboard') }}" class="text-indigo-500">
                Dashboard
            </a>
             -
            <a href="{{ route('administration.index') }}" class="text-indigo-500">
                Administration
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">
                <ol>
                    <li>Adjudication Backups
                        <ol class="ml-4" style="font-size: 1.3rem;">
                            <li>
                                <a href="{{ route('administration.reports.adjudicationbackup', ['ensemble' => 1]) }}" class="text-indigo-500">
                                    Elementary Adjudication Backup pdf
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('administration.reports.adjudicationbackup', ['ensemble' => 2]) }}" class="text-indigo-500">
                                    Junior High Adjudication Backup pdf
                                </a>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <a href="{{ route('administration.reports.scores') }}" class="text-indigo-500">
                            Scores pdfs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('administration.reports.participants') }}" class="text-indigo-500">
                            Participant csv files
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</x-app-layout>

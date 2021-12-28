<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Csv File Upload') }}
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
                <form method="post" action="{{ route('administration.import', ['filename' => $filename]) }}" enctype="multipart/form-data"
                      class="space-y-8 divide-y divide-gray-200"
                >
                    @csrf

<!--  TAILWIND UI FORM START -->
                    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                <div>

                                    <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                            <label for="cover-photo" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                                Csv File
                                            </label>
                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                    <div class="space-y-1 text-center">
                                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <div class="flex text-sm text-gray-600 flex-col">
                                                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                <span>Upload a csv file</span>
                                                                <input id="file-upload" name="{{ $filename }}" type="file" class="sr-only">
                                                            </label>
                                                            <p class="pl-1">or drag and drop CSV up to 10MB</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    <div class="pt-5 mb-4">
                        <div class="flex justify-end">
                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Upload
                            </button>
                        </div>
                    </div>
                </form>

                        <!-- TAILWIND UI FORM END -->

            </div>
        </div>
    </div>
</x-app-layout>


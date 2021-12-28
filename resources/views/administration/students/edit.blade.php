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
            <a href="{{ route('administration.index')  }}" class="text-indigo-500">
                Administration
            </a>
            -
            <a href="{{ route('administration.directors')  }}" class="text-indigo-500">
                Directors
            </a>
        </div>
    </x-slot>

    <style>
        legend{background-color: rgba(97,0,174,.1); width: 100%; padding:0.25rem 0.5rem; font-weight: bold; text-transform: uppercase; color: rgb(97,0,174);}
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4">

                <form class="space-y-8 divide-y divide-gray-200" method="post" action="{{ route('administration.director.update', ['director' => $director]) }}">

                    @csrf

                    <div class="space-y-8 divide-y divide-gray-200">

                        <div>
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Director Profile for: <b class="text-xl">{{ $director->fullnameAlpha }}</b>
                                </h3>

                            </div>
                        </div>

                        <div class="pt-1">

                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div id="labels" class="flex row mb-4">
                                    <div style="width: 30%;">
                                        <label for="user_id" class="block text-sm font-medium text-gray-700">
                                            System Id: {{ $director->user_id }}
                                        </label>
                                    </div>
                                </div>

                                <div id="labels" class="flex row ">
                                    <div style="width: 30%;">
                                        <label for="first" class="block text-sm font-medium text-gray-700">
                                            First Name
                                        </label>
                                    </div>
                                    <div style="width: 30%;">
                                        <label for="last" class="block text-sm font-medium text-gray-700">
                                            Last Name
                                        </label>
                                    </div>
                                </div>

                                <div id="data" class="flex row ">
                                    <div style="width: 30%;" class="mt-1">
                                        <input type="text" name="first" id="first" autocomplete=""
                                               class="w-3/4 @error('first') border border-gray-300 @enderror"
                                               value="{{ $director->first }}"
                                        >
                                        @error('first') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                    <div style="width: 30%;" class="mt-1">
                                        <input type="text" name="last" id="last" autocomplete=""
                                               class="w-3/4 @error('last') border border-gray-300 @enderror"
                                               value="{{ $director->last }}"
                                        >
                                        @error('last') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- CONTACTS --}}
                            <fieldset class="mt-6">
                                <legend class="text-base font-medium">
                                    Contacts
                                </legend>

                                <div class="sm:col-span-4 mt-1">
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email address
                                    </label>
                                    <div class="mt-1">
                                        <input id="email" name="email" type="email" autocomplete="email"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('email') border border-gray-300 @enderror"
                                               value="{{ $director->user->email }}"
                                        >
                                        @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-4 mt-1">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">
                                        Phone
                                    </label>
                                    <div class="mt-1">
                                        <input id="phone" name="phone" type="text" autocomplete="phone"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('phone') border border-gray-300 @enderror"
                                               value="{{ $director->phone }}"
                                        >
                                        @error('phone') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </fieldset>

                            {{-- ADDRESS --}}
                            <fieldset class="mt-6">
                                <legend class="text-base font-medium">
                                    Address
                                </legend>
                                <div class="sm:col-span-6 mt-1">
                                    <label for="address1" class="block text-sm font-medium text-gray-700">
                                        Street address
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="address1" id="address1"
                                               autocomplete="address1"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('address1') border border-gray-300 @enderror"
                                                value="{{ $director->address1 }}"
                                        >
                                        @error('address1') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-6 mt-1">
                                    <div class="mt-1">
                                        <input type="text" name="address2" id="address2"
                                               autocomplete="address2"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('address2') border border-gray-300 @enderror"
                                                value="{{ $director->address2 }}"
                                        >
                                        @error('address2') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-2 mt-1">
                                    <label for="city" class="block text-sm font-medium text-gray-700">
                                        City
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="city" id="city" autocomplete="city"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('city') border border-gray-300 @enderror"
                                            value="{{ $director->city }}"
                                        >
                                        @error('city') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-2 mt-1">
                                    <label for="state_abbr" class="block text-sm font-medium text-gray-700">
                                        State Abbreviation
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="state_abbr" id="state_abbr" autocomplete="state_abbr"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('state_abbr') border border-gray-300 @enderror"
                                            value="{{ $director->state_abbr }}"
                                        >
                                        @error('state_abbr') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-2 mt-1">
                                    <label for="postal_code" class="block text-sm font-medium text-gray-700">
                                        ZIP / Postal code
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="postal_code" id="postal_code" autocomplete="postal_code"
                                           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('postal_code') border border-gray-300 @enderror"
                                            value="{{ $director->postal_code }}"
                                        >
                                        @error('postal_code') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="country" class="block text-sm font-medium text-gray-700">
                                        Country
                                    </label>
                                    <div class="mt-1">
                                        <select id="country" name="country" autocomplete="country" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('country') border border-gray-300 @enderror">
                                            <option>US</option>
                                            <option>CA</option>
                                            <option>MX</option>
                                        </select>
                                        @error('country') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </fieldset>

                            {{-- SCHOOL --}}
                            <fieldset class="mt-6">
                                <legend class="text-base font-medium">
                                    School
                                </legend>
                                <div class="sm:col-span-6 mt-1">
                                    <label for="school" class="block text-sm font-medium text-gray-700">
                                        School
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="school" id="school"
                                               autocomplete=""
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('school') border border-gray-300 @enderror"
                                               value="{{ $director->school }}"
                                        >
                                        @error('school') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-6 mt-1">
                                    <label for="saddress1" class="block text-sm font-medium text-gray-700">
                                        Street address
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="saddress1" id="saddress1"
                                               autocomplete="saddress1"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('saddress1') border border-gray-300 @enderror"
                                               value="{{ $director->saddress1 }}"
                                        >
                                        @error('saddress1') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-6 mt-1">
                                    <div class="mt-1">
                                        <input type="text" name="saddress2" id="saddress2"
                                               autocomplete="saddress2"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('saddress2') border border-gray-300 @enderror"
                                               value="{{ $director->saddress2 }}"
                                        >
                                        @error('saddress2') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-2 mt-1">
                                    <label for="city" class="block text-sm font-medium text-gray-700">
                                        City
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="scity" id="scity" autocomplete="scity"
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('scity') border border-gray-300 @enderror"
                                               value="{{ $director->scity }}"
                                        >
                                        @error('scity') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-2 mt-1">
                                    <label for="state_abbr" class="block text-sm font-medium text-gray-700">
                                        State Abbreviation
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="sstate_abbr" id="sstate_abbr" autocomplete=""
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('sstate_abbr') border border-gray-300 @enderror"
                                               value="{{ $director->sstate_abbr }}"
                                        >
                                        @error('sstate_abbr') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-2 mt-1">
                                    <label for="spostal_code" class="block text-sm font-medium text-gray-700">
                                        ZIP / Postal code
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="spostal_code" id="spostal_code" autocomplete=""
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('spostal_code') border border-gray-300 @enderror"
                                               value="{{ $director->spostal_code }}"
                                        >
                                        @error('spostal_code') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </fieldset>

                            {{-- MEMBERSHIP --}}
                            <fieldset class="mt-6">
                                <legend class="text-base font-medium">
                                    Memberships
                                </legend>
                                <div class="sm:col-span-2 mt-1">
                                    <label for="membership" class="block text-sm font-medium text-gray-700">
                                        Membership
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="membership" id="membership" autocomplete=""
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('membership') border border-gray-300 @enderror"
                                               value="{{ $director->membership }}"
                                        >
                                        @error('membership') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-2 mt-1">
                                    <label for="membership_card" class="block text-sm font-medium text-gray-700">
                                        Membership Card
                                    </label>
                                    <div class="mt-1">
                                        <a href="{{ $director->membership_card }}" title="Click for membership card" target="_blank" style="color: rgb(97,0,174);">
                                            Click here for Membership Card
                                        </a>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-6">
                                <legend class="text-base font-medium">
                                    Counts
                                </legend>
                                <div class="sm:col-span-2 mt-1">
                                    <label for="elem_student_count" class="block text-sm font-medium text-gray-700">
                                        Elementary School Student Count
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="elem_student_count" id="elem_student_count" autocomplete=""
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('elem_student_count') border border-gray-300 @enderror"
                                               value="{{ $director->elem_student_count }}"
                                        >
                                        @error('elem_student_count') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>

                                    <label for="jhs_student_count" class="block text-sm font-medium text-gray-700">
                                        Junior High School Student Count
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" name="jhs_student_count" id="jhs_student_count" autocomplete=""
                                               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('jsh_student_count') border border-gray-300 @enderror"
                                               value="{{ $director->jhs_student_count }}"
                                        >
                                        @error('jsh_student_count') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>

                    <div class="pt-5 mb-4">
                        <div class="flex justify-end">
                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>

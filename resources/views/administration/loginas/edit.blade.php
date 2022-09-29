<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration: Events') }}
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
            <a href="{{ route('administration.events')  }}" class="text-indigo-500">
                Events
            </a>
        </div>
    </x-slot>

    <div style="text-align: center; margin: 1rem;">
        <h3>Select a Director to Log In As...</h3>
        <form method="post" action="{{ route('administration.loginas.update') }}" style="text-align: center;">

            @csrf

            <div class="input-group" style="display:flex; flex-direction: column; margin-bottom: 0.5rem; margin-top: 1rem;">
                <label style="text-align: left;">Select Director</label>
                <select name="user_id" style="width: 40rem;" autofocus>
                    @foreach($directors AS $director)
                        <option value="{{ $director['user_id'] }}">
                            {{ $director['last'].', '.$director['first'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-group" style="display: flex; flex-direction: column;">
                <label></label>
                <input type="submit" name="submit" value="Submit" style="width: 12rem; background-color: black; color: white; border-radius: 1rem;" />
            </div>
        </form>
    </div>
</x-app-layout>

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
        <h3>Change a Director's Password</h3>
        <form method="post" action="{{ route('administration.changepassword.update') }}" style="text-align: center;">

            @csrf

            {{-- ERRORS --}}
            @if($errors->any())
                <div>ERRORS</div>
            @endif

            {{-- SUCCESS MESSAGE --}}
            @if(session()->has('success'))
                <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; border: 1px solid darkgreen;font-size: 0.8rem;  margin-top: 1rem; padding: 0 0.5rem; width: 40rem;">
                    {{ session()->get('success') }}
                </div>
            @endif

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

            <div class="input-group" style="display:flex; flex-direction: column; margin-bottom: 0.5rem; margin-top: 1rem;">
                <label style="text-align: left;">Enter New Password</label>
                <input type="text" name="password" value="" style="width: 20rem;"/>
                <div>
                    @error('password')
                    <div class="err-mssg">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="input-group" style="display: flex; flex-direction: column;">
                <label></label>
                <input type="submit" name="submit" value="Submit" style="width: 12rem; background-color: black; color: white; border-radius: 1rem;" />
            </div>
        </form>
    </div>
</x-app-layout>

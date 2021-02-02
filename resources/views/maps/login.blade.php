@extends(config('settings.theme').'.layouts.layout')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
<x-guest-layout>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div id="content-home" class="content_group">
            <form id="contact-form-contact-us" class="contact-form" method="POST" action="{{ route('login') }}">
                @csrf
                <fieldset>
                    <ul class="login_ul">
                        <li class="text_field">
                            <h3 class="title_login">Google Maps Login</h3>
                        </li>
                        <li class="text_field">
                            <x-jet-label for="email" value="Email: " />
                            <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" class="form-control email_input" required autofocus />
                        </li>
                        <li class="text_field">
                            <x-jet-label for="password" value="Password: " class="pass_label"/>
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" class="form-control pass_input" required autocomplete="current-password" />
                        </li>
                        <li class="text_field">
                            <x-jet-button class="btn btn-primary btn_login">
                                Login
                            </x-jet-button>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
</x-guest-layout>
@endsection

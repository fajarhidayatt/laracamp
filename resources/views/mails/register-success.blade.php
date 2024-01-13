<x-mail::message>
    # Welcome!

    Hi {{ $username }}
    Welcome to Laracamp, your account has been created successfully. Now you can choose your best match camp!

    <x-mail::button :url="$url">
        My Dashboard
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>

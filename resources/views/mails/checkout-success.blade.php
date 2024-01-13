<x-mail::message>
    # Checkout Success

    Hi {{ $username }}
    Thank you for register on ***{{ $campName }}***, please see payment instruction by click the button below.

    <x-mail::button :url="$url">
        Dashboard
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>

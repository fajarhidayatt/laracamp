<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs uppercase">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Camp
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Register Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Paid Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($checkouts as $checkout)
                                <tr class="">
                                    <th scope="row"
                                        class="px-6 py-4">
                                        {{ $checkout->user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $checkout->camp->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $checkout->total }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $checkout->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $checkout->payment_status }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="">
                                    <th scope="row" class="px-6 py-4 text-center" colspan="5">
                                        No Data
                                    </th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>

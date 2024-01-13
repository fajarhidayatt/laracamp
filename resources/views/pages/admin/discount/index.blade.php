<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('admin.discount.create') }}">
                <x-primary-button>Add Discount</x-primary-button>
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs uppercase">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Percentage
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($discounts as $discount)
                                <tr>
                                    <th scope="row" class="px-6 py-4">
                                        {{ $discount->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $discount->code }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $discount->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $discount->percentage }}%
                                    </td>
                                    <td class="py-4 flex">
                                        <a href="{{ route('admin.discount.edit', $discount->id) }}">
                                            <x-secondary-button>Edit</x-secondary-button>
                                        </a>
                                        <form action="{{ route('admin.discount.destroy', $discount->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>Delete</x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" class="px-6 py-4 text-center" colspan="5">
                                        No Data Discount Here!
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

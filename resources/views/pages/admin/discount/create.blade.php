<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Discount') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.discount.store') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <x-input-label for="name" value="Name" />
                            <x-text-input
                                name="name"
                                id="name"
                                class="mt-2 w-full"
                                value="{{ old('name') }}" />
                            @error('name')
                                <x-input-error messages="{{ $message }}" class="mt-1" />
                            @enderror
                        </div>
                        <div class="mb-5">
                            <x-input-label for="code" value="code" />
                            <x-text-input
                                name="code"
                                id="code"
                                class="mt-2 w-full"
                                value="{{ old('code') }}"
                                maxlength="5" />
                            @error('code')
                                <x-input-error messages="{{ $message }}" class="mt-1" />
                            @enderror
                        </div>
                        <div class="mb-5">
                            <x-input-label for="description" value="description" />
                            <x-text-input
                                name="description"
                                id="description"
                                class="mt-2 w-full"
                                value="{{ old('description') }}" />
                            @error('description')
                                <x-input-error messages="{{ $message }}" class="mt-1" />
                            @enderror
                        </div>
                        <div class="mb-5">
                            <x-input-label for="percentage" value="percentage" />
                            <x-text-input
                                type="number"
                                name="percentage"
                                id="percentage"
                                class="mt-2 w-full"
                                value="{{ old('percentage') }}" />
                            @error('percentage')
                                <x-input-error messages="{{ $message }}" class="mt-1" />
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button>Submit</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

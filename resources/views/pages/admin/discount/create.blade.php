<x-app-layout>
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
                            <label for="name">Name</label>
                            <div class="mt-2">
                                <x-text-input name="name" id="name"></x-text-input>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="code">Code</label>
                            <div class="mt-2">
                                <x-text-input name="code" id="code"></x-text-input>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="description">Description</label>
                            <div class="mt-2">
                                <x-text-input name="description" id="description"></x-text-input>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="percentage">Percentage</label>
                            <div class="mt-2">
                                <x-text-input type="number" name="percentage" id="percentage"></x-text-input>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button>Submit</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
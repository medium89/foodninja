<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('links.store') }}" class="p-6 space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="original_url" :value="__('Original URL')" />
                        <x-text-input
                            id="original_url"
                            name="original_url"
                            type="url"
                            class="mt-1 block w-full"
                            :value="old('original_url')"
                            placeholder="https://example.com/page"
                            required
                            autofocus
                        />
                        <x-input-error :messages="$errors->get('original_url')" class="mt-2" />
                    </div>

                    <x-primary-button>
                        {{ __('Create short link') }}
                    </x-primary-button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Original URL') }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Short URL') }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Clicks') }}
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($links as $link)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-md truncate">
                                        <a href="{{ $link->original_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $link->original_url }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        <a href="{{ route('links.redirect', $link->code) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                            {{ route('links.redirect', $link->code) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $link->clicks_count }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap text-right space-x-3">
                                        <a href="{{ route('links.show', $link) }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ __('Statistics') }}
                                        </a>

                                        <form method="POST" action="{{ route('links.destroy', $link) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                        {{ __('You have not created any short links yet.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($links->hasPages())
                    <div class="p-6 border-t border-gray-200">
                        {{ $links->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

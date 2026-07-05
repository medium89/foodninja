<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Link statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-4">
                    <div>
                        <div class="text-sm font-medium text-gray-500">{{ __('Original URL') }}</div>
                        <a href="{{ $shortLink->original_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 break-all">
                            {{ $shortLink->original_url }}
                        </a>
                    </div>

                    <div>
                        <div class="text-sm font-medium text-gray-500">{{ __('Short URL') }}</div>
                        <a href="{{ route('links.redirect', $shortLink->code) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 break-all">
                            {{ route('links.redirect', $shortLink->code) }}
                        </a>
                    </div>

                    <div>
                        <div class="text-sm font-medium text-gray-500">{{ __('Total clicks') }}</div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $shortLink->clicks_count }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('IP address') }}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Clicked at') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($clicks as $click)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $click->ip_address }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                        {{ $click->created_at->format('Y-m-d H:i:s') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-sm text-gray-500">
                                        {{ __('There are no clicks yet.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($clicks->hasPages())
                    <div class="p-6 border-t border-gray-200">
                        {{ $clicks->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

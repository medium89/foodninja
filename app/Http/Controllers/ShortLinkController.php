<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ShortLinkController extends Controller
{
    public function index(Request $request): View
    {
        $links = $request->user()
            ->shortLinks()
            ->withCount('clicks')
            ->latest()
            ->paginate(10);

        return view('links.index', compact('links'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'original_url' => ['required', 'url', 'starts_with:http://,https://', 'max:2048'],
        ]);

        $request->user()->shortLinks()->create([
            'original_url' => $validated['original_url'],
            'code' => $this->generateUniqueCode(),
        ]);

        return redirect()
            ->route('links.index')
            ->with('status', 'Short link created.');
    }

    public function show(Request $request, ShortLink $shortLink): View
    {
        abort_unless($shortLink->user()->is($request->user()), 404);

        $shortLink->loadCount('clicks');

        $clicks = $shortLink->clicks()
            ->latest()
            ->paginate(20);

        return view('links.show', compact('shortLink', 'clicks'));
    }

    public function destroy(Request $request, ShortLink $shortLink): RedirectResponse
    {
        abort_unless($shortLink->user()->is($request->user()), 404);

        $shortLink->delete();

        return redirect()
            ->route('links.index')
            ->with('status', 'Short link deleted.');
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = Str::random(6);
        } while (ShortLink::where('code', $code)->exists());

        return $code;
    }
}

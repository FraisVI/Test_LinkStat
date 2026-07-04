<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShortLinkRedirectController extends Controller
{
    public function __invoke(Request $request, string $code): RedirectResponse
    {
        $shortLink = ShortLink::query()
            ->where('code', $code)
            ->firstOrFail();

        $shortLink->clicks()->create([
            'ip_address' => $request->ip(),
        ]);

        return redirect()->away($shortLink->original_url);
    }
}

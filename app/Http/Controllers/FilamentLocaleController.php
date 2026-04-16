<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetFilamentLocale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FilamentLocaleController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'locale' => ['required', 'string', 'in:ar,en'],
        ]);

        $request->session()->put(SetFilamentLocale::SESSION_KEY, $validated['locale']);

        return redirect()->back();
    }
}

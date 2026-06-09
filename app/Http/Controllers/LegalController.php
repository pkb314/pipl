<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function terms()
    {
        return view('legal.terms', [
            'document' => file_get_contents(resource_path('legal/statut-pipl.txt')),
        ]);
    }

    public function privacy()
    {
        return view('legal.privacy');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    public function create()
    {
        $wojewodztwa = DB::table('wojewodztwa')->orderBy('nazwa')->pluck('nazwa');
        $handlowcy = User::whereIn('role', ['handlowiec', 'glowny_handlowiec'])->orderBy('name')->get();

        return view('admin.leads.create', compact('wojewodztwa', 'handlowcy'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'company' => 'required|string|max:100',
            'adres' => 'required|string|max:255',
            'gmina' => 'required|string|max:100',
            'about' => 'nullable|string|max:2000',
            'email' => 'required|email',
            'phone' => 'required|string|min:9',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $gminaRow = DB::table('gminy')
            ->join('powiaty', 'powiaty.id', '=', 'gminy.powiat_id')
            ->join('wojewodztwa', 'wojewodztwa.id', '=', 'powiaty.wojewodztwo_id')
            ->where('gminy.nazwa', $validated['gmina'])
            ->select('powiaty.nazwa as powiat', 'wojewodztwa.nazwa as wojewodztwo')
            ->first();

        Lead::create([
            ...$validated,
            'powiat' => $gminaRow?->powiat,
            'wojewodztwo' => $gminaRow?->wojewodztwo,
            'status' => 'zgłoszone',
            'source' => 'reczne',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.leads')->with('success', 'Zgłoszenie zostało dodane.');
    }
}

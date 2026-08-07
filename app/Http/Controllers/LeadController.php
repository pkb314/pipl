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
            'company' => 'nullable|string|max:100',
            'adres' => 'nullable|string|max:255',
            'gmina' => 'required|string|max:100',
            'gmina_reason' => 'nullable|string|max:2000',
            'about' => 'nullable|string|max:2000',
            'email' => 'required|email',
            'phone' => 'required|string|min:9',
            'business_sector' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:20',
            'knows_entrepreneurs' => 'nullable|string|max:2000',
            'own_business' => 'nullable|string|max:2000',
            'meeting_new_people' => 'nullable|string|max:2000',
            'organized_events' => 'nullable|string|max:2000',
            'handling_refusal' => 'nullable|string|max:2000',
            'local_government_contacts' => 'nullable|string|max:2000',
            'working_style' => 'nullable|string|max:2000',
            'weekly_time' => 'nullable|string|max:2000',
            'motivation' => 'nullable|array',
            'motivation.*' => 'string|max:200',
            'motivation_other' => 'nullable|string|max:500',
            'confidentiality' => 'nullable|string|max:2000',
            'conflicts' => 'nullable|string|max:2000',
            'why_you' => 'nullable|string|max:2000',
            'additional_info' => 'nullable|string|max:2000',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if (!empty($validated['motivation'])) {
            $motivations = $validated['motivation'];
            if (!empty($validated['motivation_other'])) {
                $motivations[] = 'Inne: ' . $validated['motivation_other'];
            }
            $validated['motivation'] = implode(', ', $motivations);
        } else {
            $validated['motivation'] = null;
        }
        unset($validated['motivation_other']);

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

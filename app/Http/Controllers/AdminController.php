<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if ($request->input('password') !== 'Pipl0727') {
            return back()->withErrors(['password' => 'Nieprawidłowe hasło.']);
        }

        session(['admin_verified' => true]);

        return redirect()->route('admin.leads');
    }

    public function logout()
    {
        session()->forget('admin_verified');

        return redirect()->route('admin.login');
    }

    public function index(Request $request)
    {
        $query = Lead::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                    ->orWhere('surname', 'ilike', "%{$search}%")
                    ->orWhere('company', 'ilike', "%{$search}%")
                    ->orWhere('email', 'ilike', "%{$search}%")
                    ->orWhere('gmina', 'ilike', "%{$search}%")
                    ->orWhere('phone', 'ilike', "%{$search}%");
            });
        }

        if ($wojewodztwo = $request->input('wojewodztwo')) {
            $query->where('wojewodztwo', $wojewodztwo);
        }

        if ($powiat = $request->input('powiat')) {
            $query->where('powiat', $powiat);
        }

        if ($gmina = $request->input('gmina')) {
            $query->where('gmina', $gmina);
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $leads = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        $wojewodztwa = DB::table('wojewodztwa')->orderBy('nazwa')->pluck('nazwa');
        $powiaty = DB::table('powiaty')->orderBy('nazwa')->pluck('nazwa');
        $gminy = DB::table('gminy')->orderBy('nazwa')->pluck('nazwa');

        return view('admin.leads', compact('leads', 'wojewodztwa', 'powiaty', 'gminy'));
    }

    public function accept(Lead $lead)
    {
        $lead->update(['status' => 'zaakceptowane']);

        return back()->with('success', "Zgłoszenie {$lead->name} {$lead->surname} zostało zaakceptowane.");
    }

    public function reject(Lead $lead)
    {
        $lead->update(['status' => 'odrzucone']);

        return back()->with('success', "Zgłoszenie {$lead->name} {$lead->surname} zostało odrzucone.");
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:zgłoszone,zaakceptowane,odrzucone',
        ]);

        $lead->update(['status' => $request->input('status')]);

        return back()->with('success', "Status zgłoszenia {$lead->name} {$lead->surname} został zmieniony.");
    }

    public function checkGmina(Request $request)
    {
        $gmina = $request->input('gmina', '');

        if (!$gmina) {
            return response()->json(['status' => 'empty']);
        }

        $accepted = Lead::where('gmina', $gmina)
            ->where('status', 'zaakceptowane')
            ->first();

        if ($accepted) {
            return response()->json([
                'status' => 'taken',
                'lead' => [
                    'name' => $accepted->name . ' ' . $accepted->surname,
                    'company' => $accepted->company,
                    'email' => $accepted->email,
                    'created_at' => $accepted->created_at->format('Y-m-d'),
                ],
            ]);
        }

        return response()->json(['status' => 'free']);
    }
}

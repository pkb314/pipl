<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public const STAGES = [
        'I próba kontaktu',
        'II próba kontaktu',
        'III próba kontaktu',
        'Zdecydował się',
    ];

    public function index(Request $request)
    {
        $query = Lead::with(['user', 'assignee']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                    ->orWhere('surname', 'ilike', "%{$search}%")
                    ->orWhere('company', 'ilike', "%{$search}%")
                    ->orWhere('email', 'ilike', "%{$search}%")
                    ->orWhere('gmina', 'ilike', "%{$search}%")
                    ->orWhere('phone', 'ilike', "%{$search}%")
                    ->orWhere('business_sector', 'ilike', "%{$search}%")
                    ->orWhere('nip', 'ilike', "%{$search}%");
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

        if ($source = $request->input('source')) {
            $query->where('source', $source);
        }

        if ($stage = $request->input('stage')) {
            $query->where('stage', $stage);
        }

        if ($request->input('mine')) {
            $query->where('assigned_to', auth()->id());
        }

        $leads = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        $wojewodztwa = DB::table('wojewodztwa')->orderBy('nazwa')->pluck('nazwa');
        $powiaty = DB::table('powiaty')->orderBy('nazwa')->pluck('nazwa');
        $gminy = DB::table('gminy')->orderBy('nazwa')->pluck('nazwa');

        return view('admin.leads', compact('leads', 'wojewodztwa', 'powiaty', 'gminy'));
    }

    public function show(Lead $lead)
    {
        $lead->load(['user', 'assignee', 'comments.user']);
        $handlowcy = User::whereIn('role', ['handlowiec', 'glowny_handlowiec'])->orderBy('name')->get();

        return view('admin.leads.show', compact('lead', 'handlowcy'));
    }

    public function updateLead(Request $request, Lead $lead)
    {
        $data = $request->validate([
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
            'motivation' => 'nullable|string|max:2000',
            'confidentiality' => 'nullable|string|max:2000',
            'conflicts' => 'nullable|string|max:2000',
            'why_you' => 'nullable|string|max:2000',
            'additional_info' => 'nullable|string|max:2000',
            'status' => 'required|in:zgłoszone,zaakceptowane,odrzucone',
            'stage' => 'nullable|in:' . implode(',', self::STAGES),
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $gminaRow = DB::table('gminy')
            ->join('powiaty', 'powiaty.id', '=', 'gminy.powiat_id')
            ->join('wojewodztwa', 'wojewodztwa.id', '=', 'powiaty.wojewodztwo_id')
            ->where('gminy.nazwa', $data['gmina'])
            ->select('powiaty.nazwa as powiat', 'wojewodztwa.nazwa as wojewodztwo')
            ->first();

        $data['powiat'] = $gminaRow?->powiat;
        $data['wojewodztwo'] = $gminaRow?->wojewodztwo;

        $lead->update($data);

        return back()->with('success', 'Zgłoszenie zostało zaktualizowane.');
    }

    public function addComment(Request $request, Lead $lead)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $lead->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->input('body'),
        ]);

        return back()->with('success', 'Komentarz został dodany.');
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:zgłoszone,zaakceptowane,odrzucone',
        ]);

        $lead->update(['status' => $request->input('status')]);

        return back()->with('success', "Status zgłoszenia {$lead->name} {$lead->surname} został zmieniony.");
    }

    public function assign(Request $request, Lead $lead)
    {
        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $lead->update(['assigned_to' => $request->input('assigned_to')]);

        return back()->with('success', 'Przypisanie zostało zaktualizowane.');
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

        $pending = Lead::where('gmina', $gmina)
            ->whereIn('status', ['zgłoszone', 'odrzucone'])
            ->get()
            ->map(fn($l) => [
                'name' => $l->name . ' ' . $l->surname,
                'company' => $l->company,
                'email' => $l->email,
                'status' => $l->status,
                'created_at' => $l->created_at->format('Y-m-d'),
            ]);

        return response()->json([
            'status' => 'free',
            'pending_count' => $pending->count(),
            'pending_leads' => $pending->values(),
        ]);
    }

    public function userList()
    {
        $users = User::orderByDesc('created_at')->get();

        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(6)],
            'role' => 'required|in:admin,handlowiec,glowny_handlowiec',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('admin.users')->with('success', 'Konto zostało utworzone.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::min(6)],
            'role' => 'required|in:admin,handlowiec,glowny_handlowiec',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'Konto zostało zaktualizowane.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Nie możesz usunąć własnego konta.');
        }

        $user->delete();

        return back()->with('success', 'Konto zostało usunięte.');
    }
}

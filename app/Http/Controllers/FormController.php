<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\Lead;
use App\Services\Bitrix24Service;
use App\Services\GoogleSheetsLeadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function submitToBitrix(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'gmina' => 'required|string|max:100',
            'gmina_reason' => 'required|string|max:2000',
            'phone' => 'required|string|min:9',
            'business_sector' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'knows_entrepreneurs' => 'required|string|max:2000',
            'own_business' => 'required|string|max:2000',
            'meeting_new_people' => 'required|string|max:2000',
            'organized_events' => 'required|string|max:2000',
            'handling_refusal' => 'required|string|max:2000',
            'local_government_contacts' => 'required|string|max:2000',
            'working_style' => 'required|string|max:2000',
            'weekly_time' => 'required|string|max:2000',
            'motivation' => 'required|array|min:1',
            'motivation.*' => 'string|max:200',
            'motivation_other' => 'nullable|string|max:500',
            'confidentiality' => 'required|string|max:2000',
            'conflicts' => 'required|string|max:2000',
            'why_you' => 'required|string|min:5|max:2000',
            'additional_info' => 'nullable|string|max:2000',
        ];

        $messages = [
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.email' => 'Wpisz poprawny adres e-mail (np. jan@firma.pl).',
            'name.required' => 'Podaj swoje imię.',
            'surname.required' => 'Podaj swoje nazwisko.',
            'gmina.required' => 'Podaj gminę.',
            'gmina_reason.required' => 'Napisz, dlaczego chcesz reprezentować właśnie tę gminę.',
            'phone.required' => 'Numer telefonu jest wymagany do kontaktu.',
            'phone.min' => 'Numer telefonu jest za krótki. Podaj co najmniej :min cyfr.',
            'business_sector.required' => 'Podaj branżę swojej firmy.',
            'nip.required' => 'Podaj NIP firmy.',
            'knows_entrepreneurs.required' => 'Odpowiedz na to pytanie.',
            'own_business.required' => 'Odpowiedz na to pytanie.',
            'meeting_new_people.required' => 'Odpowiedz na to pytanie.',
            'organized_events.required' => 'Odpowiedz na to pytanie.',
            'handling_refusal.required' => 'Odpowiedz na to pytanie.',
            'local_government_contacts.required' => 'Odpowiedz na to pytanie.',
            'working_style.required' => 'Odpowiedz na to pytanie.',
            'weekly_time.required' => 'Podaj, ile czasu możesz poświęcić na tę rolę.',
            'motivation.required' => 'Wybierz przynajmniej jedną odpowiedź.',
            'confidentiality.required' => 'Odpowiedz na to pytanie.',
            'conflicts.required' => 'Odpowiedz na to pytanie.',
            'why_you.required' => 'Napisz, dlaczego to właśnie Ty powinieneś/powinnaś zostać Koordynatorem Gminnym.',
            'why_you.min' => 'Odpowiedź powinna mieć co najmniej :min znaków (2–5 zdań).',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('formularz');
        }

        $validated = $validator->validated();

        $motivations = $validated['motivation'];
        if (!empty($validated['motivation_other'])) {
            $motivations[] = 'Inne: ' . $validated['motivation_other'];
        }
        $validated['motivation'] = implode(', ', $motivations);
        unset($validated['motivation_other']);

        $gminaRow = DB::table('gminy')
            ->join('powiaty', 'powiaty.id', '=', 'gminy.powiat_id')
            ->join('wojewodztwa', 'wojewodztwa.id', '=', 'powiaty.wojewodztwo_id')
            ->where('gminy.nazwa', $validated['gmina'])
            ->select('powiaty.nazwa as powiat', 'wojewodztwa.nazwa as wojewodztwo')
            ->first();

        $lead = Lead::create([
            ...$validated,
            'powiat' => $gminaRow?->powiat,
            'wojewodztwo' => $gminaRow?->wojewodztwo,
            'status' => 'zgłoszone',
        ]);

        $token = Str::random(40);

        Session::put('lead_data', $validated);
        Session::put('verification_token', $token);
        Session::put('lead_id', $lead->id);

        $url = route('verification.verify', ['token' => $token]);

        try {
            Mail::to($validated['email'])->send(new OtpMail($url));
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Nie udało się wysłać wiadomości e-mail. Sprawdź adres lub ustawienia SMTP.')
                ->withFragment('formularz');
        }

        return back()->with('email_sent', true)->withFragment('formularz');
    }

    public function verifyLink($token)
    {
        $sessionToken = Session::get('verification_token');
        $leadData = Session::get('lead_data');
        $leadId = Session::get('lead_id');

        if (!$sessionToken || $token !== $sessionToken || !$leadData) {
            return redirect('/')
                ->with('error', 'Link weryfikacyjny wygasł lub jest nieprawidłowy. Wypełnij formularz ponownie.')
                ->withFragment('formularz');
        }

        try {
            $contactId = app(Bitrix24Service::class)->useWebhook('crm')->createContact([
                'NAME' => $leadData['name'],
                'LAST_NAME' => $leadData['surname'],
                'EMAIL' => [['VALUE_TYPE' => 'WORK', 'VALUE' => $leadData['email']]],
                'PHONE' => [['VALUE_TYPE' => 'WORK', 'VALUE' => $leadData['phone']]],
            ]);

            app(Bitrix24Service::class)->useWebhook('crm')->addEntity([
                'categoryId' => 108,
                'contactId' => $contactId,
                'title' => 'Zgłoszenie z dnia ' . date('Y.m.d'),
                'ufCrm54_1768830552149' => $leadData['company'],
                'ufCrm54_1781878744225' => $leadData['adres'],
                'ufCrm54_1781878757270' => $leadData['gmina'],
            ], 1140);

            app(GoogleSheetsLeadService::class)->appendLead($leadData);

            if ($leadId) {
                Lead::where('id', $leadId)->update([
                    'status' => 'verified',
                    'bitrix_contact_id' => $contactId,
                    'verified_at' => now(),
                ]);
            }

            Session::forget(['lead_data', 'verification_token', 'lead_id']);

            return redirect('/')->with('success', 'Weryfikacja pomyślna!')->withFragment('formularz');
        } catch (\Exception $e) {
            if ($leadId) {
                Lead::where('id', $leadId)->update(['status' => 'failed']);
            }

            return redirect('/')
                ->with('error', 'Błąd przekazania zgłoszenia. Spróbuj później.')
                ->withFragment('formularz');
        }
    }
}

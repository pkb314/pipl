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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'company' => 'required|string|max:100',
            'adres' => 'required|string|max:255',
            'gmina' => 'required|string|max:100',
            'about' => 'nullable|string|max:2000',
            'email' => 'required|email',
            'phone' => 'required|string|min:9',
        ], [
            'name.required' => 'Podaj swoje imię.',
            'name.max' => 'Imię nie może być dłuższe niż :max znaków.',
            'surname.required' => 'Podaj swoje nazwisko.',
            'surname.max' => 'Nazwisko nie może być dłuższe niż :max znaków.',
            'company.required' => 'Nazwa firmy jest konieczna do zgłoszenia.',
            'company.max' => 'Nazwa firmy jest zbyt długa (max :max znaków).',
            'adres.required' => 'Podaj adres firmy.',
            'adres.max' => 'Adres jest zbyt długi (max :max znaków).',
            'gmina.required' => 'Podaj gminę.',
            'gmina.max' => 'Nazwa gminy jest zbyt długa (max :max znaków).',
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.email' => 'Wpisz poprawny adres e-mail (np. jan@firma.pl).',
            'phone.required' => 'Numer telefonu jest wymagany do kontaktu.',
            'phone.min' => 'Numer telefonu jest za krótki. Podaj co najmniej :min cyfr.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('formularz');
        }

        $validated = $validator->validated();

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

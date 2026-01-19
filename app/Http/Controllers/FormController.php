<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Services\Bitrix24Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function submitToBitrix(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'company' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|min:9',
        ], [
            'name.required' => 'Podaj swoje imię.',
            'name.max' => 'Imię nie może być dłuższe niż :max znaków.',
            'surname.required' => 'Podaj swoje nazwisko.',
            'surname.max' => 'Nazwisko nie może być dłuższe niż :max znaków.',
            'company.required' => 'Nazwa firmy jest konieczna do zgłoszenia.',
            'company.max' => 'Nazwa firmy jest zbyt długa (max :max znaków).',
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

        $otpCode = rand(100000, 999999);

        Session::put('lead_data', $validated);
        Session::put('otp_code', $otpCode);

        try {
            Mail::to($validated['email'])->send(new OtpMail($otpCode));
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Nie udało się wysłać maila. Sprawdź adres lub ustawienia SMTP.')
                ->withFragment('formularz');
        }

        return redirect()->route('otp.verify.page');
    }

    public function showVerifyPage()
    {
        if (!Session::has('lead_data')) {
            return redirect('/');
        }

        $email = Session::get('lead_data')['email'];
        return view('verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ], ['otp.required' => 'Wpisz kod otrzymany w mailu.']);

        $sessionOtp = Session::get('otp_code');
        $leadData = Session::get('lead_data');

        if (!$sessionOtp || !$leadData) {
            return redirect('/')
                ->with('error', 'Sesja wygasła. Wypełnij formularz ponownie.')
                ->withFragment('formularz');
        }

        if ($request->otp == $sessionOtp) {

            $contactId = app(Bitrix24Service::class)->useWebhook('crm')->createContact([
                'NAME' => $leadData['name'],
                'LAST_NAME' => $leadData['surname'],
                'EMAIL' => [['VALUE_TYPE' => 'WORK','VALUE' => $leadData['email']]],
                'PHONE' => [['VALUE_TYPE' => 'WORK','VALUE' => $leadData['phone']]],
            ]);

            app(Bitrix24Service::class)->useWebhook('crm')->addEntity([
                'categoryId' => 108,
                'contactId' => $contactId,
                'title' => 'Zgłoszenie z dnia ' . date('Y.m.d'),
                'ufCrm54_1768830552149' => $leadData['company'],
            ], 1140);

            Session::forget(['lead_data', 'otp_code']);

            return redirect('/')->with('success', 'Weryfikacja pomyślna! Skontaktujemy się z Tobą.')
                ->withFragment('formularz');

        } else {
            return back()->withErrors(['otp' => 'Błędny kod. Sprawdź maila i spróbuj ponownie.']);
        }
    }
}

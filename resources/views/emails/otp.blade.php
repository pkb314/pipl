<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weryfikacja Zgłoszenia - PIPL</title>
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }

        body { margin: 0; padding: 0; background-color: #F3F4F6; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background-color: #3F474F; padding: 30px 40px; text-align: center; }
        .content { padding: 40px; color: #333333; line-height: 1.6; }
        .button { background-color: #D71920; color: #ffffff !important; padding: 16px 32px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block; letter-spacing: 0.5px; }
        .footer { background-color: #F9FAFB; padding: 30px 40px; text-align: center; font-size: 12px; color: #6B7280; border-top: 1px solid #E5E7EB; }

        @media only screen and (max-width: 600px) {
            .content { padding: 20px; }
            .header { padding: 20px; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #F3F4F6;">

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #F3F4F6; padding: 20px 0;">
    <tr>
        <td align="center">

            <table border="0" cellpadding="0" cellspacing="0" class="container" style="width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 2px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">

                <tr>
                    <td height="4" style="background-color: #D71920; font-size: 0; line-height: 0;">&nbsp;</td>
                </tr>

                <tr>
                    <td class="header" style="background-color: #3F474F; padding: 30px 40px; text-align: center;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" style="color: #ffffff; font-family: 'Helvetica Neue', Arial, sans-serif;">
                                    <span style="display: block; font-size: 18px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">POLSKA IZBA</span>
                                    <span style="display: block; font-size: 12px; font-weight: 400; letter-spacing: 2px; text-transform: uppercase; color: #D1D5DB; margin-top: 4px;">Przedsiębiorców Lokalnych</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td class="content" style="padding: 40px 40px 20px 40px; color: #374151; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 16px; line-height: 1.6;">

                        <h2 style="margin: 0 0 20px 0; color: #111827; font-size: 22px; font-weight: 700;">Wymagana autoryzacja zgłoszenia</h2>

                        <p style="margin-bottom: 20px;">
                            Szanowny Przedsiębiorco,
                        </p>

                        <p style="margin-bottom: 20px;">
                            Otrzymaliśmy wniosek o kontakt i dołączenie do <strong>Polskiej Izby Przedsiębiorców Lokalnych</strong>. Aby zachować najwyższe standardy bezpieczeństwa i potwierdzić Twoją tożsamość, wymagana jest weryfikacja adresu e-mail.
                        </p>

                        <p style="margin-bottom: 30px;">
                            Kliknij poniższy przycisk, aby sfinalizować proces i przekazać Twoje zgłoszenie do odpowiedniego Koordynatora Regionalnego.
                        </p>

                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" style="padding: 10px 0 30px 0;">
                                    <a href="{{ $verificationUrl }}" class="button" style="background-color: #D71920; color: #ffffff; padding: 16px 32px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block; font-size: 15px; text-transform: uppercase;">
                                        Potwierdzam zgłoszenie
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="font-size: 14px; color: #6B7280; margin-top: 20px; border-top: 1px solid #E5E7EB; padding-top: 20px;">
                            <strong>Dlaczego otrzymujesz tę wiadomość?</strong><br>
                            Ten link jest aktywny przez 60 minut. Jeśli to nie Ty wypełniałeś formularz na stronie PIPL, prosimy o zignorowanie tej wiadomości – Twoje dane nie zostaną zapisane w systemie.
                        </p>
                    </td>
                </tr>

                <tr>
                    <td class="footer" style="background-color: #F9FAFB; padding: 30px 40px; text-align: center; font-size: 12px; color: #9CA3AF; border-top: 1px solid #E5E7EB;">
                        <p style="margin: 0 0 10px 0;">
                            &copy; {{ date('Y') }} Polska Izba Przedsiębiorców Lokalnych.<br>
                            Wszelkie prawa zastrzeżone.
                        </p>
                        <p style="margin: 0;">
                            Wiadomość wygenerowana automatycznie. Prosimy na nią nie odpowiadać.<br>
                            <a href="{{ $verificationUrl }}" style="color: #9CA3AF; text-decoration: underline;">Link nie działa? Kliknij tutaj</a>
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>

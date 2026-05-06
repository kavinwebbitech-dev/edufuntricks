<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f9; font-family: Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;">

        <tr style="background:#f8f9fa;">
            <td style="width:35%; font-weight:bold; color:#333;">Name</td>
            <td style="color:#555;">{{ $contact->name }}</td>
        </tr>

        <tr>
            <td style="font-weight:bold; color:#333;">Email</td>
            <td style="color:#555;">
                <a href="mailto:{{ $contact->email }}" style="color:#0d6efd; text-decoration:none;">
                    {{ $contact->email }}
                </a>
            </td>
        </tr>

        <tr style="background:#f8f9fa;">
            <td style="font-weight:bold; color:#333;">Subject</td>
            <td style="color:#555;">{{ $contact->subject }}</td>
        </tr>

        <tr>
            <td style="font-weight:bold; color:#333; vertical-align:top;">Message</td>
            <td style="color:#555; line-height:1.6;">
                {{ $contact->message ?? 'N/A' }}
            </td>
        </tr>

    </table>

</body>

</html>

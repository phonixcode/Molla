@component('mail::message')
# Enquiry Mail

Hello {{ config('app.name') }},<br><br>
My Name is {{ $details['f_name']}} {{ $details['l_name']}},<br>
{{ $details['message'] }}


Best regards,<br>
Team, {{ config('app.name') }}.
@endcomponent

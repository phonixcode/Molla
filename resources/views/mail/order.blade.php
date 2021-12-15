@component('mail::message')
# Order Confirmation Mail

Hello {{ $details['first_name'] }},<br>
Your order is successfully received.<br>
We would contact you soon as possible.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Best regards,<br>
Team, {{ config('app.name') }}.
@endcomponent

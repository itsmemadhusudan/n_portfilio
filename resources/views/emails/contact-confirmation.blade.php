<x-mail::message>
# Thanks, {{ $senderName }}

I received your message and will get back to you within 24–48 hours.

**Your subject:** {{ $subjectLine }}

**Your message:**  
{{ $bodyMessage }}

— Madhusudan Timalsina  
Backend Developer at Smart Sarks  
[{{ config('portfolio.seo.site_url') }}]({{ config('portfolio.seo.site_url') }})
</x-mail::message>

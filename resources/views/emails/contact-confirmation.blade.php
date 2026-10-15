<x-mail::message>
# Thanks, {{ $senderName }}

Thank you for getting in touch. I have received your message and will reply within 24–48 hours.

**Subject:** {{ $subjectLine }}

**Your message:**
{{ $bodyMessage }}

If you need to add anything in the meantime, simply reply to this email.

Best regards,  
Madhusudan Timalsina  
Backend Developer  
Lalitpur, Nepal

[{{ config('portfolio.seo.site_url') }}]({{ config('portfolio.seo.site_url') }})
</x-mail::message>

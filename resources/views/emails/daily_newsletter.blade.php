@component('mail::message')

{{-- ===== Custom Header with Logo ===== --}}
<div style="text-align: center; margin-bottom: 25px;">
    <img src="{{ asset('website/img/logo.png') }}" alt="NewsAI Logo" style="width: 140px; height: auto;">
</div>

{{-- ===== Newsletter Title ===== --}}
# {{ $newsletter->title }}

{{-- ===== Section Description ===== --}}
@if(!empty($newsletter->section_description))
<p style="font-size: 16px; color: #555;">
    {{ $newsletter->section_description }}
</p>
@endif

{{-- ===== News Items Loop ===== --}}
@foreach($newsItems as $item)
### {{ $item['title'] }}
<p style="font-size: 15px; color: #333;">
    {{ \Illuminate\Support\Str::limit($item['summary'] ?? '', 180) }}
</p>

[Read more]({{ $item['url'] }})

<p style="font-size: 13px; color: #777; margin-top: 5px;">
    <strong>Source:</strong> {{ $item['source'] ?? 'Unknown' }} • {{ $item['published_at'] ?? '' }}
</p>

@if(!empty($item['image']))
<br>
<img src="{{ $item['image'] }}" 
     alt="{{ \Illuminate\Support\Str::limit($item['title'], 60) }}" 
     style="max-width:100%; height:auto; border-radius:8px; margin-bottom:20px;">
@endif

---

@endforeach

{{-- ===== Footer ===== --}}
<p style="font-size: 15px; color: #444; margin-top: 30px;">
    Thanks,<br>
    <strong style="color:#0E9D48;">NewsAI Team</strong>
</p>

{{-- ===== Subcopy ===== --}}
@component('mail::subcopy')
To change email preferences or unsubscribe, visit your NewsAI account settings.
@endcomponent

@endcomponent

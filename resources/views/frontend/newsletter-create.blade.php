@extends('frontend.layouts.app')
@section('title', 'oneNews | Your World. Your News.')
@section('content')

<section class="newsletter-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">

                {{-- ✅ Success message --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form class="create-form" method="POST" action="{{ route('newsletter.store') }}">
                    @csrf

                    {{-- ✅ Newsletter Title --}}
                    <div class="field-group">
                        <p class="day-info">What do you want to call your newsletter?</p>
                        <textarea 
                            name="title" 
                            class="dashed-input title-input" 
                            placeholder="Newsletter name" 
                            maxlength="50" 
                            rows="1" 
                            style="height: 49px;">{{ old('title') }}</textarea>
                        <p class="char-count" translate="no">{{ strlen(old('title', '')) }}/50</p>
                        @error('title') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    {{-- ✅ Frequency Selection (Daily / Weekly) --}}
                    <div class="field-group">
                        <p class="day-info">How often do you want to receive your newsletter?</p>
                        <div class="day-buttons">
                            <select name="days" id="days" class="form-control" style="height:45px;">
                                <option value="">Select option</option>
                                <option value="daily" {{ old('days') == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ old('days') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            </select>
                        </div>
                        @error('days') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    {{-- ✅ Newsletter Section --}}
                    <div class="field-group section-header">
                        <p class="day-info">How do you want to structure your newsletter?</p>
                    </div>

                    <div class="field-group section-field-group">
                        <textarea 
                            name="section_name" 
                            class="dashed-input section-name-input" 
                            placeholder="Section name" 
                            maxlength="50" 
                            rows="1" 
                            style="height: 45px;">{{ old('section_name') }}</textarea>
                        <p class="char-count" translate="no">{{ strlen(old('section_name', '')) }}/50</p>
                        @error('section_name') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror

                        <textarea 
                            name="section_description" 
                            class="dashed-input section-description-input" 
                            placeholder="Section description" 
                            maxlength="500" 
                            rows="1" 
                            style="height: 37px;">{{ old('section_description') }}</textarea>
                        <p class="char-count" translate="no">{{ strlen(old('section_description', '')) }}/500</p>
                        @error('section_description') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    {{-- ✅ Submit Button --}}
                    <button type="submit" class="create-newsletter-button tight-gap">Create newsletter</button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ✅ Script Section --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    // ✅ Character Counter
    document.querySelectorAll(".dashed-input").forEach((textarea) => {
        const nextElem = textarea.nextElementSibling;
        if (nextElem && nextElem.classList.contains("char-count")) {
            const maxLength = textarea.getAttribute("maxlength");
            textarea.addEventListener("input", () => {
                const length = textarea.value.length;
                nextElem.textContent = `${length}/${maxLength}`;
            });
        }
    });
});
</script>

@endsection

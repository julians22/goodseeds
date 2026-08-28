<style>
    .note-title h1,
    .note-title h2,
    .note-title h3,
    .note-title h4,
    .note-title h5,
    .note-title h6 {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>

<div style="
    background-color: {{ $backgroundColor ?? '#f1ebff' }}; 
    border-radius: {{ $borderRadius ?? 12 }}px; 
    padding: {{ $padding ?? 16 }}px; 
    border: 1px solid #e5e7eb; 
    margin: 16px 0;
">
    @if (!empty($title) && trim(strip_tags($title)) !== '')
        <div class="note-title" style="margin-bottom: 8px; text-align: left !important;">
            {!! $title !!}
        </div>
    @endif

    @if (!empty($content))
        <div class="note-content" style="text-align: left !important;">
            {!! $content !!}
        </div>
    @endif
</div>
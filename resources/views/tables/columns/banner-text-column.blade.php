<div>
    @php
        $formattedText = "";
        // Get the column value
        $value = $getState() ?? [];
        foreach ($value as $key => $value) {
            $word = $value['word'];
            $color = $value['color'];

            $formattedText .= "<span style='color: $color'>$word</span> ";
        }
    @endphp

    {{-- Display the formatted text --}}
    <div>{!! $formattedText !!}</div>
</div>

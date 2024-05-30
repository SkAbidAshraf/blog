@props(['textColor', 'bgColor'])
@php
    if($textColor == null){
        $textColor = 'blue';
    }
    if($bgColor == null){
        $bgColor = 'lightblue';
    }
    if($bgColor == $textColor){
        $bgColor = 'white';
        $textColor = 'black';
    }
@endphp
<div>
    <button {{$attributes}} class="rounded-full px-3 py-1 border border-gray-200" style="color: {{$textColor}}; background-color:{{$bgColor}}">
        {{ $slot}}
    </button>
</div>

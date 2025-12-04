@props([
    'type'=>'text',
    'name'=>'',
    'value'=>'',
    'label'=>false,
])
@php
    $errorKey = str_replace(['[', ']'], ['.', ''], $name);
    $errorKey = str_replace('..', '.', $errorKey);
    $errorKey = rtrim($errorKey, '.');
@endphp
@if($label)
<label for="{{ $name }}">{{ $label }}</label>
@endif
<input type="{{ $type }}" name="{{ $name }}" :id="$name"
    value="{{old($name,$value)}}" 
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($errorKey)
    ]) }} 
>

    @error($errorKey)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
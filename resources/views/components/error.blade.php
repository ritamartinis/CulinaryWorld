@props(['name'])

@error($name)
    <p class="text-danger small mt-1">{{ $message }}</p>
@enderror

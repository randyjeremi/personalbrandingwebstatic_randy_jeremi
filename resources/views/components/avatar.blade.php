{{-- Foto profil. Jika public/images/profile.jpg belum ada, tampilkan inisial. --}}
@props(['size' => 'md'])

@php $photo = config('site.photo'); @endphp

<span {{ $attributes->merge(['class' => "avatar avatar--{$size}"]) }}>
    @if ($photo && file_exists(public_path($photo)))
        <img src="{{ asset($photo) }}" alt="Foto {{ config('site.name') }}">
    @else
        <span class="avatar__initials" role="img" aria-label="Avatar {{ config('site.name') }}">{{ config('site.initials') }}</span>
    @endif
</span>

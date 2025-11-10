@extends('layouts.visit')

@section('content')
<section class="min-h-screen flex flex-col items-center justify-center py-10 relative bg-gray-100">
    {{-- Fondo personalizado --}}
    <div class="absolute inset-0 bg-gradient-to-b from-pink-100 to-pink-200 -z-10"></div>

    {{-- Contenedor del contenido --}}
    <div class="w-full max-w-md text-center bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8">
        {{-- Foto del perfil --}}
        <img
            src="{{ asset('storage/' . $user->profile->profile_photo) }}"
            alt="{{ $user->name }}"
            class="h-80 w-80 rounded-full object-cover mx-auto shadow-lg mb-4">

        {{-- Nombre --}}
        <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>

        {{-- Links --}}
        <div class="mt-6 space-y-4">
            @forelse ($user->profile->link as $link)
                @if($link->adult_content)
                    <button
                        class="block w-full bg-indigo-600 text-white font-semibold py-3 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors adult-link"
                        data-url="{{ $link->url }}">
                        {{ $link->title }}
                        <span class="text-red-400 ml-2 text-sm">+18</span>
                    </button>
                @else
                    <a
                        href="{{ $link->url }}"
                        target="_blank"
                        class="block w-full bg-indigo-600 text-white font-semibold py-3 rounded-xl shadow-sm hover:bg-indigo-700 transition-colors">
                        {{ $link->title }}
                    </a>
                @endif
            @empty
                <p class="text-gray-500 text-sm">Este usuario aún no tiene links públicos.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Modal de advertencia para contenido adulto --}}
<div id="adultModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-11/12 max-w-sm p-6 text-center">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Advertencia</h3>
        <p class="text-gray-600 mb-6">
            Este contenido es solo para mayores de edad (+18).  
            ¿Deseas continuar?
        </p>
        <div class="flex justify-center gap-4">
            <button id="exitBtn" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Salir</button>
            <button id="continueBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Seguir</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const adultLinks = document.querySelectorAll('.adult-link');
        const modal = document.getElementById('adultModal');
        const exitBtn = document.getElementById('exitBtn');
        const continueBtn = document.getElementById('continueBtn');
        let currentUrl = null;

        adultLinks.forEach(link => {
            link.addEventListener('click', () => {
                currentUrl = link.dataset.url;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        exitBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentUrl = null;
        });

        continueBtn.addEventListener('click', () => {
            if (currentUrl) {
                window.open(currentUrl, '_blank');
            }
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    });
</script>
@endsection

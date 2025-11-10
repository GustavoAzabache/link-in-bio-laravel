@extends('layouts.app')

@section('content')

<section class="bg-gray-50 min-h-screen py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 md:items-start">

            {{-- Perfil --}}
            <div class="flex flex-col items-center">
                <div class="w-full max-w-md mx-auto overflow-hidden rounded-2xl shadow-lg">
                    <div class="h-[350px] sm:h-[450px] w-full overflow-hidden rounded-2xl">
                        <img
                            src="{{ asset('storage/' . $user->profile->profile_photo) }}"
                            alt="{{ $user->name }}"
                            class="h-full w-full object-cover object-center transition-transform duration-300 hover:scale-105">
                    </div>
                </div>

                <div class="mt-5 text-center space-y-3 w-full max-w-md relative">
                    {{-- Nombre + botón editar --}}
                    <div class="flex items-center justify-center relative">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>

                        {{-- Botón de editar perfil --}}
                        <button
                            id="editProfileBtn"
                            class="absolute right-0 p-2 rounded-lg text-gray-500 hover:text-indigo-600 transition"
                            title="Editar perfil">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487a2.121 2.121 0 013 3L7.5 19.849l-4 1 1-4L16.862 4.487z" />
                            </svg>
                        </button>

                        {{-- Modal para editar perfil --}}
                        <div id="editProfileModal"
                            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                            <div class="bg-white rounded-2xl shadow-lg w-11/12 max-w-md p-6 relative">

                                {{-- Botón para cerrar --}}
                                <button id="closeEditModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Editar Perfil</h2>

                                <form action="{{ route('update.user') }}" method="POST" enctype="multipart/form-data"
                                    class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    {{-- Nombre --}}
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ $user->name }}"
                                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>

                                    {{-- Foto de perfil --}}
                                    <div>
                                        <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-1">
                                            Foto de perfil
                                        </label>

                                        <input 
                                            type="file" 
                                            name="profile_photo" 
                                            id="profile_photo" 
                                            accept="image/*"
                                            class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:ring-[#13c5ed] focus:border-[#13c5ed]"
                                            onchange="validateFileSize(this)"
                                        >

                                        <p class="text-xs text-gray-500 mt-1">
                                            Formatos permitidos: JPG, PNG (máx. 2MB)
                                        </p>
                                    </div>

                                    <script>
                                    function validateFileSize(input) {
                                        const file = input.files[0];
                                        if (file && file.size > 2 * 1024 * 1024) {
                                            alert("El archivo excede el límite de 2 MB. Por favor, selecciona una imagen más pequeña.");
                                            input.value = "";
                                        }
                                    }
                                    </script>

                                    {{-- Botón de enviar --}}
                                    <div class="pt-4 flex justify-end">
                                        <button type="submit"
                                            class="bg-indigo-600 text-white font-medium px-4 py-2 rounded-lg hover:bg-indigo-700 transition-all">
                                            Guardar cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Script para abrir/cerrar modal --}}
                        <script>
                            const editBtn = document.getElementById('editProfileBtn');
                            const editModal = document.getElementById('editProfileModal');
                            const closeEditModal = document.getElementById('closeEditModal');

                            editBtn.addEventListener('click', () => {
                                editModal.classList.remove('hidden');
                                editModal.classList.add('flex');
                            });

                            closeEditModal.addEventListener('click', () => {
                                editModal.classList.add('hidden');
                                editModal.classList.remove('flex');
                            });

                            // Cerrar modal al hacer clic fuera del contenido
                            editModal.addEventListener('click', (e) => {
                                if (e.target === editModal) {
                                    editModal.classList.add('hidden');
                                    editModal.classList.remove('flex');
                                }
                            });
                        </script>

                    </div>

                    {{-- Contenedor de botones --}}
                    <div class="flex justify-center gap-3 mt-5">
                        {{-- Botón: Ver como visitante --}}
                        <a
                            href="{{ route('follower.view', $user->name) }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium shadow-sm hover:bg-gray-300 transition-all focus:ring-2 focus:ring-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Ver como seguidor
                        </a>

                        {{-- Botón: Comparte tu link --}}
                        <button
                            onclick="copyProfileLink('{{ $user->name }}')"
                            class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm hover:bg-indigo-700 transition-all focus:ring-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 12v8a2 2 0 002 2h12a2 2 0 002-2v-8M16 6l-4-4m0 0L8 6m4-4v16" />
                            </svg>
                            Comparte tu link
                        </button>
                    </div>


                    <p id="copyMessage" class="text-sm text-green-600 hidden mt-2">¡Link copiado!</p>

                    <script>
                        function copyProfileLink(username) {
                            const baseUrl = window.location.origin;
                            const fullUrl = `${baseUrl}/${username}`;
                            
                            navigator.clipboard.writeText(fullUrl).then(() => {
                                const message = document.getElementById('copyMessage');
                                message.classList.remove('hidden');
                                setTimeout(() => message.classList.add('hidden'), 2000);
                            }).catch(err => {
                                console.error('Error al copiar el link:', err);
                            });
                        }
                    </script>
                </div>
            </div>


            {{-- Links --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-3xl font-bold text-gray-800 border-b-2 border-indigo-500 inline-block pb-1">
                        Tus links
                    </h3>

                    <div x-data="{ openModal: false }" class="relative">
                        <!-- Botón para abrir el modal -->
                        <button
                            @click="openModal = true"
                            class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all">
                            <span class="text-lg font-bold">+</span>
                            Agregar nuevo link
                        </button>

                        <!-- Modal Crear Link -->
                        <div
                            x-show="openModal"
                            x-cloak
                            class="fixed inset-0 z-50 grid place-content-center bg-black/50 p-4"
                            role="dialog"
                            aria-modal="true"
                            aria-labelledby="modalTitle">

                            <div
                                @click.away="openModal = false"
                                class="w-full max-w-2xl rounded-lg bg-white p-8 shadow-lg transition-all">

                                <h2 id="modalTitle" class="text-xl font-bold text-gray-900 sm:text-2xl">
                                    Agregar nuevo link
                                </h2>

                                <form action="{{ route('create.link') }}" method="POST" class="mt-4 space-y-4">
                                    @csrf

                                    <!-- Campo título -->
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                                        <input
                                            type="text"
                                            id="title"
                                            name="title"
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Ejemplo: Mi canal de YouTube"
                                            required>
                                        @error('title')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Campo URL -->
                                    <div>
                                        <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                                        <input
                                            type="url"
                                            id="url"
                                            name="url"
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="https://..."
                                            required>
                                        @error('url')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <fieldset>
                                            <div class="flex flex-col items-start gap-3">
                                                <label for="adult_content" class="inline-flex items-center gap-3">
                                                    <input type="checkbox" name="adult_content" class="size-5 rounded border-gray-300 shadow-sm" id="adult_content" value="1">

                                                    <span class="font-medium text-gray-700"> Contenido Adulto </span>
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <!-- Footer -->
                                    <footer class="mt-6 flex justify-end gap-2">
                                        <button
                                            type="button"
                                            @click="openModal = false"
                                            class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200">
                                            Cancelar
                                        </button>

                                        <button
                                            type="submit"
                                            class="rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-indigo-700">
                                            Guardar
                                        </button>
                                    </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @forelse ($user->profile->link as $link)
                <div x-data="{ editModal: false, deleteModal: false }">
                    <article class="flex items-center justify-between rounded-xl border border-gray-100 bg-white p-6 mb-4 shadow-sm hover:shadow-md transition-all">

                        {{-- Información del link --}}
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-sm text-gray-500 flex items-center gap-2">
                                    {{ $link->title }}
                                    @if($link->adult_content)
                                    <span class="text-red-600 font-semibold text-xs">+18</span>
                                    @endif
                                </p>
                                <p class="text-lg font-medium text-indigo-600 hover:text-indigo-800">
                                    <a href="{{ $link->url }}" target="_blank" class="underline underline-offset-2">
                                        Visitar
                                    </a>
                                </p>
                            </div>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="flex items-center gap-2">
                            {{-- Editar --}}
                            <button
                                @click="editModal = true"
                                class="inline-flex items-center justify-center p-2 rounded-lg text-blue-600 hover:bg-blue-50 hover:text-blue-700 transition"
                                title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487a2.121 2.121 0 013 3L7.5 19.849l-4 1 1-4L16.862 4.487z" />
                                </svg>
                            </button>

                            {{-- Eliminar --}}
                            <button
                                @click="deleteModal = true"
                                class="inline-flex items-center justify-center p-2 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-700 transition"
                                title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </article>

                    {{-- Modal Editar --}}
                    <div
                        x-show="editModal"
                        x-cloak
                        class="fixed inset-0 z-50 grid place-content-center bg-black/50 p-4"
                        role="dialog"
                        aria-modal="true">

                        <div
                            @click.away="editModal = false"
                            class="w-full max-w-2xl rounded-lg bg-white p-8 shadow-lg transition-all">

                            <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">
                                Editar link
                            </h2>

                            <form method="POST" action="{{ route('update.link', $link->id) }}" class="mt-4 space-y-4">
                                @csrf
                                @method('PUT')

                                <!-- Campo título -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                                    <input
                                        type="text"
                                        id="title"
                                        name="title"
                                        value="{{ $link->title }}"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>

                                <!-- Campo URL -->
                                <div>
                                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                                    <input
                                        type="url"
                                        id="url"
                                        name="url"
                                        value="{{ $link->url }}"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>

                                <!-- Checkbox contenido adulto -->
                                <div>
                                    <label class="inline-flex items-center gap-2">
                                        <input
                                            type="checkbox"
                                            name="adult_content"
                                            value="1"
                                            class="rounded border-gray-300 shadow-sm"
                                            {{ $link->adult_content ? 'checked' : '' }}>
                                        <span class="text-gray-700">Contenido adulto</span>
                                    </label>
                                </div>

                                <!-- Footer -->
                                <footer class="mt-6 flex justify-end gap-2">
                                    <button
                                        type="button"
                                        @click="editModal = false"
                                        class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                                        Cancelar
                                    </button>

                                    <button
                                        type="submit"
                                        class="rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                                        Guardar cambios
                                    </button>
                                </footer>
                            </form>
                        </div>
                    </div>

                    {{-- Modal Eliminar --}}
                    <div
                        x-show="deleteModal"
                        x-cloak
                        class="fixed inset-0 z-50 grid place-content-center bg-black/50 p-4"
                        role="dialog"
                        aria-modal="true">

                        <div
                            @click.away="deleteModal = false"
                            class="w-full max-w-md rounded-lg bg-white p-8 shadow-lg transition-all text-center">

                            <h2 class="text-xl font-bold text-gray-900">
                                ¿Estás seguro de eliminar este link?
                            </h2>
                            <p class="text-gray-600 mt-2 mb-6">
                                Esta acción no se puede deshacer.
                            </p>

                            <form method="POST" action="{{ route('delete.link', $link->id) }}" class="mt-4 space-y-4">
                                @csrf
                                @method('DELETE')

                                <footer class="flex justify-center gap-3">
                                    <button
                                        type="button"
                                        @click="deleteModal = false"
                                        class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                                        Cancelar
                                    </button>

                                    <button
                                        type="submit"
                                        class="rounded bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                                        Eliminar
                                    </button>
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm mt-4">Aún no tienes links creados.</p>
                @endforelse

            </div>
        </div>
    </div>
</section>

@endsection
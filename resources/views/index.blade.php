@extends('layouts.app')

@section('content')

<section>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-center md:gap-8">
            <div>
                <div class="max-w-prose md:max-w-none">
                    <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                        Crea tu perfil y comparte todos tus enlaces en un solo lugar
                    </h2>

                    <p class="mt-4 text-pretty text-gray-700">
                        My Bio Link te permite reunir todos tus enlaces: redes sociales, proyectos, portafolio o tiendas,
                        en una sola página personalizable. Comparte tu link con tus seguidores y haz que encuentren todo sobre ti en segundos.  
                    </p>
                    
                </div>
            </div>

            <div>
                <img 
                    src="https://images.unsplash.com/photo-1731690415686-e68f78e2b5bd?auto=format&fit=crop&q=80&w=1160"
                    class="rounded" 
                    alt="Person sharing links online"
                >
            </div>
        </div>
    </div>
</section>

@endsection

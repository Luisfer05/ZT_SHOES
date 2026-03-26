<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">ZT | SHOES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Categoria</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tienda</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Registrarse</a></li>

                <li class="nav-item dropdown">
                    @auth
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->name}}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('perfil.pedidos')}}">
                            <i class="bi bi-box-seam me-1"></i> Mis pedidos
                        </a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{route('perfil.edit')}}">
                            <i class="bi bi-person me-1"></i> Mi perfil
                        </a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    @endauth
                </li>
            </ul>

            {{-- Carrito: usa la clave correcta según si está autenticado o no --}}
            @php
                $carritoKey = auth()->check() ? 'carrito_' . auth()->id() : 'carrito_guest';
                $carritoCount = array_sum(array_column(session($carritoKey, []), 'cantidad'));
            @endphp
            <a href="{{route('carrito.mostrar')}}" class="btn btn-outline-dark">
                <i class="bi-cart-fill me-1"></i>
                Carrito
                <span class="badge bg-dark text-white ms-1 rounded-pill">
                    {{ $carritoCount }}
                </span>
            </a>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?sec=home"><h1 class="fs-4">Giully</h1></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?sec=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=quienesSomos">¿Quienes somos?</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productosDropdown" role="button" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productosDropdown">
                        <li><a class="dropdown-item" href="index.php?sec=Bolsos">Bolsos</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=Ropa">Ropa</a></li>
                        <li><a class="dropdown-item" href="index.php?sec=Zapatos">Zapatos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=giully">Giully</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=contacto">Contáctanos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=carrito">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=log_in">Mi Cuenta</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }
</style>
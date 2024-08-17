<!-- navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: var(--secondary-color);">
    <div class="container-fluid">
        <a class="navbar-brand me-3" href="#">
            <img src="{{ asset('assets/image_asset/logo.png') }}" alt="Mind Matrix" height="30">
            Mind Matrix
        </a>
        <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <form class="d-flex" role="search">
                <button type="button" class="btn btn-outline-primary ms-3" data-bs-toggle="modal"
                    data-bs-target="#Login" style="color: var(--primary-color); border-color: var(--primary-color);">
                    Login
                </button>
            </form>
        </div>
    </div>
</nav>
<!-- endnav -->

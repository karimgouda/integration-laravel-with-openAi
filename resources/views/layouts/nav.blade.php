<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid mx-3">
        <a class="navbar-brand" href="/">
            Gouda Ai
            <i class="fa-brands fa-rocketchat mx-1"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('posts.create')}}">Chat to Gouda Ai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('setting.create')}}">Settings</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

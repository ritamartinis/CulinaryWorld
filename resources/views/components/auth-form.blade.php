<div class="vh-100 d-flex align-items-center">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{ asset('storage/logo.png') }}" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    {{ $slot }}
                </form>
            </div>
        </div>
    </div>
</div>

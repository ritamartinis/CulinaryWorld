<div class="col-md-3">
    <a href="{{ $link }}" class="text-decoration-none">
        <div class="best-card mb-4" style="background-image: url('{{ asset('storage/' . $image) }}');">
            <div class="best-overlay">
                <h5 class="best-title">{{ $title }}</h5>
                {{ $slot }}
            </div>
        </div>
    </a>
</div>

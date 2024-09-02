@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-light">Recipes</h2>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRecipeModal">Add Recipe</a>
        </div>
        <div class="row g-3">
            @foreach ($recipes as $recipe)
                <div class="col-md-3">
                    <div class="card h-100">
                        <a href="{{ route('recipe', $recipe->id) }}">
                            <img src="{{ asset('storage/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->title }}" style="height: 300px; object-fit: cover;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">Category: {{ $recipe->category->name }}</p>
                            <div class="mt-auto">
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editRecipeModal{{ $recipe->id }}">Edit</a>
                                <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <x-recipe-modal id="editRecipeModal{{ $recipe->id }}" title="Edit Recipe" :recipe="$recipe" :categories="$categories" />
                    @endforeach
                </div>
        
                <div class="d-flex justify-content-end mt-4">
                    @include('components.pagination', ['paginator' => $recipes])
                </div>
            </div>

    <x-recipe-modal id="addRecipeModal" title="Add Recipe" :categories="$categories" />

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = new FormData(this);

                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Fechar o modal
                        form.closest('.modal').modal('hide');
                        // Exibir a mensagem de sucesso se recebida
                        if (response.success) {
                            showAlert('success', response.success);
                        }
                        // Redirecionar para a página de receitas para exibir a mensagem de sucesso
                        setTimeout(function() {
                            window.location.href = "{{ route('admin.recipes') }}";
                        }, 2000);
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            form.find('.is-invalid').removeClass('is-invalid');
                            form.find('.invalid-feedback').remove();

                            $.each(errors, function(field, messages) {
                                var input = form.find('[name=' + field + ']');
                                input.addClass('is-invalid');
                                $.each(messages, function(_, message) {
                                    input.after('<div class="invalid-feedback">' + message + '</div>');
                                });
                            });
                        }
                    }
                });
            });

            $('.modal').on('hidden.bs.modal', function () {
                var form = $(this).find('form')[0];
                if (form) {
                    form.reset();
                    $(form).find('.is-invalid').removeClass('is-invalid');
                    $(form).find('.invalid-feedback').remove();
                }
            });

            function showAlert(type, message) {
                var alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                $('.position-fixed').prepend(alertHtml);
                setTimeout(function() {
                    $('.alert').alert('close');
                }, 5000); // Auto close alert after 5 seconds
            }
        });
    </script>
@endpush

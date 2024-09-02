@props(['comment'])

<div class="bg-gray-500 p-4 rounded-lg shadow mt-4 mx-auto" style="max-width: 700px;">
    
    <article class="d-flex align-items-start space-x-4">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="" width="60" height="60" class="rounded-circle">
        </div>
        <div class="ms-3">
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->user->name }}</h3>
                <p class="text-sm">Posted <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time></p>
                @if ($comment->rating)
                    <div class="text-yellow-500">
                        @for ($i = 0; $i < $comment->rating; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @for ($i = $comment->rating; $i < 5; $i++)
                            <i class="far fa-star"></i>
                        @endfor
                    </div>
                @endif
            </header>
            <p>{{ $comment->body }}</p>
        </div>
    </article>
</div>

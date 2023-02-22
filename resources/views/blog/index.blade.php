<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaravelCourse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</head>

<body class="bg-secondary bg-opacity-10">
    <div class="container">
        <div class="text-center py-2">
            <h1 class="display-3 fw-bold">All Articles</h1>
            <hr class="my-5">
        </div>
        @if (Auth::user())
            <div>
                <a href="{{ route('blog.create') }}" class="btn btn-success position-relative rounded-pill">New
                    Article</a>
            </div>
        @endif

        @if (session()->has('message'))
            <div class="alert alert-danger text-center my-5" role="alert">
                Warning
                <br>
                <div class="text-dark fw-bold">{{ session()->get('message') }}</div>
            </div>
        @endif

        @foreach ($posts as $post)
            <div class="bg-white rounded">
                <div class="pb-3 pt-2 px-2 m-5">
                    <h2 class="my-3">
                        <a href="{{ route('blog.show', $post->id) }}" style="text-decoration: none" class="text-dark"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="http://127.0.0.1:8000/blog/id">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="my-4">
                        {{ $post->body }}
                    </p>
                    <span class="fs-5 my-3">
                        Made by:
                        <a href="{{ $post->image_path }}" class="link-info" style="text-decoration: none">
                            {{ $post->user->name }}
                        </a>
                        on {{ $post->updated_at->format('d/m/Y') }}
                    </span>
                    @if (Auth::id() === $post->user->id)
                        <div class="mt-2">
                            <a href="{{ route('blog.edit', $post->id) }}" style="text-decoration: none"
                                class=" text-success fw-bold fs-5">Edit</a>
                        </div>
                        <form action="{{ route('blog.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-3">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="container">
            {{ $posts->links() }}
        </div>
    </div>

</body>

</html>

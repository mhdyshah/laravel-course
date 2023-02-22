<html>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="text-center pt-20">
            <h1 class="text-dark fw-bold my-4">
                Edit {{ $post->title }}
            </h1>
            <hr class="my-5">
        </div>

        <div class="pb-3">
            @if ($errors->any())
                <div class="bg-danger text-white fw-bold py-3 text-center">
                    something went wrong...
                </div>
                <ul class=" list-group">
                    @foreach ($errors->all() as $error)
                        <li class="bg-danger bg-opacity-25 list-group-item">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <form class="row g-3" action="{{ route('blog.update', $post->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            {{-- "name" is importani --}}
            <div class="col-12">
                <label for="title" class="form-label display-5 fs-4">Title...</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}">
            </div>
            <div class="col-12">
                <label for="excerpt" class="form-label display-5 fs-4">Excerpt...</label>
                <input type="text" class="form-control" id="excerpt" name="excerpt" value="{{ $post->excerpt }}">
            </div>
            <div class="col-12">
                <label for="min_to_read" class="form-label display-5 fs-4">Minutes To Read</label>
                <input type="number" class="form-control" id="min_to_read" name="min_to_read"
                    value="{{ $post->min_to_read }}">
            </div>
            <div class="mb-3">
                <label for="body" class="form-label display-5 fs-4">Body...</label>
                <textarea name="body" class="form-control" id="body" rows="3">{{ $post->body }}</textarea>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" {{ $post->is_published === true ? 'checked' : '' }} type="checkbox"
                        id="is_published" name="is_published">
                    <label class="form-check-label display-5 fs-5 fw-bold" for="is_published">
                        Is Published
                    </label>
                </div>
            </div>
            <div class="my-5">
                <label for="formFile" class="form-label display-5 fs-5">Select File</label>
                <input class="form-control" type="file" name="image_path" id="formFile">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit Form</button>
            </div>
        </form>
</body>

</html>

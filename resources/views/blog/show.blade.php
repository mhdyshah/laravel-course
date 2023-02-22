<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>LaravelCourse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    {{-- {{ $post }} --}}
    <div class="container">
        <div class="my-3">
            <a href="{{ URL::previous() }}" class="text-success fw-bold" style="text-decoration: none">
                <i class="bi bi-arrow-left pe-2"></i>Back to previous page </a>
        </div>

        <h4 class="text-center fs-2 fw-bold my-5">
            {{ $post->title }}
        </h4>

        <div class="my-5">
            <span class=" my-3">
                Made by:
                <a href="#" class="link-success fw-bold" style="text-decoration: none">
                    MhdyShah
                </a>
                {{ $post->created_at }}
            </span>
        </div>
        <div>
            <p class="fw-bold fs-5">
                {{ $post->excerpt }}
            </p>

            <p class="mt-4">
                {{ $post->body }}
            </p>
        </div>
    </div>
</body>

</html>

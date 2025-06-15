{{-- resources/views/quizzes/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <h1>{{ $quiz->title }}</h1>
        <h2>Questions</h2>
        <ul>
            @foreach($quiz->questions as $question)
                <li>{{ $question->question_text }}</li>
            @endforeach
        </ul>
        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Back to Quizzes</a>
        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-warning">Edit Quiz</a>
    </div>
</body>
</html>
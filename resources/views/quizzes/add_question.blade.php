{{-- resources/views/quizzes/add_question.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h1>Add Question to Quiz: {{ $quiz->title }}</h1>
        <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" name="question_text" id="question" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Question</button>
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Back to Quizzes</a>
        </form>
    </div>
</body>

</html>
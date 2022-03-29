<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container  w-50 pt-3">
    <h1>Сгенерировать ссылку</h1>
    <form action="{{route('create')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="link">Ссылка</label>
            <input name="link" type="text" class="form-control" id="link" placeholder="example https://domain.com">
            <span class="text-danger">{{ $errors->first('link') }}</span>
        </div>
        <div class="form-group">
            <label for="limit">Лимит переходов</label>
            <input name="limit" type="text" class="form-control" id="limit" placeholder="0 - безлимит">
            <span class="text-danger">{{ $errors->first('limit') }}</span>
        </div>
        <div class="form-group">
            <label for="time">Время жизни</label>
            <input name="time" type="text" class="form-control" id="time" placeholder="время жизни max - 24 часа">
            <span class="text-danger">{{ $errors->first('time') }}</span>
        </div>
        <button type="submit" class="btn btn-info m-3">Создать</button>
    </form>
</div>

@if(session()->has('shortUrl'))
    <div class="alert alert-success">
        <a href="{{route('redirect', session()->get('token'))}}" >Перейти - {{session()->get('shortUrl')}}</a>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>

</body>
</html>

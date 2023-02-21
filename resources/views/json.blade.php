<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Json</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    <style>

    </style>
</head>
@if(\Illuminate\Support\Facades\Session::has('success'))
    <h1 style="color: green">{!! \Session::get('success') !!}</h1>

@endif
@if($errors->any())
    <h1 style="color: red">{{$errors->first()}}</h1>
@endif
<body class="antialiased">
<div class="new-json flex-wrap">
    Добавление JSON
    <form action="{{url('json/add')}}" method="POST">
        @csrf
        <label>
            Выбирете пользователя:
            <select name="user" id="user">
                @foreach(\App\Models\ProjectUser::all() as $projectUser)
                    <option value="{{$projectUser->id}}">{{ $projectUser->name }}</option>
                @endforeach
            </select>
        </label>
        <label>Add your json:
            <input name="json" type="text" placeholder="Print your json here" required>
        </label>
        <label>Add your token:
            <input name="token" type="text" placeholder="Print your token here" required>
        </label>
        <button type="submit">Add json</button>
    </form>
</div>
<hr>
<div class="new-json flex-wrap">
    Обновление JSON
    <form action="{{url('json/update')}}" method="POST">
        @csrf
        <label>
            Выбирете пользователя:
            <select name="user" id="user">
                @foreach(\App\Models\ProjectUser::all() as $projectUser)
                    <option value="{{$projectUser->id}}">{{ $projectUser->name }}</option>
                @endforeach
            </select>
        </label>
        <label>Add your json ID:
            <input name="jsonId" type="text" placeholder="Print your json ID here" required>
        </label>
        <label>Add your code to execute:
            <input name="code" type="text" placeholder="Print your json here" required>
        </label>
        <label>Add your token:
            <input name="token" type="text" placeholder="Print your token here" required>
        </label>
        <button type="submit">Update json</button>
    </form>
</div>
<hr>
<br>
<label>CRUD Json</label>
<table class="table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">created by</th>
        <th scope="col">created at</th>
        <th scope="col">action</th>
    </tr>
    </thead>
    <tbody>
    @foreach(\App\Models\JsonModel::all() as $jsonModel)
        <tr>
            <th scope="row">{{ $jsonModel->id }}</th>
            <td>{{ $jsonModel->user->name }}</td>
            <td>{{ $jsonModel->created_at }}</td>
            <td><a href="{{ route('getJson', [$jsonModel]) }}">READ</a> | <a href="{{ route('deleteJson', [$jsonModel]) }}">DELETE</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

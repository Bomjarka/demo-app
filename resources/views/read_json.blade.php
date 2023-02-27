<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Json</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <style>
        li:hover {
            color: green;
        }
    </style>
</head>
@if(\Illuminate\Support\Facades\Session::has('success'))
    <h1 style="color: green">{!! \Session::get('success') !!}</h1>{

@endif
@if($errors->any())
    <h1 style="color: red">{{$errors->first()}}</h1>
@endif
<body class="flex-wrap">
<h1>Here is JSON</h1>
<h4>JsonModel Created By: {{ $jsonModel->user->name }}</h4>
<h4>JsonModel Created : {{ $jsonModel->created_at }}</h4>
<h4>JsonModel Data:</h4>

    @foreach($data as $key => $value)
        @if (is_array($value))
            <ul>@include('partials', ['arr' => $value])</ul>
        @else
            <li>{{ $key }} : {{ $value }}</li>
        @endif
    @endforeach

</body>
</table>
</body>
</html>


<script>
    let visible = true;
    $('.parent').on('click', function () {
        console.log(visible);
        if (visible == true) {
            $(this).parent().children().hide();
            $(this).show();
            visible = false;
        } else if (visible == false) {
            $(this).parent().children().show();
            visible = true;
        }
    });
</script>

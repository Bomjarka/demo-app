<li> {{ $key }} :</li>
@foreach ($arr as $key => $value)
    @if (is_array($value))
        <ul>@include('partials', [ 'arr' => $value ])</ul>
    @else
        <ul>
            <li class="sub">{{ $key }} : {{ $value }}</li>
        </ul>
    @endif
@endforeach

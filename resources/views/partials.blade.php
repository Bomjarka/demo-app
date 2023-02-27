<li class="parent"> {{ $key }} :  </li>
@foreach ($arr as $key => $value)
    @if (is_array($value))
        <ul>@include('partials', [ 'arr' => $value ])</ul>
    @else
        <ul>
            <li>{{ $key }} : {{ $value }}</li>
        </ul>
    @endif
@endforeach

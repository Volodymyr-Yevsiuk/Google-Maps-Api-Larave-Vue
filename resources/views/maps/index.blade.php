@extends(config('settings.theme').'.layouts.layout')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
    <div id="map"></div>
@endsection

@section('scripts')
    {!! $scripts !!}
@endsection

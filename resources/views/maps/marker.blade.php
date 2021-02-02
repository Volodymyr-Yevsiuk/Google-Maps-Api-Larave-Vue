@extends(config('settings.theme').'.layouts.layout')

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
   {!! $content !!}
@endsection

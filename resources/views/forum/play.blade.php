@extends('app')

@section('content')
<div class="container">
    @include ('forum.partials.forum', ['board' => 'Looking To Play'])
</div>
@stop

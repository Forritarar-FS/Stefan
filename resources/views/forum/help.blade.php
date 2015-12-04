@extends('app')

@section('content')
<div class="container">
    @include ('forum.partials.forum', ['board' => 'Help'])
</div>
@stop

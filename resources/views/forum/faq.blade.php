@extends('app')

@section('content')
<div class="container">
    @include ('forum.partials.forum', ['board' => 'Frequently Asked Questions'])
</div>
@stop

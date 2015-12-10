@extends('app')

@section('content')
<div class="container">
    @include ('forum.partials.forum', ['board' => 'General'])
</div>
@stop

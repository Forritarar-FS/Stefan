@extends('app')

@section('content')

<div class="well">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Forum</h3>
      </div>
      <ul class="list-group">
          <a href="general" style="text-decoration:none;">
              <li class="list-group-item">
                <h2>General</h2>
                <p>General Discussion about anything.</p>
              </li>
          </a>
          <a href="faq" style="text-decoration:none;">
              <li class="list-group-item">
                <h2>FAQ</h2>
                <p>Frequently Asked Questions.</p>
              </li>
          </a>
          <a href="help" style="text-decoration:none;">
              <li class="list-group-item">
                <h2>Help</h2>
                <p>Need help?</p>
              </li>
          </a>
          <a href="looking-to-play" style="text-decoration:none;">
              <li class="list-group-item">
                <h2>Looking to Play</h2>
                <p>Want to play a game with some other people?</p>
              </li>
          </a>
      </ul>
    </div>
</div>

@stop

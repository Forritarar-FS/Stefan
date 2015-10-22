<div class="well">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Forum</h3>
      </div>
      <ul class="list-group">
        @foreach ($posts as $post)
          <a href="{{ url('/post', $post->slug) }}" style="text-decoration:none;">
              <li class="list-group-item">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->body }}</p>
              </li>
          </a>
        @endforeach
      </ul>
    </div>
</div>

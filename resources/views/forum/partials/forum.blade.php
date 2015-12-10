<div class="well">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <div class="col-md-8">
                    Name
                </div>
                <div class="col-md-2 text-center">
                    Comments / Views
                </div>
                <div class="col-md-2 text-right">
                    Latest Comment
                </div>
                <div class="clearfix"></div>
            </h3>
        </div>
        <ul class="list-group">
            @foreach ($posts as $post)
            <a href="{{ url('/post', $post->slug) }}" style="text-decoration:none;">
                <li class="list-group-item">
                    <div class="col-md-8">
                        <h2>{{ $post->title }}</h2>
                        <p>Started by {{ $post->user->name }}</p>
                    </div>
                    <div class="col-md-2 text-center">
                        <br>
                        Comments {{ $post->comments()->get()->count()}}<br>
                        Views {{ $post->views }}
                    </div>
                    <div class="col-md-2 text-right">
                        @if($post->comments()->latest('published_at')->first())
                        {{ $post->comments()->latest('published_at')->first()->published_at->format('F jS\\, Y') }}<br>
                        {{ $post->comments()->latest('published_at')->first()->published_at->toTimeString() }}<br><br>
                        By {{ $post->comments()->latest('published_at')->first()->user->name }}
                        @else
                        {{ $post->published_at->format('F jS\\, Y') }}
                        {{ $post->published_at->toTimeString() }}<br><br>
                        By {{ $post->user->name }}
                        @endif
                    </div>

                    <div class="clearfix"></div>
                </li>
            </a>
            @endforeach
        </ul>
    </div>
</div>
<script>
// request permission on page load
document.addEventListener('DOMContentLoaded', function () {
    if (Notification.permission !== "granted")
    Notification.requestPermission();
});

function notifyMe() {
    if (!Notification) {
        alert('Desktop notifications not available in your browser. Try Chromium.');
        return;
    }

    if (Notification.permission !== "granted")
    Notification.requestPermission();
    else {
        var notification = new Notification('Notification title', {
            icon: 'http://rngskins.com/images/background.jpg',
            body: "Hey there! You've been notified!",
        });

        notification.onclick = function () {
            window.open("http://stackoverflow.com/a/13328397/1269037");
        };

    }

}
</script>

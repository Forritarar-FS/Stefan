@if ($errors->any())
<div class="panel-footer">
    <div class="alert alert-danger">
        <h5><b>There were some errors in your post.</b></h5>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}
                @endforeach
            </ul>
        </div>
    </div>
    @endif

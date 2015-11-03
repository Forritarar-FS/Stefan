<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('board', 'Board:') !!}
    {!! Form::select('board', [
    'general' => 'General',
    'faq' => 'FAQ',
    'help' => 'Help',
    'play' => 'Looking to Play'], null, ['class' => 'form-control']) !!}
</div>
@if (Auth::user()->group == 'Admin')
<div class="form-group">
    {!! Form::label('published_at', 'Publish On:') !!}
    {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>
@else
    {!! Form::input('hidden', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
@endif
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@extends('app')

@section('content')

    <ul style="list-style-type: none;">
        <li><input type="checkbox" checked/> User
            <ul style="list-style-type: none;">
                <li><input type="checkbox" checked/> Register</li>
                <li><input type="checkbox" checked/> Login</li>
            </ul>
        </li>
        <li><input type="checkbox"/> User Groups
            <ul style="list-style-type: none;">
                <li><input type="checkbox"/> Administrator</li>
                <li><input type="checkbox"/> Moderator</li>
                <li><input type="checkbox"/> Member</li>
                <li><input type="checkbox"/> Guest</li>
            </ul>
        </li>
        <li><input type="checkbox"/> Forum
            <ul style="list-style-type: none;">
                <li><input type="checkbox"/> Create Post</li>
                <li><input type="checkbox"/> View Post</li>
                <li><input type="checkbox"/> Delete Post</li>
                <li><input type="checkbox"/> Comment on Post</li>
                <li><input type="checkbox"/> Vote on Post</li>
                <li><input type="checkbox"/> Vote on Comment</li>
            </ul>
        </li>
@stop

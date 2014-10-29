@extends('...layouts.main')

@section('metaTitle')
Gen&amp;Send
@stop

@section('content')
    <div id="buttons">
        <p>
            <a href="{{ URL::to('/gen') }}"><span>Generate</span> a password</a>
        </p>
        <p class="or">
            or
        </p>
        <p>
            <a href="{{ URL::to('/send') }}"><span>Send</span> a password</a>
        </p>
    </div>
@stop
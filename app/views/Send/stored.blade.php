@extends('...layouts.main')

@section('metaTitle')
    Generate a random password
@stop

@section('content')
    <div class="narrow">
        <h2>URL Generated:</h2>
        
        <form action="" method="post">
            <textarea name="passwordUrl" class="generated_url">{{ URL::to('/v/' . $url) }}</textarea>
        </form>
        
        <p>
            Click the link below to test the URL:<br /> <em>note: this will use one of the views allowed for the password</em>
        </p>
        <p>
            <a href="{{ URL::to('/v/' . $url) }}">{{ URL::to('/v/' . $url) }}</a>
        </p>
    </div>
@stop
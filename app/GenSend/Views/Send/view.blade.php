@extends('Layouts.main')

@section('metaTitle')
    Generate a random password
@stop

@section('content')
    <div class="narrow">
        <h3 class="password_title">Your password is:</h3>
        <form action="" method="post">
            <textarea name="password" class="generated_url password_display password">{{{ $password }}}</textarea>
        </form>
    </div>
@stop
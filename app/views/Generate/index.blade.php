@extends('...layouts.main')

@section('metaTitle')
    Generate a random password
@stop

@section('content')
    @if(isset($password) && trim($password) != '')
        <h2>Your password:</h2>
        <h2 class="password">{{{ $password }}}</h2>
        
        @if(strlen($password) <= 16)
            <h2 class="phonetic password">{{ $phonetic }}</h2>
        @endif
        <form class="transfer" action="{{ URL::to('/send') }}" method="post">
            <input type="hidden" value="{{ $password }}" name="password" />
            <input type="hidden" value="1" name="password_transfer" />
            <input type="submit" value="Transfer to secure send tool..." name="submit" />
        </form>
    @endif
    
    <div class="narrow">
        <h3>Generate a random password:</h3>
        
        
        @foreach($errors->all() as $error)
            <p class="error clearfix">{{ $error }}</p>
        @endforeach
        
        {{ Form::open(array('url' => '/gen')) }}
        <div class="col1">
            <ul>
                <li>
                    <label for="length">Length:</label>

                    {{ Form::text('length', Input::old('length') ?: Config::get('site.defaultPasswordLength'), array('id' =>  'length', 'maxlength'   =>  2)) }}
                </li>
                <li>
                    <label for="nonSimilarLowercase">Letters:</label>
                    {{ Form::checkbox('nonSimilarLowercase', 1, Input::old('nonSimilarLowercase') ?: 1) }}
                </li>
                <li>
                    <label for="nonSimilarUppercase">Mixed Case:</label>
                    {{ Form::checkbox('nonSimilarUppercase', 1, Input::old('nonSimilarUppercase') ?: 1) }}
                </li>
            </ul>
        </div>
        <div class="col2">
            <ul>
                <li>
                    <label for="standardNumbers">Numbers:</label>
                    {{ Form::checkbox('standardNumbers', 1, Input::old('standardNumbers') ?: 1) }}
                </li>
                <li>
                    <label for="punctuation">Punctuation:</label>
                    {{ Form::checkbox('punctuation', 1, Input::old('punctuation') ?: 0) }}
                </li>
                <li>
                    <label for="similar">Similar Chars:</label>
                    {{ Form::checkbox('similar', 1, Input::old('similar') ?: 0) }}
                </li>
            </ul>
        </div>
        <input type="submit" value="Generate password..." name="submit" />
        {{ Form::close() }}
    </div>
@stop
@extends('...layouts.main')

@section('metaTitle')
    Generate a random password
@stop

@section('content')
    <div class="narrow">
        <h3>Send your password securely</h3>
        
        @foreach($errors->all() as $error)
            <p class="error clearfix">{{ $error }}</p>
        @endforeach
        
        {{ Form::open(array('url' => '/send', 'id'  =>  'secure_send')) }}
            
        <div class="securesend-password">
            <textarea name="password" id="password" placeholder="Enter the password you wish to send here"></textarea>
        </div>
            
        <div class="col1">
            <ul>
                <li>Expire after: </li>
                <li>
                    <label for="expire_days">days</label>
                    {{ Form::text('days', Input::old('days') ?: Config::get('site.defaultExpireDays'), array('autocomplete' =>  'off', 'maxlength'  =>  2, 'id' =>  'expire_days')) }}
                </li>
                <li>
                    OR
                </li>
                <li>
                    <label for="expire_views">views</label>
                    {{ Form::text('views', Input::old('views') ?: Config::get('site.defaultExpireViews'), array('autocomplete' =>  'off', 'maxlength'  =>  2, 'id' =>  'expire_views')) }}
                </li>
                <li>Whichever comes first.</li>
            </ul>
        </div>
        <div class="col2">
            <div class="notes">
                <p>
                    Use these options to determine when the password will expire.
                </p>
                <p>
                    Once the expiration date or total number of allowed views has passed, the password will be deleted from the database and no record of it will be left.
                </p>
                <p>
                    No information about you is stored in the database. Only what you enter here and the URL to identify this password which is a randomly generated string.
                </p>
            </div>
        </div>
        <input type="submit" value="Generate secure link..." name="submit" />
        {{ Form::close() }}
    </div>
@stop
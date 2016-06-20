@extends('backend/layout/layout')
@section('content')
<script type="text/javascript">
    $(document).ready(function () {
        $('#notification').show().delay(4000).fadeOut(700);
    });
</script>
<section class="content-header">
    <h1> Settings
        <small> | Change Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang(). '/admin') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Change Settings</li>
    </ol>
</section>
<br>
<br>
<div class="col-lg-10">

    @include('flash::message')
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
        <li><a href="#seo" data-toggle="tab">SEO</a></li>
        <li><a href="#social" data-toggle="tab">Social</a></li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="info">
            <br>
            <h4><i class="glyphicon glyphicon-info-sign"></i> Info</h4>
            <br>
            {!! Form::open() !!}

            <!-- Company name -->
            <div class="control-group {!! $errors->has('cc_name') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Company name</label>

                <div class="controls">
                    {!! Form::text('cc_name', ($setting['cc_name']) ?: null, array('class'=>'form-control', 'id' => 'cc_name', 'placeholder'=>'Company name', 'value'=>Input::old('cc_name'))) !!}
                    @if ($errors->first('cc_name'))
                    <span class="help-block">{!! $errors->first('cc_name') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Company address -->
            <div class="control-group {!! $errors->has('cc_address') ? 'has-error' : '' !!}">
                <label class="control-label" for="title"> Company address</label>

                <div class="controls">
                    {!! Form::text('cc_address', ($setting['cc_address']) ?: null, array('class'=>'form-control', 'id' => 'cc_address', 'placeholder'=>' Company address', 'value'=>Input::old('cc_address'))) !!}
                    @if ($errors->first('cc_address'))
                    <span class="help-block">{!! $errors->first('cc_address') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Phone number -->
            <div class="control-group {!! $errors->has('cc_phone') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Phone number</label>

                <div class="controls">
                    {!! Form::text('cc_phone', ($setting['cc_phone']) ?: null, array('class'=>'form-control', 'id' => 'cc_phone', 'placeholder'=>'Phone number', 'value'=>Input::old('cc_phone'))) !!}
                    @if ($errors->first('cc_phone'))
                    <span class="help-block">{!! $errors->first('cc_phone') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Contact point -->
            <div class="control-group {!! $errors->has('cc_contact') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Contact point</label>

                <div class="controls">
                    {!! Form::text('cc_contact', ($setting['cc_contact']) ?: null, array('class'=>'form-control', 'id' => 'cc_contact', 'placeholder'=>'Contact point', 'value'=>Input::old('cc_contact'))) !!}
                    @if ($errors->first('cc_contact'))
                    <span class="help-block">{!! $errors->first('cc_contact') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
            {!! Form::close() !!}
        </div>

        <div class="tab-pane" id="seo">
            <br>
            <h4><i class="glyphicon glyphicon-cog"></i> Settings</h4>

            <br>
            {!! Form::open() !!}

            <!-- Title -->
            <div class="control-group {!! $errors->has('site_title') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Title</label>

                <div class="controls">
                    {!! Form::text('site_title', ($setting['site_title']) ?: null, array('class'=>'form-control', 'id' => 'site_title', 'placeholder'=>'Title', 'value'=>Input::old('site_title'))) !!}
                    @if ($errors->first('title'))
                    <span class="help-block">{!! $errors->first('site_title') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Google Analytics Code -->
            <div class="control-group {!! $errors->has('ga_code') ? 'has-error' : '' !!}">
                <label class="control-label" for="title"> Google Analytics Code</label>

                <div class="controls">
                    {!! Form::text('ga_code', ($setting['ga_code']) ?: null, array('class'=>'form-control', 'id' => 'ga_code', 'placeholder'=>' Google Analytics Code', 'value'=>Input::old('ga_code'))) !!}
                    @if ($errors->first('ga_code'))
                    <span class="help-block">{!! $errors->first('ga_code') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Meta Keywords -->
            <div class="control-group {!! $errors->has('meta_keywords') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Meta Keywords</label>

                <div class="controls">
                    {!! Form::text('meta_keywords', ($setting['meta_keywords']) ?: null, array('class'=>'form-control', 'id' => 'meta_keywords', 'placeholder'=>'Meta Keywords', 'value'=>Input::old('meta_keywords'))) !!}
                    @if ($errors->first('meta_keywords'))
                    <span class="help-block">{!! $errors->first('meta_keywords') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Meta Description -->
            <div class="control-group {!! $errors->has('meta_description') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Meta Description</label>

                <div class="controls">
                    {!! Form::text('meta_description', ($setting['meta_description']) ?: null, array('class'=>'form-control', 'id' => 'meta_description', 'placeholder'=>'Meta Description', 'value'=>Input::old('meta_description'))) !!}
                    @if ($errors->first('meta_description'))
                    <span class="help-block">{!! $errors->first('meta_description') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
            {!! Form::close() !!}
        </div>

        <!-- Social -->
        <div class="tab-pane" id="social">
            <br>
            <h4><i class="glyphicon glyphicon-cog"></i> Socials</h4>

            <br>
            {!! Form::open() !!}

            <!-- Facebook -->
            <div class="control-group {!! $errors->has('facebook') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Facebook</label>

                <div class="controls">
                    {!! Form::text('facebook', ($setting['facebook']) ?: null, array('class'=>'form-control', 'id' => 'facebook', 'placeholder'=>'Facebook', 'value'=>Input::old('facebook'))) !!}
                    @if ($errors->first('facebook'))
                    <span class="help-block">{!! $errors->first('facebook') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Twitter -->
            <div class="control-group {!! $errors->has('twitter') ? 'has-error' : '' !!}">
                <label class="control-label" for="title"> Twitter</label>

                <div class="controls">
                    {!! Form::text('twitter', ($setting['twitter']) ?: null, array('class'=>'form-control', 'id' => 'twitter', 'placeholder'=>' Twitter', 'value'=>Input::old('twitter'))) !!}
                    @if ($errors->first('twitter'))
                    <span class="help-block">{!! $errors->first('twitter') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Google + -->
            <div class="control-group {!! $errors->has('google_plus') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Google plus</label>

                <div class="controls">
                    {!! Form::text('google_plus', ($setting['google_plus']) ?: null, array('class'=>'form-control', 'id' => 'google_plus', 'placeholder'=>'Google plus', 'value'=>Input::old('google_plus'))) !!}
                    @if ($errors->first('google_plus'))
                    <span class="help-block">{!! $errors->first('google_plus') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Youtube -->
            <div class="control-group {!! $errors->has('youtube') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Youtube</label>

                <div class="controls">
                    {!! Form::text('youtube', ($setting['youtube']) ?: null, array('class'=>'form-control', 'id' => 'youtube', 'placeholder'=>'Youtube', 'value'=>Input::old('youtube'))) !!}
                    @if ($errors->first('youtube'))
                    <span class="help-block">{!! $errors->first('youtube') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Linkedin -->
            <div class="control-group {!! $errors->has('linkedin') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Linkedin</label>

                <div class="controls">
                    {!! Form::text('linkedin', ($setting['linkedin']) ?: null, array('class'=>'form-control', 'id' => 'linkedin', 'placeholder'=>'Linkedin', 'value'=>Input::old('linkedin'))) !!}
                    @if ($errors->first('linkedin'))
                    <span class="help-block">{!! $errors->first('linkedin') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Pinterest -->
            <div class="control-group {!! $errors->has('pinterest') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Pinterest</label>

                <div class="controls">
                    {!! Form::text('pinterest', ($setting['pinterest']) ?: null, array('class'=>'form-control', 'id' => 'pinterest', 'placeholder'=>'Pinterest', 'value'=>Input::old('pinterest'))) !!}
                    @if ($errors->first('pinterest'))
                    <span class="help-block">{!! $errors->first('pinterest') !!}</span>
                    @endif
                </div>
            </div>
            <br>

            <!-- Flickr -->
            <div class="control-group {!! $errors->has('flickr') ? 'has-error' : '' !!}">
                <label class="control-label" for="title">Flickr</label>

                <div class="controls">
                    {!! Form::text('flickr', ($setting['flickr']) ?: null, array('class'=>'form-control', 'id' => 'flickr', 'placeholder'=>'Flickr', 'value'=>Input::old('flickr'))) !!}
                    @if ($errors->first('flickr'))
                    <span class="help-block">{!! $errors->first('flickr') !!}</span>
                    @endif
                </div>
            </div>
            <br>
            {!! Form::submit('Save Changes', array('class' => 'btn btn-success')) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
@stop
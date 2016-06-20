@extends('backend/layout/layout')
@section('content')
{!! HTML::script('ckeditor/ckeditor.js') !!}

<!-- Content Header (Feature header) -->
<section class="content-header">
    <h1> Feature <small> | Add Feature</small> </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang() . '/admin/feature') !!}"><i class="fa fa-bookmark"></i> Feature</a></li>
        <li class="active">Add Feature</li>
    </ol>
</section>
<br>
<br>
<div class="container">
    {!! Form::open(array('action' => '\Fully\Http\Controllers\Admin\FeatureController@store')) !!}
    <!-- Title -->
    <div class="control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
        <label class="control-label" for="title">Title</label>

        <div class="controls">
            {!! Form::text('title', null, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
            @if ($errors->first('title'))
            <span class="help-block">{!! $errors->first('title') !!}</span>
            @endif
        </div>
    </div>
    <br>
    <!-- Content -->
    <div class="control-group {!! $errors->has('content') ? 'has-error' : '' !!}">
        <label class="control-label" for="title">Content</label>

        <div class="controls">
            {!! Form::textarea('content', null, array('class'=>'form-control', 'id' => 'content', 'placeholder'=>'Content', 'value'=>Input::old('content'))) !!}
            @if ($errors->first('content'))
            <span class="help-block">{!! $errors->first('content') !!}</span>
            @endif
        </div>
    </div>
    <br>
    <!-- Group -->
    <div class="control-group {!! $errors->has('group') ? 'has-error' : '' !!}">

        <div class="controls">
            <label class="">{!! Form::select('group', $group); !!}</label>
            @if ($errors->first('group'))
            <span class="help-block">{!! $errors->first('group') !!}</span>
            @endif
        </div>
    </div>
    <br>
    <!-- Published -->
    <div class="control-group {!! $errors->has('is_published') ? 'has-error' : '' !!}">

        <div class="controls">
            <label class="">{!! Form::checkbox('is_published', 'is_published') !!} Publish ?</label>
            @if ($errors->first('is_published'))
            <span class="help-block">{!! $errors->first('is_published') !!}</span>
            @endif
        </div>
    </div>
    <br>
    <!-- Form actions -->
    {!! Form::submit('Create', array('class' => 'btn btn-success')) !!}
    {!! Form::close() !!}
    <script>
        window.onload = function () {
            CKEDITOR.replace('content', {
                "filebrowserBrowseUrl": "{!! url('filemanager/show') !!}"
            });
        };
    </script>
</div>
@stop

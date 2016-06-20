@extends('backend/layout/layout')
@section('content')
{!! HTML::script('ckeditor/ckeditor.js') !!}
<section class="content-header">
    <h1> Feature <small> | Update Feature</small> </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang() . '/admin/feature') !!}"><i class="fa fa-bookmark"></i> Feature</a></li>
        <li class="active">Update Feature</li>
    </ol>
</section>
<br>
<br>
<div class="container">

    {!! Form::open( array( 'route' => array( getLang() . '.admin.feature.update', $feature->id), 'method' => 'PATCH', 'files'=>true)) !!}
    <!-- Title -->
    <div class="control-group {!! $errors->has('title') ? 'has-error' : '' !!}">
        <label class="control-label" for="title">Title</label>

        <div class="controls">
            {!! Form::text('title', $feature->title, array('class'=>'form-control', 'id' => 'title', 'placeholder'=>'Title', 'value'=>Input::old('title'))) !!}
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
            {!! Form::textarea('content', $feature->content, array('class'=>'form-control', 'id' => 'content', 'placeholder'=>'Content', 'value'=>Input::old('content'))) !!}
            @if ($errors->first('content'))
            <span class="help-block">{!! $errors->first('content') !!}</span>
            @endif
        </div>
    </div>
    <br>
    <!-- Group -->
    <div class="control-group {!! $errors->has('group') ? 'has-error' : '' !!}">

        <div class="controls">
            <label class="">{!! Form::select('group', $group, $feature->group); !!}</label>
            @if ($errors->first('group'))
            <span class="help-block">{!! $errors->first('group') !!}</span>
            @endif
        </div>
    </div>
    <br>
    <!-- Published -->
    <div class="control-group {!! $errors->has('is_published') ? 'has-error' : '' !!}">

        <div class="controls">
            <label class="">{!! Form::checkbox('is_published', 'is_published',$feature->is_published) !!} Publish ?</label>
            @if ($errors->first('is_published'))
            <span class="help-block">{!! $errors->first('is_published') !!}</span>
            @endif
        </div>
    </div>
    <br>
    <!-- Form actions -->
    {!! Form::submit('Update', array('class' => 'btn btn-success')) !!}
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

@extends('backend/layout/layout')
@section('content')
{!! HTML::style('assets/bootstrap/css/bootstrap-tagsinput.css') !!}
{!! HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css') !!}
{!! HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js') !!}
{!! HTML::script('ckeditor/ckeditor.js') !!}
{!! HTML::script('assets/bootstrap/js/bootstrap-tagsinput.js') !!}
{!! HTML::script('assets/js/jquery.slug.js') !!}
<script type="text/javascript">
    $(document).ready(function () {
        $("#title").slug();
    });
</script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Post <small> | Add Post</small> </h1>
    <ol class="breadcrumb">
        <li><a href="{!! url(getLang() . '/admin/post') !!}"><i class="fa fa-book"></i> Post</a></li>
        <li class="active">Add Post</li>
    </ol>
</section>
<br>
<br>
<div class="container">

    {!! Form::open(array('action' => '\App\Http\Controllers\Admin\PostController@store', 'files'=>true)) !!}

    <!-- Category -->
    <div class="control-group {!! $errors->has('category') ? 'error' : '' !!}">
        <label class="control-label" for="title">Category</label>

        <div class="controls">
            {!! Form::select('category', $categories, null, array('class' => 'form-control', 'value'=>Input::old('category'))) !!}
            @if ($errors->first('category'))
            <span class="help-block">{!! $errors->first('category') !!}</span>
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

    <!-- Tag -->
    <div class="control-group {!! $errors->has('tag') ? 'has-error' : '' !!}">
        <label class="control-label" for="title">Tag</label>

        <div class="controls">
            {!! Form::text('tag', null, array('class'=>'form-control', 'id' => 'tag', 'placeholder'=>'Tag', 'value'=>Input::old('tag'))) !!}
            @if ($errors->first('tag'))
            <span class="help-block">{!! $errors->first('tag') !!}</span>
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

    {!! Form::submit('Create', array('class' => 'btn btn-success')) !!}
    {!! Form::close() !!}
    <script type="text/javascript">
        window.onload = function () {
            CKEDITOR.replace('content', {
                "filebrowserBrowseUrl": "{!! url('filemanager/show') !!}"
            });
        };

        $(document).ready(function () {

            if ($('#tag').length != 0) {
                var elt = $('#tag');
                elt.tagsinput();
            }
        });
    </script>
</div>
@stop
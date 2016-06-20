@extends('backend/layout/layout')
@section('content')
{!! HTML::style('ckeditor/contents.css') !!}
        <!-- Content Header (Feature header) -->
<section class="content-header">
    <h1> Feature
        <small> | Show Feature</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! langRoute('admin.feature.index') !!}"><i class="fa fa-bookmark"></i> Feature</a></li>
        <li class="active">Show Feature</li>
    </ol>
</section>
<br>
<br>
<div class="container">
    <div class="col-lg-10">
        <div class="pull-left">
            <div class="btn-toolbar">
                <a href="{!! langRoute('admin.feature.index') !!}"
                   class="btn btn-primary"> <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back </a>
            </div>
        </div>
        <br> <br> <br>
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><strong>Title</strong></td>
                <td>{!! $feature->title !!}</td>
            </tr>
            <tr>
                <td><strong>Published</strong></td>
                <td>{!! $feature->is_published !!}</td>
            </tr>
            <tr>
                <td><strong>Content</strong></td>
                <td>{!! $feature->content !!}</td>
            </tr>
            <tr>
                <td><strong>Date Created</strong></td>
                <td>{!! $feature->created_at !!}</td>
            </tr>
            <tr>
                <td><strong>Date Updated</strong></td>
                <td>{!! $feature->updated_at !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
@stop

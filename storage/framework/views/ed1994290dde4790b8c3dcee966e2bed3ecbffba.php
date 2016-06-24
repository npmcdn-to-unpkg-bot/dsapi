<?php $__env->startSection('content'); ?>
<?php echo HTML::style('assets/bootstrap/css/bootstrap-tagsinput.css'); ?>

<?php echo HTML::style('jasny-bootstrap/css/jasny-bootstrap.min.css'); ?>

<?php echo HTML::script('jasny-bootstrap/js/jasny-bootstrap.min.js'); ?>

<?php echo HTML::script('ckeditor/ckeditor.js'); ?>

<?php echo HTML::script('assets/bootstrap/js/bootstrap-tagsinput.js'); ?>

<?php echo HTML::script('assets/js/jquery.slug.js'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#title").slug();

        if ($('#tag').length != 0) {
            var elt = $('#tag');
            elt.tagsinput();
        }
    });
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Post <small> | Update Post</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo url(getLang() . '/admin/post'); ?>"><i class="fa fa-book"></i> Post</a></li>
        <li class="active">Update Post</li>
    </ol>
</section>
<br>
<br>
<div class="container">

    <?php echo Form::open( array( 'route' => array('admin.post.update', $post->id), 'method' => 'PATCH', 'files'=>true)); ?>



    <!-- Category -->
    <div class="control-group <?php echo $errors->has('category') ? 'error' : ''; ?>">
        <label class="control-label" for="title">Category</label>

        <div class="controls">
            <?php echo Form::select('category', $categories, $post->category_id, array('class' => 'form-control', 'value'=>Input::old('category'))); ?>

            <?php if($errors->first('category')): ?>
            <span class="help-block"><?php echo $errors->first('category'); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <br>

    <!-- Content -->
    <div class="control-group <?php echo $errors->has('content') ? 'has-error' : ''; ?>">
        <label class="control-label" for="title">Content</label>

        <div class="controls">
            <?php echo Form::textarea('content', $post->content, array('class'=>'form-control', 'id' => 'content', 'placeholder'=>'Content', 'value'=>Input::old('content'))); ?>

            <?php if($errors->first('content')): ?>
            <span class="help-block"><?php echo $errors->first('content'); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <br>

    <!-- Tag -->
    <div class="control-group <?php echo $errors->has('tag') ? 'has-error' : ''; ?>">
        <label class="control-label" for="title">Tag</label>

        <div class="controls">
            <?php echo Form::text('tag', $tags, array('class'=>'form-control', 'id' => 'tag', 'placeholder'=>'Tag', 'value'=>Input::old('tag'))); ?>

            <?php if($errors->first('tag')): ?>
            <span class="help-block"><?php echo $errors->first('tag'); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <br>

    <!-- Published -->
    <div class="control-group <?php echo $errors->has('is_published') ? 'has-error' : ''; ?>">

        <div class="controls">
            <label class=""><?php echo Form::checkbox('is_published', 'is_published',$post->is_published); ?> Publish ?</label>
            <?php if($errors->first('is_published')): ?>
            <span class="help-block"><?php echo $errors->first('is_published'); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <?php echo Form::submit('Update', array('class' => 'btn btn-success')); ?>

    <?php echo Form::close(); ?>

    <script>
        window.onload = function () {
            CKEDITOR.replace('content', {
                "filebrowserBrowseUrl": "<?php echo url('filemanager/show'); ?>"
            });
        };
    </script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
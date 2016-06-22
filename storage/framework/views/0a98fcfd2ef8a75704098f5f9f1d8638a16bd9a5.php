<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1> Category <small> | Delete Category</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo langRoute('admin.category.index'); ?>"><i class="fa fa-list"></i> Category</a></li>
        <li class="active">Delete Category</li>
    </ol>
</section>
<br>
<br>
<br>
<div class="container">
    <?php echo Form::open( array( 'route' => array( getLang() . 'admin.category.destroy', $category->id ) ) ); ?>

    <?php echo Form::hidden( '_method', 'DELETE' ); ?>

    <div class="alert alert-warning">
        <div class="pull-left"><b> Be Careful!</b> Are you sure you want to delete <b><?php echo $category->title; ?> and related articles </b> ?
        </div>
        <div class="pull-right">
            <?php echo Form::submit( 'Yes', array( 'class' => 'btn btn-danger' ) ); ?>

            <?php echo link_to( URL::previous(), 'No', array( 'class' => 'btn btn-primary' ) ); ?>

        </div>
        <div class="clearfix"></div>
    </div>
    <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend/layout/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
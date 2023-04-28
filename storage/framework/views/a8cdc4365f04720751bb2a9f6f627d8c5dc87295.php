<?php $__env->startSection('title', 'Admin Brand'); ?>

<?php $__env->startSection('page', 'Brand > Edit Brand'); ?>

<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-12 layout-spacing">
    <h3 calss="mb-2">Edit Brand</h3>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <form action="<?php echo e(route('brand.update', ['brand' => $brand->id])); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="row list-sub">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name" value="<?php echo e($brand->name); ?>" id="brand_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="brand_of">Brand Of</label>
                            <select name="brand_of" required id="brand_of" class="form-control select2" required>
                                <option <?php echo e($brand->brand_of == 'guitar' ? 'selected' : ''); ?> value="guitar">Guitar</option>
                                <option <?php echo e($brand->brand_of == 'amplifier' ? 'selected' : ''); ?> value="amplifier">Amplifier</option>
                                <option <?php echo e($brand->brand_of == 'effect_pedals' ? 'selected' : ''); ?> value="effect_pedals">Effect Pedals</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="image">Brand Image</label>
                            <input type="file" name="image" class="form-control-file" id="image" >
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="<?php echo e(asset('storage').'/'.$brand->image); ?>" id="preview-image" class="w-100" alt="">
                    </div>
                    
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <a class="btn btn-danger mt-3" href="<?php echo e(route('brand.index')); ?>"><i
                                class="flaticon-cancel-12"></i> Back</a>
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php
    $menu = 'brand'
?>
<?php $__env->startSection('js'); ?>


<script>
    $('#image').change(function(){
        console.log('okey');
        readURL(this, $('#preview-image'))
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/brand/edit.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('page', 'Data Master > Setting'); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-12 layout-spacing">
        <h3 calss="mb-2">Setting</h3>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="<?php echo e(route('setting.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-4 mt-3">
                                <label for="exampleFormControlFile1">Upload Gambar</label>
                                <img src="<?php echo e(asset('storage/' . $setting->image)); ?>" width="100%" class="mb-3"
                                    id="preview">
                                <input type="file" class="form-control-file" onchange="loadFile(event, 0)"
                                    id="exampleFormControlFile1" name="image">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4 mt-3">
                                <label for="exampleFormControlFile1">Nama Website</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo e($setting->name); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4 mt-3">
                                <label for="exampleFormControlFile1">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3"><?php echo e($setting->description); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4 mt-3">
                                <label for="exampleFormControlFile1">Seo Keyword</label>
                                <textarea class="form-control" id="seo_keyword" name="seo_keyword"
                                    rows="3"><?php echo e($setting->seo_keyword); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group mb-4 mt-3">
                                <label for="exampleFormControlFile1">Whatsapp number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?php echo e($setting->phone); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4 mt-3">
                                <label for="exampleFormControlFile1">Whatsapp Template</label>
                                <input type="text" class="form-control" id="whatsapp_template" name="whatsapp_template"
                                    value="<?php echo e($setting->whatsapp_template); ?>">
                            </div>
                        </div>
                        

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        var loadFile = function(event, no) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/setting/index.blade.php ENDPATH**/ ?>
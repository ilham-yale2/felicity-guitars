<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('page', 'Data Master > Banner'); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12">
        <h3 calss="mb-2">Daftar Banner</h3>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <a class="btn btn-primary mb-2 ml-3" href="<?php echo e(route('banner.create')); ?>"><i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-plus-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                    </i> Tambah Banner</a>
                <div class="table-responsive mb-4">
                    <table id="zero-config" class="table style-3 table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th>Kategori Banner</th>
                                <th>Nama Banner</th>
                                <th>Caption</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $banner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="text-center banner-img">
                                        <span><img src="<?php echo e(asset('storage/' . $b->image)); ?>" width="100px"></span>
                                    </td>
                                    <td><?php echo e($b->type ? $b->type->name : 'Home'); ?></td>
                                    <td><?php echo e($b->name); ?></td>
                                    <td><?php echo e($b->caption); ?></td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="<?php echo e(route('banner.show', $b->id)); ?>" class="bs-tooltip"
                                                    data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-edit-2 p-1 br-6 mb-1">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg></a></li>
                                            <li><a href="<?php echo e(route('banner.destroy', $b->id)); ?>"
                                                    onclick="return confirm('yakin ingin menghapus data ini?')"
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <!-- <script src="<?php echo e(url('js/banner/banner.js')); ?>"></script> -->
    <script>
        function doDelete(id) {

            Swal.fire({
                title: 'Yakin?',
                text: "Data yang terhapus tidak dapat di restore",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: global_url + '/banner/' + id,
                        method: 'DELETE',
                        data: {
                            _token: token
                        },
                        dataType: 'json',
                        success: function(resp) {
                            window.location.href = global_url + '/banner?&del_suc=1';
                        }
                    });
                }
            });

        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Laravel\rumah-batik\resources\views/banner/index.blade.php ENDPATH**/ ?>
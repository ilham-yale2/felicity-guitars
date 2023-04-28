<?php $__env->startSection('title', 'Browse by Brand'); ?>
<?php $__env->startSection('content'); ?>
    <div class="aboutus">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 p-0">
                    <div class="row mx-0">
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-card col-6 card-product mb-4 text-center px-3">
                                <a href="<?php echo e(route('detail-product',['name' => $item->slug])); ?>">
                                    <div class="d-flex justify-content-center">
                                        <img src="<?php echo e(asset('storage').'/'.$item->thumbnail); ?>" class="card-product-img" alt="<?php echo e($item->alt_text); ?>">
                                    </div>
                                    <p class="product-name text-gold copperplate mb-0"><?php echo e($item->name_2); ?></p>    
                                    <p>
                                        More Info..
                                    </p>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center w-100 pt-5">
                                    <h2 style="text-transform: none">No Product</h2>
                                </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.app', ['background' => 'background-multi-item.jpg'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/search.blade.php ENDPATH**/ ?>
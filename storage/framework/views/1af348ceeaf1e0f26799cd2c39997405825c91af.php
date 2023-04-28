<?php $__env->startSection('meta'); ?> <?php echo $__env->make('layout.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('title', 'Busana'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="slide v3">
            <div class="swiper-container" id="swiper_home">
                <div class="swiper-wrapper disabled">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide slide-home">
                            <div class="slider-with-caption">
                                <img src="<?php echo e(asset('storage/' . $banner->image)); ?>" alt="Rumah Batik Probolinggo">
                                <!-- <div class="slider-with-image-caption">
                                                                                                                                            <h1 class="slider-with-image-content">Canting</h1>
                                                                                                                                        </div> -->
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="product-collection-grid product-grid pd-top-15">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="container mg-bottom-30">
                <div class="row">
                    <div class="col-md-12 mg-bottom-30 mg-top-30">
                        <div class="title_custom text-center">
                            <h1><?php echo e($category->name); ?></h1>
                        </div>
                    </div>
                    <?php $__currentLoopData = $category->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xs-12 col-md-3 product-item">
                            <div class="product-img">
                                <a
                                    href="<?php echo e(route('product.web.detail', ['id' => $product->id, 'name' => Str::slug($product->name)])); ?>"><img
                                        src="<?php echo e(asset('storage/' . $product->productImages[0]->image)); ?>"
                                        alt="<?php echo e($product->name); ?>" class="img-responsive" />
                                </a>
                            </div>
                            <div class="product-info text-center">
                                <div class="link_toko">
                                    <a href="<?php echo e(route('pengrajin.detail', ['id' => $product->user->id, 'name' => Str::slug($product->user->name)])); ?>"
                                        class="text-uppercase"><?php echo e($product->user->name); ?></a>
                                </div>
                                <h3 class="product-title">
                                    <a href="<?php echo e(route('product.web.detail', ['id' => $product->id, 'name' => Str::slug($product->name)])); ?>"
                                        class="text-capitalize"><?php echo e($product->name); ?></a>
                                </h3>
                                <div class="product-price">
                                    <span>Rp<?php echo e($product->sell_price_format); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="text-center">
                    <a href="<?php echo e(route('product.all', ['type' => 'busana', 'category' => Str::slug($category->name)])); ?>"
                        class="btn-loadmore">Lihat Semua Produk
                        &nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right right"></i></a>
                </div>
            </div>
            <?php if($key + 1 != count($categories)): ?>
                <div class="container mg-bottom-30">
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="separator">
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/busana.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1035615/public_html/resources/views/busana.blade.php ENDPATH**/ ?>
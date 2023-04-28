<?php
    $tags['title'] = $product->name;
    $tags['description'] = $product->meta_text ;
    $tags['image'] = $product->thumbnail;
?>


<?php $__env->startSection('title', 'Detail Product'); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/blueimp-gallery.min.css')); ?>">
    <style>
        #wrap{
            padding-top: 120px
        }
        body {
            background: url("<?php echo e(asset('images/background-single-item.jpg')); ?>");
            background-size: contain;
        }

        body:before {
            background: unset;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .mfp-arrow-left { background:url('<?php echo e(asset("plugins/magnific-popup/src/img/prev.png")); ?>') no-Repeat top left !important; width:40px; height:40px; } 
    .mfp-arrow-right { background:url('<?php echo e(asset("plugins/magnific-popup/src/img/next.png")); ?>') no-Repeat top left !important; width:40px; height:40px; }
     .mfp-arrow-left::after,.mfp-arrow-left::before, .mfp-arrow-right::before,.mfp-arrow-right::after { display: none; }

    .text-detail ul {
        list-style: disc;
        padding-left: 30px
    }
</style>
<a href="#wrap" class="btn-top">
    <span class="iconify" data-icon="akar-icons:arrow-up"></span>
</a>
 <section id="section-detail" class="mb-5" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex mb-3">
                    <a href="#description" class="btn-navigate bg-orange px-3 py-1">
                        Description
                    </a>
                    <a href="#specifications" class="btn-navigate px-3 py-1">
                        Specifications
                    </a>
                    <a href="#gallery" class="btn-navigate px-3 py-1">
                        Gallery
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-5 mb-md-0">
                <div class="details ">
                    <h1 class="title  text-white copperplate">
                        <?php echo e($product->name); ?>

                    </h1>
                    <div class="short-desc">  
                        <?php echo $product->text; ?>

                    </div>
                    
                </div>

            </div>
            <div class="col-md-5 offset-md-1">
                <div class="hover-me position-relative custom-cursor">
                    
                    <img src="<?php echo e(asset('storage').'/'.$product->thumbnail_2); ?>" class="w-100 img-details custom-cursor" alt="<?php echo e($product->alt_text); ?>">
                </div>
                <p class="price mt-3 pb-3">IDR <?php echo e(number_format($product->price)); ?></p>
                <span>Price inclusive of VAT ● Shipping costs will be calculated at check out</span>
                <?php if($product->status != 'sold'): ?>
                <div class="row mt-3">
                <div class="col-md-6">
                    <form action="<?php echo e(route('buynow')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product[]" value="<?php echo e(\Crypt::encryptString($product->id)); ?>">
                    </form>
                    <a href="<?php echo e($product->wa_link); ?>"  class="btn cta-product w-100">Buy Now</a>
                </div>
                <?php if(Auth::guard('user')->user()): ?>
                        
                    <div class="col-md-6">
                        <button type="button" class="btn cta-product w-100" onclick="addToCart(`<?php echo e(\Crypt::encryptString($product->code)); ?>`)">Add to Cart </button>
                    </div>
                <?php endif; ?>
            </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<div id="wrap-detail" class="pt-5">
    <section id="section-detail-more">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="description">
                    <p class="detail-more-title">description</p>
                    <div class="desc-more text-white  text-detail ">
                        <?php echo $product->description ?? '-'; ?>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-spec" class="pt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="specifications">
                    <p class="detail-more-title">Specifications</p>
                    <table class="w-100 table-spec">
                        <thead>
                            <tr>
                                <td colspan="2">general</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $general; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->title); ?></td>
                                <td><?php echo e($item->value); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <table class="w-100 table-spec mt-3">
                        <thead>
                            <tr>
                                <td colspan="2">body</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->title); ?></td>
                                <td><?php echo e($item->value); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <table class="w-100 table-spec mt-3">
                        <thead>
                            <tr>
                                <td colspan="2">neck</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $neck; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->title); ?></td>
                                    <td><?php echo e($item->value); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <table class="w-100 table-spec mt-3">
                        <thead>
                            <tr>
                                <td colspan="2">hardware</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $hardware; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->title); ?></td>
                                    <td><?php echo e($item->value); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <table class="w-100 table-spec mt-3">
                        <thead>
                            <tr>
                                <td colspan="2">electronics</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $electronic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($item->title); ?>

                                    </td>
                                    <td><?php echo e($item->value); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <table class="w-100 table-spec mt-3">
                        <thead>
                            <tr>
                                <td colspan="2">miscellaneous</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $miscellaneous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->title); ?></td>
                                    <td class="<?php echo e((strtolower($item->title ) == 'disclosure') ? 'font-italic' : ''); ?>"><?php echo e($item->value); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-3">
                    <p class="text-white">Thanks for looking !</p>
                    <img src="<?php echo e(asset('images/felicity-signature.png')); ?>" width="150" alt="felicity-signature">
                </div>
            </div>
        </div>
    </section>
</div>
<div class="container" id="gallery">
    <h2>Gallery</h2>
</div>
<div class="container my-5">
    <div id="links" class="d-flex flex-wrap">
        <a class="img-gallery" id="img-1" target="_blank" href="<?php echo e(asset('storage/'.$product->thumbnail_2)); ?>" title="<?php echo e($product->name); ?>">
            <img src="<?php echo e(asset('storage/'.$product->thumbnail_2)); ?>" alt="<?php echo e($product->alt_text); ?>" />
        </a>
        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
        <a class="img-gallery"  target="_blank" href="<?php echo e(asset('storage/'.$item->image)); ?>" title="<?php echo e($product->name); ?>">
            <img src="<?php echo e(asset('storage/'.$item->image)); ?>" alt="<?php echo e($product->alt_text); ?>" />
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    </div>
    
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a target="_blank" class="prev"></a>
        <a target="_blank" class="next"></a>
        <a target="_blank" class="close"></a>
        <a target="_blank" class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

</div>
<?php $__env->stopSection(); ?> 

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/detail-product.js')); ?>"></script>
<script src="<?php echo e(asset('js/blueimp-gallery.min.js')); ?>"></script>
<script>
    // $(document).ready(function () {
    //         $("#wrap-detail").hide();
    //     });
    // $("#read-more-detail").click(function () {

    //     $("#wrap-detail").slideToggle();
    //     $(this).hide()
    //     $("#read-less-detail").show()
    // })
    // $('#read-less-detail').hide()
    // $("#read-less-detail").click(function () {

    //     $("#wrap-detail").slideToggle();
    //     $(this).hide()
    //     $("#read-more-detail").show()
    // })
    $('#gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',

                opener: function(openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find(
                        'img');
                }
            },
        gallery: {
          enabled:true,
        }
    });
    var galleryImg
    document.getElementById('links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = { index: link, event: event },
                links = this.getElementsByTagName('a');
        // blueimp.Gallery(links, options);
        galleryImg = blueimp.Gallery(
                links,
                {
                index: link, event: event,
                onopen: function () {
                        // Callback function executed when the Gallery is initialized.
                },
                onopened: function () {
                        // Callback function executed when the Gallery has been initialized
                        // and the initialization transition has been completed.
                },
                onslide: function (index, slide) {
                        //console.log("onslide:"+index);
                        // Callback function executed on slide change.
                        var get_index = index+1;
                        var get_w = $('.indicator').width();
                        var get_item_num = Math.floor(get_w/52)-1;
                        var page_index =  Math.floor(get_index/get_item_num);
                        // console.log("onslideend:"+get_index+"/"+get_w+"num:"+get_item_num+"page:"+page_index);
                        $('.indicator').scrollLeft(page_index*get_w);
                },
                onslideend: function (index, slide) {
                        var get_index = index+1;
                        var get_w = $('.indicator').width();
                        var get_item_num = Math.floor(get_w/52);
                        var page_index =  Math.floor(get_index/get_item_num);
                        console.log("onslideend:"+get_index+"/"+get_w+"num:"+get_item_num+"page:"+page_index);
                        $('.indicator').scrollLeft(page_index*get_w);
                        // Callback function executed after the slide change transition.
                },
                onslidecomplete: function (index, slide) {
                        // Callback function executed on slide content load.
                },
                onclose: function () {
                        // Callback function executed when the Gallery is about to be closed.
                },
                onclosed: function () {
                        // Callback function executed when the Gallery has been closed
                        // and the closing transition has been completed.
                }
                }
        );
    };
    // $('.hover-me').on('mousemove', function(e){
    //     if(e.offsetX > 20 && e.offsetY > 20){
    //         $('.box-hover').css({
    //             left:  e.offsetX + 'px',
    //             top:   e.offsetY + 'px',
    //         });

    //         console.log(e.offsetX);
    //     }
    //     setTimeout(() => {
    //     },);

    // });
    $('.hover-me').on('click', function(){
        $('#img-1').click()
        galleryImg.play()
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app' , ['tags' => $tags ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/private_vault_detail.blade.php ENDPATH**/ ?>
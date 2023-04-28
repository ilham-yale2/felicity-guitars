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
            padding-top: 110px
        }
        body {
            background: unset;
            background-image: url("<?php echo e(asset('images/background-single-item.jpg')); ?>")!important;
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-repeat: repeat-y; 
        }

        body:before {
            background: unset;
        }

        .text-detail p{
            color: white !important;
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
<a href="#wrap" class="btn-top" style="display: none">
    <span class="iconify" data-icon="akar-icons:arrow-up"></span>
</a>
 <section id="section-detail" class="mb-5" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex mb-3">
                    <a href="#description" class="btn-navigate px-3 py-1">
                        Description
                    </a>
                    <a href="#specifications" class="btn-navigate px-3 py-1">
                        Specifications
                    </a>
                    <a href="#gallery" class="btn-navigate px-3 py-1">
                        Photo Gallery
                    </a>
                </div>
            </div>
            <div class="col-md-7 mb-5 mb-md-0 pr-md-0">
                <div class="details ">
                    <h1 class="title  text-white copperplate">
                        <?php echo e($product->name); ?>

                    </h1>
                    <div class="short-desc">  
                         <?php echo $product->text; ?>

                    </div>
                    
                </div>

            </div>
            <div class="col-md-5 pl-md-5">
                <div class="hover-me position-relative text-center col-md-11 ml-md-auto pr-md-0" >
                    <a class="show-thumbnail" href="<?php echo e(asset('storage').'/'.$product->thumbnail_2); ?>" style="cursor: zoom-in!important;" target="_blank">
                        <img src="<?php echo e(asset('storage').'/'.$product->thumbnail_2); ?>" class="img-details " alt="<?php echo e($product->alt_text); ?>">
                    </a>
                </div>
                <?php if($product->status != 'sold'): ?>
                    <div class="col-md-11 pr-md-0 ml-md-auto">
                        <div class="d-flex align-items-center py-1">
                            <div class="col-md-6 text-center">
                                <p class="copperplate price">USD <?php echo e(number_format($product->price)); ?></p>
                            </div>
                            <?php if(Auth::guard('user')->user()): ?>
                                    
                                <div class="col-md-6">
                                    <div class="copperplate price text-center" onclick="addToCart(`<?php echo e(\Crypt::encryptString($product->code)); ?>`)">Add to Cart </div>
                                </div>
                            <?php else: ?>
                                <div class="col-md-6">
                                    <a  href="#" class="copperplate price text-center disabled" onclick="loginMessage()" >Add to Cart </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-11 pr-md-0 ml-md-auto">
                    <p class="text-center vat main-color"><i>Shipping will be calculated at check out</i></p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container" id="gallery">
    <p class="detail-more-title main-color">Photo Gallery</p>
</div>
<div class="container my-5">
    <div id="links" class="d-flex flex-wrap">
        
        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <a class="img-gallery"  target="_blank" href="<?php echo e(asset('storage/'.$item->image)); ?>">
                <img src="<?php echo e(asset('storage/'.$item->thumbnail)); ?>" alt="<?php echo e($product->alt_text); ?>" />
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
<div id="wrap-detail">
    <section id="section-detail-more">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="description">
                    <p class="detail-more-title">description</p>
                    <div class="desc-more text-detail ">
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
                    <div class="">
                        <?php if($detail->general): ?>
                            <h4 class="mb-0 text-uppercase text-gold" >
                                General
                            </h4>
                            <div class="table-spec">
                                <?php echo $detail->general; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <?php if($detail->body): ?>
                            <h4 class="mb-0 text-uppercase text-gold" >
                                body
                            </h4>
                            <div class="table-spec">
                                <?php echo $detail->body; ?>    
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <?php if($detail->neck): ?>
                            <h4 class="mb-0 text-uppercase text-gold" >
                                neck
                            </h4>
                            <div class="table-spec">
                                <?php echo $detail->neck; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <?php if($detail->hardware): ?>
                            <h4 class="mb-0 text-uppercase text-gold" >
                                hardware
                            </h4>
                            <div class="table-spec">
                                <?php echo $detail->hardware; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <?php if($detail->electronic): ?>
                            <h4 class="mb-0 text-uppercase text-gold" >
                                electronics
                            </h4>
                            <div class="table-spec">
                                <?php echo $detail->electronic; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="">
                        <?php if($detail->miscellaneous): ?>
                            <h4 class="mb-0 text-uppercase text-gold" >
                                miscellaneous
                            </h4>
                            <div class="table-spec">
                                <?php echo $detail->miscellaneous; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <p class="text-white">Thanks for looking !</p>
                    <img src="<?php echo e(asset('images/felicity-signature.png')); ?>" width="150" alt="felicity-signature">
                </div>
                <img src="<?php echo e(asset('images/rose_and_guitar_pick.png')); ?>" class="col-md-7 col-11 mx-auto"alt="">
                
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/detail-product.js')); ?>"></script>
<script src="<?php echo e(asset('js/blueimp-gallery.min.js')); ?>"></script>
<script>
    var product_type =  '<?php echo e($product_type); ?>'
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
                    index: link, 
                    event: event,
                    slideshowInterval: 2000,
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
                            $('.indicator').
                            Left(page_index*get_w);
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
 
    $('.show-thumbnail').magnificPopup({
        type: 'image'
    });
    $(window).scroll(function(){
		if ($(this).scrollTop()>300){
			$('.btn-top').fadeIn('slow');
		}else{
			$('.btn-top').fadeOut('slow');
		}
		
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app' , ['tags' => $tags ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/page-detail/guitar.blade.php ENDPATH**/ ?>
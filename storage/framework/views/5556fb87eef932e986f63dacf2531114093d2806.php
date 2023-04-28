<?php
$users = App\User::orderBy('name', 'asc')->get();
$setting = App\Setting::first();
$format_number = explode('08', $setting->phone);
$format_number = '628' . $format_number[1];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta itemprop="name" content="<?php echo $__env->yieldContent('title'); ?> - <?php echo e($setting->name); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title'); ?> - <?php echo e($setting->name); ?>">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('title'); ?> - <?php echo e($setting->name); ?>">
    <meta property="og:url" content="<?php echo e(Request::url()); ?>">
    
    
    <meta name="description" content="<?php echo e($setting->description); ?>">
    <meta name="keyword" content="<?php echo e($setting->seo_keyword); ?>">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="description" content="<?php echo e($tags['description'] ?? $setting->description); ?>">
    <meta itemprop="image" content="<?php echo e(asset('storage')); ?>/<?php echo e($tags['image'] ?? $setting->image); ?>">

    <!-- Facebook Meta Tags -->

    <meta property="og:url" content="<?php echo e(route('index')); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($tags['title'] ?? $setting->name); ?>">
    <meta property="og:description" content="<?php echo e($tags['description'] ?? $setting->description); ?>">
    <meta property="og:image" content="<?php echo e(asset('storage')); ?>/<?php echo e($tags['image'] ?? $setting->image); ?>?time=1656324492">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="<?php echo e($tags['description'] ?? $setting->description); ?>">
    <meta name="twitter:image" content="<?php echo e(asset('storage')); ?>/<?php echo e($tags['image'] ?? $setting->image); ?>">

    


    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e($setting->name); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('images/logo-felicity.png')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/plugins.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome/css/all.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/main-mobile.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('plugins/magnific-popup/dist/magnific-popup.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
    <script>
        const base_url = "<?php echo e(url('')); ?>";
        const token = "<?php echo e(csrf_token()); ?>";
    </script>
</head>

<body>
    <?php
        if(isset($background)){
            $b = $background;
        }else{
            $b = "background-single-item.jpg";
        }

        if (isset($subject)) {
            $s = $subject;
        }else{
            $s = 'Guitar';
        }
    ?>
    <style>
        input,textarea, select{
            color: white!important;
            background: transparent!important
        }
        input:focus, textarea:focus, select:focus{
            background: rgba(0, 0, 0, 0.45)!important;
        }
        .btn-primary.disabled, .btn-primary:disabled{
            background-color: #CC6500 
        }

        .btn-primary:hover{
            background-color: #cc6600c9
        }
        body{
            background-image: url('<?php echo e(asset("images")); ?>/<?php echo e($b); ?>');
        }
    </style>

    <div id="wrap">
        <header class="header" id="header">
            <div class="container">
                <div class="header_top">
                    <div class="row">
                        <div class="col-md-3"><a class="header_logo" href="<?php echo e(route('index')); ?>"><img
                                    src="<?php echo e(asset('images/logo-felicity.png')); ?>" /></a></div>
                        <div class="col-md-6">
                            <div class="header_search">
                                <form action="<?php echo e(route('search')); ?>">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="keyword"
                                            placeholder="search" />
                                        <button type="submit"><img src="<?php echo e(asset('images/ic-search.svg')); ?>"
                                                alt="ic-search" class="ml-2" /></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="header_right align-items-center">
                                <div class="header_right-icon"><a href="<?php echo e(route('contact')); ?>">
                                        <img src="<?php echo e(asset('images/ic-call.svg')); ?>" alt="icon" /></a></div>
                                <div class="header_right-currency">
                                    <select class="select">
                                        <option value="USD">USD</option>
                                        <option value="IDR">IDR</option>
                                    </select>
                                </div>
                                <div class="header_right-icon"><a href="<?php echo e(route('cart')); ?>">
                                        <img src="<?php echo e(asset('images/ic-cart.svg')); ?>" alt="icon" /></a></div>
                                <div class="header_right-icon">
                                    <?php if(Auth::guard('user')->user()): ?>
                                        <ul class="menu-wrap align-items-center">
                                            <li class="has-sub pb-0">
                                                <a href="#">
                                                    <img src="<?php echo e(asset('images/ic-user.svg')); ?>" alt="icon" />
                                                </a>
                                                <div class="submenu">
                                                    <ul>
                                                        <li><a href="<?php echo e(route('account-page')); ?>">Profile</a></li>
                                                        <li><a href="#" onclick="logout()">Logout</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('sign-in')); ?>"
                                            class="py-1 px-3 text-light border border-light bg-transparent">
                                            Login</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_menu">
                    <ul class="menu-wrap">
                        <li class="has-sub position-relative"><a href="#">Browse by Category</a>
                            <div class="submenu">
                                <?php $categories = \App\Category::orderBy('id', 'ASC')->get();?>
                                <ul>
                                    <li class="more-guitars d-flex pb-md-2 mb-0">
                                        <a href="#"><span class="mr-4">Guitars</span><span class="iconify text-white" data-icon="ant-design:caret-right-filled"></span>
                                        </a>
                                        <div class="multi-sub position-absolute" >
                                            <div class="sub-multi">
                                                <ul>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a href="<?php echo e(route('browse-category')); ?>?subject=Guitar&ctg=<?php echo e($c->name); ?>"><?php echo e($c->name); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e(route('browse-category')); ?>?subject=Guitar">All Guitars</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-1"><a href="<?php echo e(route('browse-category')); ?>?subject=Amplifiers">Amplifiers</a></li>
                                    <li class="mb-1"><a href="<?php echo e(route('browse-category')); ?>?subject=Effects Pedals">Effects Pedals</a></li>
                                    <li class="mb-1"><a href="<?php echo e(route('browse-category')); ?>?subject=Parts-Accessories">Parts / Accessories</a></li>
                                    <li class="mb-1"><a href="<?php echo e(route('browse-category')); ?>?subject=Vintage Stuff">Vintage Stuff</a></li>
                                    <li class="mb-1"><a href="<?php echo e(route('about-us')); ?>#luthierService">Luthier Services</a></li>
                                    <li class="mb-1"><a href="<?php echo e(route('browse-category')); ?>?subject=Merch-Apparel">Merch / Apparel</a></li>
                                    <li class="mb-1"><a href="<?php echo e(route('browse-category')); ?>?subject=Exotic-Instruments">Exotic Instruments</a></li>
                                    
                                </ul>
                            </div>
                        </li>
                        <li class="has-sub position-relative"><a href="#">Browse by Brand</a>
                            <div class="submenu">
                                <?php $brands = \App\Brand::orderBy('id', 'ASC')->get();?>
                                <ul>
                                    <li class="mb-3 text-orange">Guitar Brands</li>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($b->brand_of == 'guitar'): ?>
                                            <li class="mb-1"><a href="<?php echo e(route('browse-brand')); ?>?subject=<?php echo e($s); ?>&brd=<?php echo e($b->name); ?>"><?php echo e($b->name); ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="more-brand d-flex pt-md-3">
                                        <a href="#">
                                            <span>More Brands</span><span class="iconify text-white ml-4" data-icon="ant-design:caret-right-filled"></span>
                                        </a>
                                        <div class="multi-sub-2 position-absolute" >
                                            <div class="sub-multi">
                                                <ul>
                                                    <li class="mb-3 text-orange">    
                                                        Amplifier Brands
                                                    </li>
                                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($b->brand_of == 'amplifier'): ?>
                                                            <li class="mb-1"><a href="<?php echo e(route('browse-brand')); ?>?subject=Amplifier&brd=<?php echo e($b->name); ?>"><?php echo e($b->name); ?></a></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="my-3 text-orange">    
                                                        Pedal Brands
                                                    </li>
                                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($b->brand_of == 'effect_pedals'): ?>
                                                            <li class="mb-1"><a href="<?php echo e(route('browse-brand')); ?>?subject=Effect-Pedals&brd=<?php echo e($b->name); ?>"><?php echo e($b->name); ?></a></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="<?php echo e(route('private-vault')); ?>">Private Vault</a></li>
                        <li><a href="<?php echo e(route('user.trade')); ?>">Sell & Trade</a></li>
                        <li><a href="<?php echo e(route('about-us')); ?>">About Us</a></li>
                        
                    </ul>
                </div>
                <div class="mobile-menu"><span></span><span></span><span></span></div>

            </div>
        </header>
        <main>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <footer class="footer" id="footer">
            <div class="footer_top">
                <div class="container">
                    <div class="footer_wrap">
                        <div class="row">
                            <div class="col-md-5 left">
                                <div class="footer_menu">
                                    <ul>
                                        <li><a href="/">Home</a></li>
                                        <li><a href="#">Search</a></li>
                                        <li><a href="<?php echo e(route('privacy-policy')); ?>">Privacy Policy</a></li>
                                        <li><a href="<?php echo e(route('about-us')); ?>#sales">Terms of Service</a></li>
                                    </ul>
                                </div>
                                <div class="footer_contact">
                                    <h4>Contact</h4>
                                    <div class="d-flex align-items-center mb-2 w-100">
                                        <img src="<?php echo e(asset('images/maps.png')); ?>" width="27" alt="">
                                        <span class="ml-2"><a href="https://goo.gl/maps/riWY27Z8nBwu5sGk9">See us on Google Maps</a></span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 w-100">
                                        <img src="<?php echo e(asset('images/telephone.png')); ?>" width="27" alt="">
                                        <span class="ml-2">(+62) 8129198096</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 w-100">
                                        <img src="<?php echo e(asset('images/whatsapp.png')); ?>" width="27" alt="">
                                        <span class="ml-2">(+62) 811100745</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2 w-100">
                                        <img src="<?php echo e(asset('images/envelope.png')); ?>" width="27" alt="">
                                        <span class="ml-2"><a href="mailto:felicitys.guitars@gmail.com" class="text-gold">felicitys.guitars@gmail.com</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 right">
                                <div class="footer_subs">
                                    <p>Sign Up to Get Special Discounts and <br>Once-in-a-lifetime Deals</p>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="enter your email" />
                                    </div>
                                </div>
                                <div class="footer_logo">
                                    <img src="<?php echo e(asset('images/logo-footer-felicity.png')); ?>" alt="logo-footer" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom bg-transparent">
                <div class="container">
                    <p>Serving Guitar Aficionados and Musicians Worldwide | © 2021. Felicitys-Guitars.com - All Rights
                        Reserved
                    </p>
                </div>
            </div>
            <form action="<?php echo e(route('user.logout')); ?>" method="POST" id="formLogout">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
            </form>
        </footer>
    </div>

    <script src="<?php echo e(asset('plugins/jquery/jquery-3.4.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bootstrap/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/owl.carousel/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/lity/lity.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/autosize/autosize.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/magnific-popup/dist/jquery.magnific-popup.js')); ?>"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.13/dist/sweetalert2.all.min.js"></script>
    <?php echo $__env->yieldContent('js'); ?>
    <script src="<?php echo e(asset('js/mainJs.js')); ?>"></script>
    <?php if(session()->has('message')): ?>
    <script>
        var type = "<?php echo e(session()->get('message')['status']); ?>"
        if(type == 'success'){
            var title = 'Well Done...'
        }else{
            var title = "Oops..."
        }
        setTimeout(() => {
            Swal.fire({
                icon: type,
                title: title,
                text: "<?php echo e(session()->get('message')['text']); ?>",
            })
        }, 1000);
    </script>
    <?php endif; ?>
    <script>
         $('.number').on('keyup', function(){
            var value = $(this).val().replace(/[^,\d]/g, '')
            $(this).val(value)
        })
        function logout(){
            $('#formLogout').submit()
        }
        $('.mobile-menu').click(function(){
            $('body').toggleClass('menu-open')
        })

        // $('.more-brand').click(function(){
        //     $('.multi-sub').toggleClass('open')
        // })
        // $('.more-guitars').click(function(){
        //     $('.multi-sub-2').toggleClass('open')
        // })

        // // $('#wrap').mouseenter(function(){
        // //     $('.multi-sub').removeClass('open')
        // //     console.log($('.multi-sub'));
        // // })
        
    </script>
</body>

</html>
<?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/layout/app.blade.php ENDPATH**/ ?>
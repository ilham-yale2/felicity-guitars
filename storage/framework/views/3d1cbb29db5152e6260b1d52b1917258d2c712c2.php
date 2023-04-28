<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('page', ' Amplifier > Edit'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .mt-input{
        margin-top: 31px;
    }
</style>
    <div class="col-lg-12 col-12 layout-spacing">
        <h3 calss="mb-2">Edit Amplifier</h3>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="<?php echo e(route('amplifier.update', ['amplifier' => $amplifier->id])); ?>" method="POST"
                    enctype="multipart/form-data" id="product-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="name">Amplifier Name (Single View)</label>
                                <input type="text" class="form-control" id="name" value="<?php echo e($amplifier->name); ?>" name="name" placeholder="Product Name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="name">Product Name (Multi View)</label>
                                <input type="text" class="form-control" id="name" value="<?php echo e($amplifier->name_2); ?>" name="name_2" placeholder="Product Name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" required id="brand_id" class="form-control select2" required>
                                    <option value="">Select Brand</option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->id); ?>"
                                            <?php if($b->id == $amplifier->brand_id): ?> selected <?php endif; ?>><?php echo e($b->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4" >
                                <label for="price">Price (IDR)</label>
                                <input type="tel" required  class="form-control money text-right" id="price" name="price"
                                    placeholder="" value="<?php echo e($amplifier->price); ?>"  onkeyup="getSellPrice()">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="meta_text">Meta Text</label>
                                <input type="text" class="form-control" name="meta_text" value="<?php echo e($amplifier->meta_text); ?>" required id="meta_text">
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="alt_text">Alt Text</label>
                                <input type="text" class="form-control" name="alt_text" required id="alt_text" value="<?php echo e($amplifier->alt_text); ?>">
                            </div>
                        </div>       
                        
                        <div class="col-md-4">
                            <div class="form-group" style="padding-bottom: 1.5rem !important">
                                <label for="code">Code</label>
                                <input type="text" id="fakecode" name="code" class="form-control select2"
                                    readonly value="<?php echo e($amplifier->code); ?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="custom-control custom-switch custom-switch-md" style="margin-top: 2.5rem !important;">
                                <input type="checkbox" name="sold" class="custom-control-input" id="customSwitch1" value="sold" <?php if($amplifier->status == 'sold'): ?> checked <?php endif; ?>> 
                                <label class="custom-control-label" for="customSwitch1">Sold Out</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="thumbnail-2">Thumbnail (Single View)</label>
                                <input type="file" name="thumbnail_2" class="form-control-file" id="thumbnail-2" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="thumbnail">Thumbnail (Multi View)</label>
                                <input type="file" name="thumbnail" class="form-control-file" id="thumbnail" >
                            </div>
                        </div>
                        
                        <div class="col-md-6 text-center">
                            <img class="w-100" src="<?php echo e(asset('storage/'.$amplifier->thumbnail_2)); ?>" id="preview-photo2" alt="">
                        </div>
                        <div class="col-md-6 text-center preview">
                            <img class="w-100" src="<?php echo e(asset('storage/'.$amplifier->thumbnail)); ?>" id="preview-photo" alt="">
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="w-100 d-flex">
                                <button class="btn btn-danger ml-auto" type="button" onclick="$('#deleleAll').submit()">
                                    Delete All Image
                                </button>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Photos</label>
                                <table id="zero-config" class="table style-3 table-hover">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $amplifier_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="image-<?php echo e($image->id); ?>">
                                            <th scope="row"><?php echo e($loop->iteration); ?></th>
                                            <td>
                                                <a href="<?php echo e(asset('storage/'.$image->image)); ?>" class="showImage" target="_blank">
                                                    <img src="<?php echo e(asset('storage').'/'.$image->thumbnail); ?>" style="width: 80px" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger px-3 py-1" type="button" onclick="deleteImage(<?php echo e($image->id); ?>)" >Delete</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-field">
                                <label class="active">Add Photo</label>
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                        <style>
                            #short-desc p{
                                margin-bottom: 0px!important;

                            }
                            #short-desc ul{
                                padding-inline-start: 17px!important;
                            }
                        </style>
                        <div class="col-md-12 mt-4" id="short-desc">
                            <div class="form-group mb-4">
                                <label for="text">Text</label>
                                <textarea class="form-control summernote-color" rows="3" name="text"
                                 id="text"><?php echo e($amplifier->text); ?></textarea>
                            </div>
                        </div>
                        
                       
                        <h4 class="col-12 mt-5 mb-2 text-center">Description Product</h4>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote" rows="3" name="description"
                                 id="description"><?php echo e($amplifier->description); ?></textarea>
                            </div>
                        </div>


                        <h4 class="mt-5 text-center w-100">Filter Needs</h4>
                        <p class="col-12"><i class="text-danger w-100 ">*The column below is for filter needs only</i></p>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control   select2" required>
                                    <option selected disabled>Select Type</option>
                                    <option value="1"  <?php if($amplifier->type == 1): ?> selected <?php endif; ?>>Solid Body</option>
                                    <option value="2"  <?php if($amplifier->type == 2): ?> selected <?php endif; ?>>Semi-hollowbody</option>
                                    <option value="3"  <?php if($amplifier->type == 3): ?> selected <?php endif; ?>>Offset</option>
                                    <option value="4"  <?php if($amplifier->type == 4): ?> selected <?php endif; ?>>Hollowbody</option>
                                    <option value="5"  <?php if($amplifier->type == 5): ?> selected <?php endif; ?>>Acoustic</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country of Origin</label>
                                <select name="country" id="country" class="form-control   select2" required>
                                    <option selected disabled>Select Country</option>
                                    <option value="1"  <?php if( $amplifier->country == "1"): ?> selected <?php endif; ?>>Custom</option>
                                    <option value="2"  <?php if( $amplifier->country == "2"): ?> selected <?php endif; ?>>Memphis</option>
                                    <option value="3"  <?php if( $amplifier->country == "3"): ?> selected <?php endif; ?>>Montana</option>
                                    <option value="4"  <?php if( $amplifier->country == "4"): ?> selected <?php endif; ?>>U.S.A</option>
                                    <option value="5"  <?php if( $amplifier->country == "5"): ?> selected <?php endif; ?>>Mexico</option>
                                    <option value="6"  <?php if( $amplifier->country == "6"): ?> selected <?php endif; ?>>China</option>
                                    <option value="7"  <?php if( $amplifier->country == "7"): ?> selected <?php endif; ?>>Custom Historic</option>
                                    <option value="8"  <?php if( $amplifier->country == "8"): ?> selected <?php endif; ?>>Japan</option>
                                    <option value="9"  <?php if( $amplifier->country == "9"): ?> selected <?php endif; ?>>Korea</option>
                                    <option value="10"  <?php if( $amplifier->country == "10"): ?> selected <?php endif; ?>>Indonesia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <select name="condition" id="condition" class="form-control  select2" required>
                                    <option selected disabled>Select Condition</option>
                                    <option value="1" <?php if( $amplifier->condition == "1"): ?> selected <?php endif; ?>>New</option>
                                    <option value="2" <?php if( $amplifier->condition == "2"): ?> selected <?php endif; ?>>Used</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="year"> Year </label>
                                <input name="year" value="<?php echo e($amplifier->year); ?>" id="year" class=" year form-control" />   
                            </div>
                        </div>


                        <h4 class="col-12 mt-5 mb-2 text-center">Specification Product</h4>
                        <div class="col-12 mt-4 d-flex align-items-end mb-4">
                            <h5 class="mb-0">General</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="general" class="form-control summernote"  id=""rows="10"><?php echo e($detail->general); ?></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Body</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="body" class="form-control summernote"  id=""rows="10"><?php echo e($detail->body); ?></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Neck</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="neck" class="form-control summernote"  id=""rows="10"><?php echo e($detail->neck); ?></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Hardware</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="hardware" class="form-control summernote"  id=""rows="10"><?php echo e($detail->hardware); ?></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Electronic</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="electronic" class="form-control summernote"  id=""rows="10"><?php echo e($detail->electronic); ?></textarea>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Miscellaneous</h5>
                        </div>
                        <div class="col-md-12">
                            <textarea name="miscellaneous" class="form-control summernote"  id=""rows="10"><?php echo e($detail->miscellaneous); ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-danger mt-3" href="<?php echo e(route('product.index')); ?>"><i
                                    class="flaticon-cancel-12"></i> Back</a>
                            <button type="submit"  class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form action="<?php echo e(route('delete-all-amplifier-image', ['id' => $amplifier->id])); ?>" class="w-100 d-flex" id="deleleAll" method="POST">
        <?php echo csrf_field(); ?>
        
    </form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <?php if(\Session::has('message')): ?>
        <?php
            $message = \Session::get('message');
        ?>
        <script>
            
            setTimeout(() => {
                Swal.fire({
                    icon: "<?php echo e($message['icon']); ?>",
                    title: "<?php echo e($message['title']); ?>",
                    text: "<?php echo e($message['text']); ?>",
                })
            }, 1000);
        </script>   
         
    <?php endif; ?>
    <script src="<?php echo e(asset('js/amplifier.js')); ?>"></script>
    <script type="text/javascript">
        
        $('.input-images-1').imageUploader({
            extensions: ['.jpg', '.jpeg', '.png'],
            mimes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
            maxSize: undefined,
            maxFiles: 10,
        });

        $('.showImage').magnificPopup({
            type: 'image'
            // other options
        });
        
        
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/amplifier/edit.blade.php ENDPATH**/ ?>
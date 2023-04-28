<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('page', ' Private Vault > Edit'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .mt-input{
        margin-top: 31px;
    }
</style>
    <div class="col-lg-12 col-12 layout-spacing">
        <h3 calss="mb-2">Edit Product</h3>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="<?php echo e(route('vault.update', ['admin_private_vault' => $product->id])); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="name">Product Name (Single View)</label>
                                <input type="text" class="form-control" id="name" value="<?php echo e($product->name); ?>" name="name" placeholder="Nama Produk"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="name_2">Product Name (Multi View)</label>
                                <input type="text" class="form-control" id="name_2" value="<?php echo e($product->name_2); ?>" name="name_2" placeholder="Nama Produk"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" required id="brand_id" class="form-control select2" required>
                                    <option value="">Select Brand</option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->id); ?>"
                                            <?php if($b->id == $product->brand_id): ?> selected <?php endif; ?>><?php echo e($b->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control select2" required
                                     required>
                                    <option value="">Select Category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ctg->id); ?>" <?php if($ctg->id == $product->category_id): ?> selected <?php endif; ?>> <?php echo e($ctg->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="meta_text">Meta Text</label>
                                <input type="text" class="form-control" name="meta_text" value="<?php echo e($product->meta_text); ?>" required id="meta_text">
                            </div>
                        </div>              
                        <div class="col-md-4">
                            <div class="form-group mb-4" >
                                <label for="price">Price (IDR)</label>
                                <input type="tel" required  class="form-control money text-right" id="price" name="price"
                                    placeholder="" value="<?php echo e($product->price); ?>"  onkeyup="getSellPrice()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="disc" >Discount</label>
                                <input  type="text" required size="4" maxlength="3" class="form-control discount text-right" id="disc" name="discount" placeholder="Diskon (%)"
                                    value="0" value="<?php echo e($product->discount); ?>" onkeyup="getSellPrice()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="price">Sell Price</label>
                                <input type="text" class="form-control" id="sell_price" name="sell_price" required=""
                                    readonly value="<?php echo e($product->sell_price); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="padding-bottom: 1.5rem !important">
                                <label for="code">Code</label>
                                <input type="text" id="fakecode" name="code" class="form-control select2"
                                    readonly value="<?php echo e($product->code); ?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="custom-control custom-switch custom-switch-md" style="margin-top: 2.5rem !important;">
                                <input type="checkbox" name="sold" class="custom-control-input" id="customSwitch1" value="sold" <?php if($product->status == 'sold'): ?> checked <?php endif; ?>> 
                                <label class="custom-control-label" for="customSwitch1">Sold Out</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="thumbnail">Thumbnail 1</label>
                                <input type="file" name="thumbnail" class="form-control-file" id="thumbnail" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="thumbnail">Thumbnail 2</label>
                                <input type="file" name="thumbnail_2" class="form-control-file" id="thumbnail-2" >
                            </div>
                        </div>
                       
                        <div class="col-md-6 text-center preview">
                            <img class="w-100" src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" id="preview-photo" alt="">
                        </div>
                        <div class="col-md-6 text-center preview">
                            <img class="w-100" src="<?php echo e(asset('storage/'.$product->thumbnail_2)); ?>" id="preview-photo2" alt="">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="text">Text</label>
                                <textarea class="form-control summernote-color" rows="3" name="text"
                                 id="text"><?php echo e($product->text); ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
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
                                        <?php $__currentLoopData = $product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="image-<?php echo e($image->id); ?>">
                                            <th scope="row"><?php echo e($loop->iteration); ?></th>
                                            <td>
                                                <img src="<?php echo e(asset('storage').'/'.$image->image); ?>" style="width: 80px" alt="">
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
                        <div class="col-md-6">
                            <img src="<?php echo e(asset('storage/'.$product->image)); ?>" id="preview-photo" alt="">
                        </div>
                        <h4 class="col-12 mt-5 mb-2 text-center">Description Product</h4>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote" rows="3" name="description"
                                 id="description"><?php echo e($product->description); ?></textarea>
                            </div>
                        </div>
                        
                        <h4 class="col-12 mt-5 mb-2 text-center">Specification Product</h4>
                        <div class="col-12 mt-4 d-flex align-items-end mb-4">
                            <h5 class="mb-0">General</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="general-title">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group mb-4">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control " id="general-value">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary ml-3 py-1 px-2" type="button" onclick="addColumn('general')">
                                        <span class="iconify" data-icon="fluent:add-12-filled"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="general">
                                <?php $__currentLoopData = $general; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_title[]" class="form-control" value="<?php echo e($item->title); ?>">
                                            <input type="hidden" name="old_id[]" value="<?php echo e($item->id); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-7 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_value[]" value="<?php echo e($item->value); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="old-<?php echo e($item->id); ?>">
                                        <button class="btn btn-danger ml-3 py-1 px-2" type="button" onclick="deleteDetail('<?php echo e($item->id); ?>')">
                                        <span class="iconify" data-icon="ic:round-remove"></span>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Body</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="body-title">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group mb-4">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control " id="body-value">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary ml-3 py-1 px-2" type="button" onclick="addColumn('body')">
                                        <span class="iconify" data-icon="fluent:add-12-filled"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="body">
                                <?php $__currentLoopData = $body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_title[]" class="form-control" value="<?php echo e($item->title); ?>">
                                            <input type="hidden" name="old_id[]" value="<?php echo e($item->id); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-7 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_value[]" value="<?php echo e($item->value); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="old-<?php echo e($item->id); ?>">
                                        <button class="btn btn-danger ml-3 py-1 px-2" type="button" onclick="deleteDetail('<?php echo e($item->id); ?>')">
                                        <span class="iconify" data-icon="ic:round-remove"></span>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Neck</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="neck-title">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group mb-4">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control " id="neck-value">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary ml-3 py-1 px-2" type="button" onclick="addColumn('neck')">
                                        <span class="iconify" data-icon="fluent:add-12-filled"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="neck">
                                <?php $__currentLoopData = $neck; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_title[]" class="form-control" value="<?php echo e($item->title); ?>">
                                            <input type="hidden" name="old_id[]" value="<?php echo e($item->id); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-7 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_value[]" value="<?php echo e($item->value); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="old-<?php echo e($item->id); ?>">
                                        <button class="btn btn-danger ml-3 py-1 px-2" type="button" onclick="deleteDetail('<?php echo e($item->id); ?>')">
                                        <span class="iconify" data-icon="ic:round-remove"></span>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Hardware</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="hardware-title">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group mb-4">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control " id="hardware-value">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary ml-3 py-1 px-2" type="button" onclick="addColumn('hardware')">
                                        <span class="iconify" data-icon="fluent:add-12-filled"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="hardware">
                                <?php $__currentLoopData = $hardware; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_title[]" class="form-control" value="<?php echo e($item->title); ?>">
                                            <input type="hidden" name="old_id[]" value="<?php echo e($item->id); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-7 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_value[]" value="<?php echo e($item->value); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="old-<?php echo e($item->id); ?>">
                                        <button class="btn btn-danger ml-3 py-1 px-2" type="button" onclick="deleteDetail('<?php echo e($item->id); ?>')">
                                        <span class="iconify" data-icon="ic:round-remove"></span>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Electronic</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="electronic-title">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group mb-4">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control " id="electronic-value">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary ml-3 py-1 px-2" type="button" onclick="addColumn('electronic')">
                                        <span class="iconify" data-icon="fluent:add-12-filled"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="electronic">
                                <?php $__currentLoopData = $electronic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_title[]" class="form-control" value="<?php echo e($item->title); ?>">
                                            <input type="hidden" name="old_id[]" value="<?php echo e($item->id); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-7 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_value[]" value="<?php echo e($item->value); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="old-<?php echo e($item->id); ?>">
                                        <button class="btn btn-danger ml-3 py-1 px-2" type="button" onclick="deleteDetail('<?php echo e($item->id); ?>')">
                                        <span class="iconify" data-icon="ic:round-remove"></span>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="col-12 mt-4 d-flex mb-4">
                            <h5 class="mb-0">Miscellaneous</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="miscellaneous-title">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group mb-4">
                                        <label for="value">Value</label>
                                        <input type="text" class="form-control " id="miscellaneous-value">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary ml-3 py-1 px-2" type="button" onclick="addColumn('miscellaneous')">
                                        <span class="iconify" data-icon="fluent:add-12-filled"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row" id="miscellaneous">
                                <?php $__currentLoopData = $miscellaneous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_title[]" class="form-control" value="<?php echo e($item->title); ?>">
                                            <input type="hidden" name="old_id[]" value="<?php echo e($item->id); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-7 old-<?php echo e($item->id); ?>">
                                        <div class="form-group mb-2">
                                            <input type="text" name="old_value[]" value="<?php echo e($item->value); ?>" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="old-<?php echo e($item->id); ?>">
                                        <button class="btn btn-danger ml-3 py-1 px-2" type="button" onclick="deleteDetail('<?php echo e($item->id); ?>')">
                                        <span class="iconify" data-icon="ic:round-remove"></span>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                         
                         
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-danger mt-3" href="<?php echo e(route('product.index')); ?>"><i
                                    class="flaticon-cancel-12"></i> Back</a>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <?php if(\Session::has('images')): ?>
        <script>
            
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops ...!',
                    text: "<?php echo \Session::get('images'); ?>",
                })
            }, 1000);
        </script>    
    <?php endif; ?>
    <script src="<?php echo e(asset('js/product.js')); ?>"></script>
    <script type="text/javascript">
      
        $('.input-images-1').imageUploader();

        function deleteImage(id) {
            Swal.fire({
                title: `Are you sure to delete this image?`,
                text: 'Deleted data cannot be restored' ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(id);
                    $.ajax({
                        url: `${base_url}/private-vault/delete-image`,
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": token,
                        },
                        data: {
                            id: id,
                        },
                        success: function (response) {
                            if(response.type == 'success'){
                                Swal.fire({
                                    icon: response.type,
                                    title: response.title,
                                    text: response.text,
                                })
                                $("#image-" + id).remove();
                            }
                            
                        },
                    });
                }
            });
        
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/intives1/felicityguitars.intivestudio.com/resources/views/private-vault/edit.blade.php ENDPATH**/ ?>
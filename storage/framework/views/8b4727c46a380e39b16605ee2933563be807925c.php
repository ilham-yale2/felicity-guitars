

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('page', ' Product > Edit'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .custom-switch.custom-switch-md .custom-control-label {
            padding-left: 2rem;
            padding-bottom: 1.5rem;
        }

        .custom-switch.custom-switch-md .custom-control-label::before {
            height: 1.5rem;
            width: calc(2rem + 0.75rem);
            border-radius: 3rem;
        }

        .custom-switch.custom-switch-md .custom-control-label::after {
            width: calc(1.5rem - 4px);
            height: calc(1.5rem - 4px);
            border-radius: calc(2rem - (1.5rem / 2));
        }

        .custom-switch.custom-switch-md .custom-control-input:checked~.custom-control-label::after {
            transform: translateX(calc(1.5rem - 0.25rem));
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
                <form action="<?php echo e(route('product.update', ['product' => $product->id])); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" value="<?php echo e($product->name); ?>" name="name" placeholder="Nama Produk"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                                    readonly value="<?php echo e(number_format($product->sell_price)); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="padding-bottom: 1.5rem !important">
                                <label for="code">Code</label>
                                <input type="text" id="fakecode" name="code" class="form-control select2"
                                    readonly value="<?php echo e($product->code); ?>">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group mb-4">
                                <label for="thumbnail">Thumbnail Product</label>
                                <input type="file" name="thumbnail" class="form-control-file" id="thumbnail" >
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="<?php echo e(asset('storage/'.$product->thumbnail)); ?>" id="preview-photo" alt="">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="text">Text</label>
                                <textarea class="form-control summernote" rows="3" name="text"
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
                         
                         <h4 class="col-12 mt-5 mb-2 text-center">Specification Product</h4>
                         <div class="col-12 mt-4"><h5>General</h5></div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="condition">Condition</label>
                                 <input type="text" value="<?php echo e($detail->condition); ?>" name="condition" class="form-control" id="condition" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="number_of_strings">Number Of String</label>
                                 <input type="text" value="<?php echo e($detail->number_of_strings); ?>" name="number_of_strings" class="form-control number text-right" id="number_of_strings" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="orientation">Orientation</label>
                                 <input type="text" value="<?php echo e($detail->orientation); ?>" name="orientation" class="form-control" id="orientation" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="made_in">Country of Origin</label>
                                 <input  name="made_in" value="<?php echo e($detail->made_in); ?>" class="form-control " id="made_in" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="year">Year</label>
                                 <input type="text" value="<?php echo e($detail->year); ?>" name="year" class="form-control year" id="year" >
                             </div>
                         </div>
                         <h5 class="col-md-12 mt-4">Body</h5>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="type">Body type</label>
                                 <input type="text" value="<?php echo e($detail->type); ?>" name="type" class="form-control " id="type" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="shape">Body shape</label>
                                 <input type="text" value="<?php echo e($detail->shape); ?>" name="shape" class="form-control " id="shape" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="material">Body Material</label>
                                 <input type="text" value="<?php echo e($detail->material); ?>" name="material" class="form-control " id="material" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="carve">Body carve</label>
                                 <input type="text" value="<?php echo e($detail->carve); ?>" name="carve" class="form-control " id="carve" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="binding">Body binding</label>
                                 <input type="text" value="<?php echo e($detail->binding); ?>" name="binding" class="form-control " id="binding" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="weight_relief">Weight relief</label>
                                 <input type="text" value="<?php echo e($detail->weight_relief); ?>" name="weight_relief" class="form-control " id="weight_relief" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="build_material">Build material</label>
                                 <input type="text" value="<?php echo e($detail->build_material); ?>" name="build_material" class="form-control " id="build_material" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="body_finish_type">Body finish type</label>
                                 <input type="text" value="<?php echo e($detail->body_finish_type); ?>" name="body_finish_type" class="form-control " id="body_finish_type" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="color">Color</label>
                                 <input type="text" value="<?php echo e($detail->color); ?>" name="color" class="form-control " id="color" >
                             </div>
                         </div>
                         <h5 class="col-md-12 mt-4">Neck</h5>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="neck_material">Neck Material</label>
                                 <input type="text" value="<?php echo e($detail->neck_material); ?> name="neck_material" class="form-control " id="neck_material" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="truss_rod">Truss Rod</label>
                                 <input type="text" value="<?php echo e($detail->truss_rod); ?>" name="truss_rod" class="form-control " id="truss_rod" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="truss_rod_cover">Truss Rod Cover</label>
                                 <input type="text" value="<?php echo e($detail->truss_rod_cover); ?>" name="truss_rod_cover" class="form-control " id="truss_rod_cover" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="peghead_particular">Peghead Particular</label>
                                 <input type="text" value="<?php echo e($detail->peghead_particular); ?>" name="peghead_particular" class="form-control " id="peghead_particular" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="neck_profile">Neck Profile</label>
                                 <input type="text" value="<?php echo e($detail->neck_profile); ?>" name="neck_profile" class="form-control " id="neck_profile" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="fingerboard_material">Fingerboard Matrial</label>
                                 <input type="text" value="<?php echo e($detail->fingerboard_material); ?>"  name="fingerboard_material" class="form-control " id="fingerboard_material" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="crown_radius">Crown Radius</label>
                                 <input type="text" value="<?php echo e($detail->crown_radius); ?>" name="crown_radius" class="form-control number" id="crown_radius" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="scale_length">Scale Length</label>
                                 <input type="text" value="<?php echo e($detail->scale_length); ?>" name="scale_length" class="form-control comma" id="scale_length" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="frets">No. Frets / Type</label>
                                 <input type="text" value="<?php echo e($detail->frets); ?>" name="frets" class="form-control" id="frets" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="nut_size">Nut Size / Material</label>
                                 <input type="text" value="<?php echo e($detail->nut_size); ?>" name="nut_size" class="form-control" id="nut_size" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="neck_width">Neck Width</label>
                                 <input type="text" value="<?php echo e($detail->neck_width); ?>" name="neck_width" class="form-control" id="neck_width" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="neck_depth">Neck Depth</label>
                                 <input type="text" value="<?php echo e($detail->neck_depth); ?>" name="neck_depth" class="form-control" id="neck_depth" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="inlays">Fingerboard Inlays</label>
                                 <input type="text" value="<?php echo e($detail->inlays); ?>" name="inlays" class="form-control" id="inlays" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="neck_binding">Neck Binding</label>
                                 <input type="text" value="<?php echo e($detail->neck_binding); ?>" name="neck_binding" class="form-control" id="neck_binding" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="side_dots">Side Dot</label>
                                 <input type="text" value="<?php echo e($detail->side_dots); ?>" name="side_dots" class="form-control" id="side_dots" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="neck_joint">Neck Joint</label>
                                 <input type="text" value="<?php echo e($detail->neck_joint); ?>" name="neck_joint" class="form-control" id="neck_joint" >
                             </div>
                         </div>                        
                         <h5 class="col-md-12 mt-4">Hardware</h5>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="bridge">Bridge </label>
                                 <input type="text" value="<?php echo e($detail->bridge); ?>" name="bridge" class="form-control" id="bridge" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="tailpiece">Tailpiece</label>
                                 <input type="text" value="<?php echo e($detail->tailpiece); ?>" name="tailpiece" class="form-control" id="tailpiece" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="tuning_machines">Tuning Machines</label>
                                 <input type="text" value="<?php echo e($detail->tuning_machines); ?>" name="tuning_machines" class="form-control" id="tuning_machines" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="pickup_cover">Pickup cover</label>
                                 <input type="text" value="<?php echo e($detail->pickup_cover); ?>"  name="pickup_cover" class="form-control" id="pickup_cover" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="strap_buttons">Strap Buttons</label>
                                 <input type="text" value="<?php echo e($detail->strap_buttons); ?>" name="strap_buttons" class="form-control" id="strap_buttons" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="pickguard">Pickguard</label>
                                 <input type="text" value="<?php echo e($detail->pickguard); ?>" name="pickguard" class="form-control" id="pickguard" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="control_knobs">Control knobs</label>
                                 <input type="text" value="<?php echo e($detail->control_knobs); ?>" name="control_knobs" class="form-control" id="control_knobs" >
                             </div>
                         </div>                        
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="switch">Switch</label>
                                 <input type="text" value="<?php echo e($detail->switch); ?>" name="switch" class="form-control" id="switch" >
                             </div>
                         </div>                        
 
                         <h5 class="col-md-12 mt-4">Electronic</h5>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="bridge_pickup">Bridge pickup</label>
                                 <input type="text" value="<?php echo e($detail->bridge_pickup); ?>" name="bridge_pickup" class="form-control" id="bridge_pickup" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="middle_pickup">Middle pickup</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="middle_pickup" id="middle_pickup1" value="0" <?php if($detail->middle_pickup == 0): ?> checked <?php endif; ?> >
                                         <label class="form-check-label py-1 px-3 rounded" for="middle_pickup1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="middle_pickup" id="middle_pickup2" value="1" <?php if($detail->middle_pickup== 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="middle_pickup2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="neck_pickup">Neck pickup</label>
                                 <input type="text" name="neck_pickup" value="<?php echo e($detail->neck_pickup); ?> " class="form-control" id="neck_pickup" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="active_passive">Active / Passive</label>
                                 <input type="text" name="active_passive" value="<?php echo e($detail->active_passive); ?> " class="form-control" id="active_passive" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="series_pararell">Series / Pararell</label>
                                 <input type="text" value="<?php echo e($detail->series_pararell); ?> " name="series_pararell" class="form-control" id="series_pararell" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="control">Control</label>
                                 <input type="text" value="<?php echo e($detail->control); ?> " name="control" class="form-control" id="control" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="mono_stereo">Mono / Stereo</label>
                                 <input type="text" value="<?php echo e($detail->mono_stereo); ?> " name="mono_stereo" class="form-control" id="mono_stereo" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="vol_pontentiometer">Vol pontentiometer</label>
                                 <input type="text" value="<?php echo e($detail->vol_pontentiometer); ?> " name="vol_pontentiometer" class="form-control" id="vol_pontentiometer" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="pontentiometer">Pontentiometer</label>
                                 <input type="text" name="pontentiometer" value="<?php echo e($detail->pontentiometer); ?> " class="form-control" id="pontentiometer" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="capacitor">Capacitor</label>
                                 <input type="text" value="<?php echo e($detail->capacitor); ?> " name="capacitor" class="form-control" id="capacitor" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="harnesst">Harnesst</label>
                                 <input type="text" value="<?php echo e($detail->harnesst); ?> " name="harnesst" class="form-control" id="harnesst" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="push_pull">Push pull</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="push_pull" id="push_pull1" value="0" <?php if($detail->push_pull == 0): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="push_pull1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="push_pull" id="push_pull2" value="1" <?php if($detail->push_pull == 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="push_pull2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="piezo">Piezo</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="piezo" id="piezo1" value="0" <?php if($detail->piezo == 0): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="piezo1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="piezo" id="piezo2" value="1" <?php if($detail->piezo == 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="piezo2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="active_eq">Active EQ</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="active_eq" id="active_eq1" value="0" <?php if($detail->active_eq == 0): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="active_eq1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="active_eq" id="active_eq2" value="1" <?php if($detail->active_eq == 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="active_eq2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="kill_switch">Kill Swicth</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="kill_switch" id="kill_switch1" value="0" <?php if($detail->kill_switch == 0): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="kill_switch1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="kill_switch" id="kill_switch2" value="1" <?php if($detail->kill_switch == 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="kill_switch2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="output_jack">Output jack</label>
                                 <input type="text" value="<?php echo e($detail->output_jack); ?> " name="output_jack" class="form-control" id="output_jack" >
                             </div>
                         </div>
                         <h5 class="col-md-12 mt-4">Miscellaneous</h5>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="case">Case / Gigbag</label>
                                 <input type="text" value="<?php echo e($detail->case); ?> " name="case" class="form-control" id="case" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="strap_lock">Strap locks</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="strap_lock" id="strap_lock1" value="0" <?php if($detail->strap_lock == 0): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="strap_lock1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="strap_lock" id="strap_lock2" value="1" <?php if($detail->strap_lock == 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 rounded" for="strap_lock2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="strings">Strings</label>
                                 <input type="text" value="<?php echo e($detail->strings); ?> " name="strings" class="form-control" id="strings" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="tools">Tools</label>
                                 <input type="text" value="<?php echo e($detail->tools); ?> " name="tools" class="form-control" id="tools" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="manual">Manual</label>
                                 <input type="text" value="<?php echo e($detail->manual); ?> " name="manual" class="form-control" id="manual" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="coa">C.O.A</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="coa" id="coa1" value="0" <?php if($detail->coa == 0): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 coa rounded" for="coa1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="coa" id="coa2" value="1" <?php if($detail->coa == 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 coa rounded" for="coa2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="other">Other</label>
                                 <div class="d-flex">
                                     <div class="form-check d-inline mr-5">
                                         <input class="form-check-input" type="radio" name="other" id="other1" value="0" <?php if($detail->other == 0): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 other rounded" for="other1">
                                             No
                                         </label>
                                     </div>
                                     <div class="form-check d-inline ">
                                         <input class="form-check-input" type="radio" name="other" id="other2" value="1" <?php if($detail->other == 1): ?> checked <?php endif; ?>>
                                         <label class="form-check-label py-1 px-3 other rounded" for="other2">
                                             Yes
                                         </label>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="weight">Weight</label>
                                 <input type="text" value="<?php echo e($detail->weight); ?> " name="weight" class="form-control" id="weight" >
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="form-group mb-4">
                                 <label for="disclosure">Disclosure</label>
                                 <input type="text" value="<?php echo e($detail->disclosure); ?> " name="disclosure" class="form-control" id="disclosure" >
                             </div>
                         </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-danger mt-3" href="<?php echo e(route('product.index')); ?>"><i
                                    class="flaticon-cancel-12"></i> Back</a>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/product.js')); ?>"></script>
    <script type="text/javascript">
        let preloaded = [
            <?php $__currentLoopData = $product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {id: <?php echo e($product_image->id); ?>, src: '<?php echo e(asset("storage/" . $product_image->image)); ?>'},
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];

        

        $('.input-images-1').imageUploader();

        $('.summernote').summernote({
            height: 300,
            tabDisable: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\felicity-guitar\resources\views/product/edit.blade.php ENDPATH**/ ?>
<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Type;
use App\User;
use App\Product;
use App\Category;
use App\ProductData;
use App\Subcategory;
use App\ProductImage;
use App\ProductDetail;
use App\ThumbnailDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $data['menu'] = 'product';
        $data['page'] = 'list product';
        $data['products'] = Product::whereNull('status')->orderBy('updated_at', 'ASC')->get();

        return view('product.index', $data);
    }

    public function create()
    {
        $data['menu'] = 'product';
        $data['page'] = 'list product';
        $data['categories'] = Category::all();
        $data['brands'] = Brand::where('brand_of', 'guitar')->get();

        return view('product.create', $data);
    }

    public function store(Request $request)
    {
        

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->code = $this->makeCode('PRD', 10);
            $product->meta_text = $request->meta_text;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->name = $request->name;
            $product->name_2 = $request->name_2;
            $product->slug = Str::slug($request->name);
            $product->text = $request->text;
            $product->alt_text = $request->alt_text;
            $product->country = $request->country;
            $product->type = $request->type;
            $product->condition = $request->condition;
            $product->year = $request->year;
            $price = $this->replaceDot($request->price);
            $product->price = $price;
            $product->discount = $request->discount;
            $product->sell_price = $price - ($price * $request->discount / 100);
            $fileName = 'thumbnail/multi-' . Str::slug($request->name). '.' . $request->thumbnail->extension();
            $image = Image::make($request->thumbnail);
            Storage::put($fileName, (string) $image->encode());
            $product->thumbnail = $fileName;

            $thumbnail_2 = 'thumbnail/single-' . Str::slug($request->name). '.' . $request->thumbnail_2->extension();
            $img = Image::make($request->thumbnail_2);
            Storage::put($thumbnail_2, (string) $img->encode());
            $product->thumbnail_2 = $thumbnail_2;


            $product->save();
            
            // detail

             $detail = new ProductDetail();
             $detail->product_id = $product->id;
             $detail->general = $request->general;
             $detail->body = $request->body;
             $detail->neck = $request->neck;
             $detail->hardware = $request->hardware;
             $detail->electronic = $request->electronic;
             $detail->miscellaneous = $request->miscellaneous;
             $detail->save();
             // foreach($request->type as $key => $item){
             // }

            
           
            DB::commit();
            if($request->images){
                if(count($request->images) > 10){
                    $status = [
                        'icon' => 'error',
                        'title' => 'Oops ...!!' ,
                        'text' =>  'Maximum upload 10 files'
                    ];
                    return redirect()->route('product.show', ['product' => $product->id])->with(['message' => $status]);
                }
                else{
                    foreach ($request->images as $key => $item) {
                        $fileName = 'product/' . $this->makeCode(Str::slug($request->name), 4) . '.jpg';
    
                        $img = Image::make($item);
                        // $img->resize(1000, null, function ($constraint) {
                        //     $constraint->aspectRatio();
                        // });
                        Storage::put($fileName, (string) $img->encode());
    
                        $product_image  = new ProductImage();
                        $product_image->product_id = $product->id;
                        $product_image->image = $fileName;
                        $product_image->save();

                        $thumb = 'thumbnail-detail/' . Str::slug($product->name).'-'. $key . '.jpg';
                        $i = Image::make($item);
                        $i->resize(250, 250, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        Storage::put($thumb, (string) $i->encode());
                        ThumbnailDetail::create(
                            [
                                'product_image_id' => $product_image->id,
                                'image' => $thumb,
                            ]
                        );
                    }
                }
            }

            $status = [
                'status' => 'success',
                'text' => 'Success to add product',
                'data' => [
                    'product' => $product,
                ]
            ];

            return redirect()->route('product.index')->with(['message' => $status]);
        } catch (\Throwable$th) {
            DB::rollback();
            throw $th;

            $status = [
                'status' => 'success',
                'text' => 'Failed to add product',
                'data' => [
                    'product' => $product,
                ]
            ];

            return redirect()->route('product.index')->with(['message' => $status]);
        }
    }

    public function show($id)
    {
        $data['menu'] = 'product';
        $data['page'] = 'list product';
        $data['brands'] = Brand::where('brand_of', 'guitar')->get();
        $data['product'] = Product::find($id);
        $data['categories'] = Category::all();
        $data['product_images'] = ProductImage::whereProductId($id)->orderBy('id', 'ASC')->get();
        $detail = ProductDetail::where('product_id', $id)->first();
        if($detail){
            $data['detail'] = $detail;
        }else{
            $new = new ProductDetail();
            $new->product_id = $id;
            $new->save();
            $data['detail'] = $new;
        }
        return view('product.edit', $data);

    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    { 
        DB::beginTransaction();
        try {
            
            $product = Product::find($id);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->description = $request->description;
            $product->country = $request->country;
            $product->type = $request->type;
            $product->condition = $request->condition;
            $product->year = $request->year;
            if($request->sold){
                $product->status = 'sold';
            }else{
                $product->status = NULL;
            }
            $product->name = $request->name;
            $product->name_2 = $request->name_2;
            $product->meta_text = $request->meta_text;
            $product->slug = Str::slug($request->name);
            $product->text = $request->text;
            $product->alt_text = $request->alt_text;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->updated_at = Carbon::now();
            $product->sell_price = $request->price - ($request->price * $request->disc / 100);
            if($request->file('thumbnail')){
                Storage::delete($product->thumbnail);
                $fileName = 'thumbnail/multi-' . Str::slug($request->name). '.' . $request->thumbnail->extension();
                $image = Image::make($request->thumbnail);
                Storage::put($fileName, (string) $image->encode());
                $product->thumbnail = $fileName;
            }
            if($request->file('thumbnail_2')){
                Storage::delete($product->thumbnail_2);
                $thumbnail_2 = 'thumbnail/single-' . Str::slug($request->name_2). '.' . $request->thumbnail_2->extension();
                $image = Image::make($request->thumbnail_2);
                Storage::put($thumbnail_2, (string) $image->encode());
                $product->thumbnail_2 = $thumbnail_2;
            }
           
            $product->save();

            $detail = ProductDetail::where('product_id', $product->id)->first();
            $detail->general = $request->general;
            $detail->body = $request->body;
            $detail->neck = $request->neck;
            $detail->hardware = $request->hardware;
            $detail->electronic = $request->electronic;
            $detail->miscellaneous = $request->miscellaneous;
            $detail->save();

            if ($request->images) {
                if(count($request->images) > 10){
                    $status = [
                        'icon' => 'error',
                        'title' => 'Oops ...!!' ,
                        'text' =>  'Maximum upload 10 files'
                    ];
                    return redirect()->back()->with(['message' => $status]);
                }else{
                    $img_detail = ProductImage::where('product_id', $id)->get();
                    $last_img = count($img_detail);
                    foreach ($request->images as $key => $item) {
                        $fileName = 'product/' . $this->makeCode(Str::slug($product->name), 4) . '.jpg';
                        $img = Image::make($item);
                        // $img->resize(1000, null, function ($constraint) {
                        //     $constraint->aspectRatio();
                        // });
                        Storage::put($fileName, (string) $img->encode());
                        $product_image  = new ProductImage();
                        $product_image->product_id = $product->id;
                        $product_image->image = $fileName;
                        $product_image->save();

                        $thumb = 'thumbnail-detail/' . Str::slug($product->name).'-thumb'. $this->makeCode(10) . '.jpg';
                        $img->resize(250, 250, function ($c) {
                            $c->aspectRatio();
                        });
                        Storage::put($thumb, (string) $img->encode());
                        ThumbnailDetail::create(
                            [
                                'product_image_id' => $product_image->id,
                                'image' => $thumb,
                            ]
                        );
                            
                            $last_img = $last_img + 1;
                    }
               }
            }
            // if($request->old_id){
            //     foreach($request->old_id as $key => $item){
            //         $detail = ProductDetail::where('id', $request->old_id[$key])->first();
            //         $detail->value = $request->old_value[$key];
            //         $detail->title = $request->old_title[$key];
            //         $detail->save();
            //     }
            // }

            // if($request->title){
            //     foreach($request->title as $key => $item){
            //         $detail = new ProductDetail();
            //         $detail->value = $request->value[$key];
            //         $detail->title = $request->title[$key];
            //         $detail->type = $request->type[$key];
            //         $detail->product_id = $product->id;
            //         $detail->save();
            //     }
            // }
            
            // return $detail;
            DB::commit();

            $status = [
                'status' => 'success',
                'text' => 'Success to Update Product',
                'data' => [
                    'product' => $product,
            ]
            ];

            return redirect()->route('product.index')->with(['message' => $status]);
        } catch (\Throwable$th) {
            DB::rollback();
            throw $th;

            $status = [
                'status' => 'success',
                'msg' => 'Data berhasil di simpan',
            ];

            return redirect()->route('product.index')->with($status);
        }
    }

    public function destroy($id)
    {
        $product_images = ProductImage::whereProductId($id)->get();
        foreach ($product_images as $product_image) {
            $thumb = ThumbnailDetail::where('product_image_id', $product_image->id)->first();
            if($this->existsFile($product_image->image)){
                Storage::delete($product_image->image);
            }
            if($this->existsFile($thumb->image)){
                Storage::delete($thumb->image);
            }
            $thumb->delete();
            $product_image->delete();
        }

        $product = Product::find($id);
        if($this->existsFile($product->thumbnail)){
            Storage::delete($product->thumbnail);
        }
        if($this->existsFile($product->thumbnail_2)){
            Storage::delete($product->thumbnail);
        }
        $images = ProductImage::where('product_id', $product->id)->get();

        foreach($images as $img ){

            Storage::delete($img->image);
            $img->delete();
        }

        $product->delete();
        $status = [
            'status' => 'success',
            'text' => 'Success delete data',
            'data' => [
                'product' => $product,
            ]
        ];

        return redirect()->route('product.index')->with(['message' => $status]);
    }

    public function imageDestroy(Request $request)
    {
        $image = ProductImage::find($request->id);
        $thumb = ThumbnailDetail::where('product_image_id', $image->id)->first();
        Storage::delete($image->image);
        Storage::delete($thumb->image);

        $thumb->delete();
        $image->delete();

        return response()->json($image);
    }

    public function detailDestroy(Request $request)
    {
        $detail = ProductDetail::find($request->id);
        $detail->delete();

        return response()->json($detail);
    }

    public function category($id)
    {
        $category = Category::where('type_id', $id)->get();

        return response()->json($category);
    }


    public function getCode(){
        $code = $this->makeCode('PRD', 10);
        return response()->json($code);
    }
    public function deleteImage(Request $request){
        try {
            $image = ProductImage::find($request->id);
            if($this->existsFile($image->image)){
                Storage::delete($image->image);

                $thumb = ThumbnailDetail::where('product_image_id', $image->id)->first();

                Storage::delete($thumb->image);
                $thumb->delete();
                $image->delete();
                $status = [
                    'type' => 'success',
                    'text' => 'Success delete image',
                    'data' => [
                        'product' => 'has been deleted',
                    ]
                ];
            }
            return response()->json($status);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteDetail(Request $request){
        try {
            $detail = ProductDetail::where('product_id', $request->product_id)->where('id', $request->id)->delete();
            $data = [
                'status' => 'success',
                'data' => $detail
            ];
            return response()->json($data);
        
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteAllImage($id){
        try {
            $image = ProductImage::where('product_id', $id)->get();
            foreach($image as $img){
                Storage::delete($img->image);
                $thumb = ThumbnailDetail::where('product_image_id', $img->id)->first();
                Storage::delete($thumb->image);
                $img->delete();
                $thumb->delete();
            }
            $status = [
                'icon' => 'success',
                'title' => 'Well Done',
                'text' => 'Success delete all Image',
            ];
    
            return redirect()->back()->with(['message' => $status]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // 2263
    public function resize(){
        
        $images = ProductImage::where('product_id', 74)->get();
        $html = '';
        foreach ($images as $key => $item) {
        //    $data = ThumbnailDetail::where('product_image_id', $item->id)->first();
        // if(!$thum){
            $product = Product::where('id', $item->product_id)->first();
                $fileName = 'thumbnail-detail/' . Str::slug($product->name).'-'. $key . '.jpg';
                $file = Storage::get($item->image);
                $img = Image::make($file);
                $img->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::put($fileName, (string) $img->encode());
                ThumbnailDetail::create(
                    [
                        'product_image_id' => $item->id,
                        'image' => $fileName,
                        ]
                    );
                    // }
            $html = $html . '<img src="https://felicityguitars./storage/'.$fileName.'">';
            $html = $html . '<img src="https://felicityguitars./storage/'.$item->image.'"> <hr>';
        }

        return $html;
    }
    // public function rename(){
    //     $product = Product::where('id', '!=', 24)->get();
    //     // return $product;
    //     foreach($product as $p){
    //         $file = str_replace(['"','/'], '', $p->name);
    //         $thumbnail_2 =  'thumbnail/'.str_replace(' ', '-', $file).'-1.jpg';
    //         $thumbnail =  'thumbnail/'.str_replace([' '], '-', $file).'.jpg';
    //         // Storage::rename($p->thumbnail, $thumbnail);
    //         // Storage::rename($p->thumbnail_2, $thumbnail_2);
    //         // $p->thumbnail = $thumbnail;
    //         // $p->thumbnail_2= $thumbnail_2;
    //         // $p->save();

    //         $images = ProductImage::where('product_id', $p->id)->get();
    //         foreach($images as $img){
    //             $fileName = 'product/'.str_replace(' ', '-', $file).'-'.$img->id.'.jpg';
    //             Storage::rename($img->image, $fileName);
    //             $img->image = $fileName;
    //             $img->save();
    //         }
    //     }
    //     return $product;
    // }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image'];
    protected $appends = ['thumbnail'];
    public function thumbnail(){
        return $this->hasOne(ThumbnailDetail::class);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'id');
    }

    public function getThumbnailAttribute(){
        $thumbnail = ThumbnailDetail::where('product_image_id', $this->id)->first();
        if(!$thumbnail){
            $product = Product::where('id', $this->product_id)->first();
            $fileName = 'thumbnail-detail/' . Str::slug($product->name).'-'. $this->id . '.jpg';
            $file = Storage::get($this->image);
            $img = Image::make($file);
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::put($fileName, (string) $img->encode());
            $thumbDetail = new ThumbnailDetail();
            $thumbDetail->product_image_id = $this->id;
            $thumbDetail->image = $fileName;
            $thumbDetail->save();

            return $thumbDetail->image;
        }

        return $thumbnail->image;
    }
}

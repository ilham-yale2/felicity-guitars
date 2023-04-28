<?php

namespace App\Http\Controllers;

use App\AmplifierDetail;
use App\AmpilifierImage;
use App\Amplifier;
use App\AmplifierImage;
use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AmplifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = 'amplifier';
        $data['page'] = 'amplifier list';
        $data['amplifiers'] = Amplifier::whereNull('status')->orderBy('updated_at', 'ASC')->get();

        return view('amplifier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = 'amplifier';
        $data['page'] = 'amplifier create';
        $data['categories'] = Category::all();
        $data['brands'] = Brand::where('brand_of', 'amplifier')->orderBy('name', 'ASC')->get();

        return view('amplifier.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $amplifier = new Amplifier();
            $amplifier->code = $this->makeCode('AMP', 10);
            $amplifier->meta_text = $request->meta_text;
            $amplifier->brand_id = $request->brand_id;
            $amplifier->description = $request->description;
            $amplifier->name = $request->name;
            $amplifier->name_2 = $request->name_2;
            $amplifier->slug = Str::slug($request->name);
            $amplifier->text = $request->text;
            $amplifier->alt_text = $request->alt_text;
            $amplifier->country = $request->country;
            $amplifier->type = $request->type;
            $amplifier->condition = $request->condition;
            $amplifier->year = $request->year;
            $price = $this->replaceDot($request->price);
            $amplifier->price = $price;
            // $amplifier->discount = $request->discount;
            // $amplifier->sell_price = $price - ($price * $request->discount / 100);
            
            // thumbnail 1
            $fileName = 'amplifier/thumbnail/multi-' . Str::slug($request->name). '.' . $request->thumbnail->extension();
            $image = Image::make($request->thumbnail);
            Storage::put($fileName, (string) $image->encode());
            $amplifier->thumbnail = $fileName;
            
            // thumbnail 2
            $thumbnail_2 = 'amplifier/thumbnail/single-' . Str::slug($request->name). '.' . $request->thumbnail_2->extension();
            $image = Image::make($request->thumbnail_2);
            Storage::put($thumbnail_2, (string) $image->encode());
            $amplifier->thumbnail_2 = $thumbnail_2;


            $amplifier->save();
            
            // detail

             $detail = new AmplifierDetail();
             $detail->amplifier_id = $amplifier->id;
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
                    return redirect()->route('amplifier.show', ['amplifier' => $amplifier->id])->with(['message' => $status]);
                }
                else{
                    foreach ($request->images as $key => $item) {
                        $fileName = 'amplifier/gallery/' . $this->makeCode(Str::slug($request->name), 4) . '.jpg';
                        // image gallery
                        $img = Image::make($item);
                        Storage::put($fileName, (string) $img->encode());

                        // thumbnail
                        $thumb = 'amplifier/thumbnail-gallery/' . Str::slug($amplifier->name).'-'. $key . '.jpg';
                        $i = Image::make($item);
                        $i->resize(250, 250, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        Storage::put($thumb, (string) $i->encode());
    
                        $amplifier_image  = new AmplifierImage();
                        $amplifier_image->amplifier_id = $amplifier->id;
                        $amplifier_image->image = $fileName;
                        $amplifier_image->thumbnail = $thumb;
                        $amplifier_image->save();
                    }
                }
            }

            $status = [
                'status' => 'success',
                'text' => 'Success to add amplifier',
                'data' => [
                    'amplifier' => $amplifier,
                ]
            ];

            return redirect()->route('amplifier.index')->with(['message' => $status]);
        } catch (\Throwable$th) {
            DB::rollback();
            throw $th;

            $status = [
                'status' => 'success',
                'text' => 'Failed to add amplifier',
                'data' => [
                    'amplifier' => $amplifier,
                ]
            ];

            return redirect()->route('amplifier.index')->with(['message' => $status]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Amplifier  $amplifier
     * @return \Illuminate\Http\Response
     */
    public function show(Amplifier $amplifier)
    {
        $data['menu'] = 'amplifier';
        $data['page'] = 'edit amplifier';
        $data['brands'] = Brand::where('brand_of', 'amplifier')->get();
        $data['amplifier'] = $amplifier;
        $data['categories'] = Category::all();
        $data['amplifier_images'] = AmplifierImage::where('amplifier_id', $amplifier->id)->orderBy('id', 'ASC')->get();
        $detail = AmplifierDetail::where('amplifier_id', $amplifier->id)->first();
        if($detail){
            $data['detail'] = $detail;
        }else{
            $new = new AmplifierDetail();
            $new->amplifier_id = $amplifier->id;
            $new->save();
            $data['detail'] = $new;
        }
        return view('amplifier.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Amplifier  $amplifier
     * @return \Illuminate\Http\Response
     */
    public function edit(Amplifier $amplifier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amplifier  $amplifier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $amplifier = Amplifier::find($id);
            $amplifier->brand_id = $request->brand_id;
            $amplifier->description = $request->description;
            $amplifier->country = $request->country;
            $amplifier->type = $request->type;
            $amplifier->condition = $request->condition;
            $amplifier->year = $request->year;
            if($request->sold){
                $amplifier->status = 'sold';
            }else{
                $amplifier->status = NULL;
            }
            $amplifier->name = $request->name;
            $amplifier->name_2 = $request->name_2;
            $amplifier->meta_text = $request->meta_text;
            $amplifier->slug = Str::slug($request->name);
            $amplifier->text = $request->text;
            $amplifier->alt_text = $request->alt_text;
            $amplifier->price = $this->replaceDot($request->price);
            $amplifier->updated_at = Carbon::now();
            if($request->file('thumbnail')){
                Storage::delete($amplifier->thumbnail);
                $fileName = 'amplifier/thumbnail/multi-' . Str::slug($request->name) . $this->makeCode(5) . '.' . $request->thumbnail->extension();
                $image = Image::make($request->thumbnail);
                Storage::put($fileName, (string) $image->encode());
                $amplifier->thumbnail = $fileName;
            }
            if($request->file('thumbnail_2')){
                Storage::delete($amplifier->thumbnail_2);
                $thumbnail_2 = 'amplifier/thumbnail/single-' . Str::slug($request->name). $this->makeCode(5) .'.' . $request->thumbnail_2->extension();
                $image = Image::make($request->thumbnail_2);
                Storage::put($thumbnail_2, (string) $image->encode());
                $amplifier->thumbnail_2 = $thumbnail_2;
            }
           
            $amplifier->save();

            $detail = AmplifierDetail::where('amplifier_id', $amplifier->id)->first();
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
                    $img_detail = AmplifierImage::where('amplifier_id', $id)->get();
                    $last_img = count($img_detail);
                    foreach ($request->images as $key => $item) {
                        $last_img ++ ;
                        $fileName = 'amplifier/gallery/' . $this->makeCode(Str::slug($amplifier->name), 4) . '.jpg';
                        $img = Image::make($item);
                        Storage::put($fileName, (string) $img->encode());
                        $thumb = 'amplifier/thumbnail-gallery/' . Str::slug($amplifier->name).'-thumb'. $last_img . '.jpg';
                        $img->resize(250, 250, function ($c) {
                            $c->aspectRatio();
                        });
                        Storage::put($thumb, (string) $img->encode());
                        $amplifier_image  = new AmplifierImage();
                        $amplifier_image->amplifier_id = $amplifier->id;
                        $amplifier_image->image = $fileName;
                        $amplifier_image->thumbnail = $thumb;
                        $amplifier_image->save();
                    }
               }
            }
            
            DB::commit();

            $status = [
                'status' => 'success',
                'text' => 'Success to Update amplifier',
                'data' => [
                    'amplifier' => $amplifier,
            ]
            ];

            return redirect()->route('amplifier.index')->with(['message' => $status]);
        } catch (\Throwable$th) {
            DB::rollback();
            throw $th;

            $status = [
                'status' => 'success',
                'msg' => 'Data berhasil di simpan',
            ];

            return redirect()->route('amplifier.index')->with($status);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amplifier  $amplifier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amplifier $amplifier)
    {
        try {
            $images = AmplifierImage::where('amplifier_id', $amplifier->id)->get();
            AmplifierDetail::where('amplifier_id', $amplifier->id)->delete();
            foreach ($images as $key => $image) {
                Storage::delete($image->image);
                Storage::delete($image->thumbnail);
                $image->delete();
            }
            Storage::delete($amplifier->thumbnail);
            Storage::delete($amplifier->thumbnail_2);
            $amplifier->delete();
            $status = [
                'status' => 'success',
                'text' => 'Success delete data',
                'data' => [
                    'product' => null,
                ]
            ];
    
            return redirect()->route('amplifier.index')->with(['message' => $status]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteImage(Request $request){
        try {
            $image = AmplifierImage::find($request->id);
            if($this->existsFile($image->image)){
                Storage::delete($image->image);
                Storage::delete($image->thumbnail);
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

    public function deleteAll(Request $request, $id){
        try {
            $images = AmplifierImage::where('amplifier_id', $id)->get();
            foreach ($images as $key => $image) {
                Storage::delete($image->thumbnail);
                Storage::delete($image->image);
                $image->delete();
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
}

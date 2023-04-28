<?php

namespace App\Http\Controllers;

use App\Amplifier;
use App\AmplifierDetail;
use App\AmplifierImage;
use App\Brand;
use App\Cart;
use App\Category;
use App\Mail\EmailTesting;
use App\Partner;
use App\PrivateVault;
use App\PrivateVaultDetail;
use App\PrivateVaultImage;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use App\Setting;
use App\TransactionDetail;
use App\UserAddress;
use App\UserTrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{


	public function cart()
	{
		if(Auth::guard('user')->user()){
			$data['products'] = Cart::where('user_id', Auth::guard('user')->user()->id)->orderBy('created_at', 'DESC')->get();
		}
		return view('cart', $data);
	}
	public function contact()
	{
		return view('contact');
	}
	public function accountPage()
	{
		$data['address'] = UserAddress::where('user_id', Auth::guard('user')->user()->id)->get();
		$data['transactions'] = TransactionDetail::whereHas('transaction', function ($t) {
			$t->where('user_id',Auth::guard('user')->user()->id);
		})->get();
	

		return view('account-page', $data);
	}

	public function privateVault()
	{
		$data['products'] = PrivateVault::whereNull('status')->get();
		return view('private-vault', $data);
		// if(Auth::guard('user')->user()){
		// }else{
		// 	return redirect()->route('sign-in');
		// }

	}
	public function browseBrand(Request $request)
	{
		$products = Product::whereHas('brand', function ($p) use ($request){
			$p->where('name', $request->brd);
		})->whereNull('status');
		if($request->brd){
			if($request->country){

				if($request->country == 13){
					$products->whereIn('country', [7,8,9,10]);
				}else{
					$products->where('country', $request->country);
				}
			}

			if($request->condition){
				$products->where('condition', $request->condition);
			}

			if($request->type){
				$products->whereHas('details', function ($t) use ($request){
					$t->where('title', 'body type')->where('value', $request->type);
				});
			}

			if($request->from_price || $request->to_price){
				// return $request->all();
				$products->where('sell_price', '>=', intval($request->from_price))->where('sell_price', '<=', intval($request->to_price));
			}

			if($request->up_to){
				// return $request->all();
				$products->where('sell_price', '>=', intval($request->up_to));
			}

			if($request->from_year){
				$products->whereHas('details', function ($y) use ($request){
					$y->where('title', 'year')->where('value', '>=', $request->from_year)->where('value', '<=', $request->to_year);
				});
			}
			if($request->up_year){
				$products->whereHas('details', function ($y) use ($request){
					$y->where('title', 'year')->where('value', '>=', $request->up_year);
				});
			}

			$data['products'] = $products->paginate(15);
			if($request->brd == 'Martin' || $request->brd == 'Guild' || $request->brd == 'Taylor'){
				$data['sub_cat'] = false;
			}else{
				$data['sub_cat'] = true;
			}
			$brand = Brand::where('name' , $request->brd)->first() ;
			if($brand) {
				$data['brand'] = $brand;	
			}else{
				$data['brand'] =  [ 'name' => 'Brand', 'image' => null];
			}
		}elseif(!$request->brd){
			$data['products'] = Product::whereNull('status')->paginate(15);
			$data['brand'] = [ 'name' => 'Brand', 'image' => null];
		}else{
			$data['products'] = [];
			$data['brand'] = [ 'name' => 'Brand', 'image' => null];
		}
		$data['brands'] = Brand::all();
		$data['subject'] = $request->subject ?? '';
		return view('browse-brand', $data);
	}

	public function aboutUs()
	{

		
		$data['partners'] = Partner::all();
		return view('about-us', $data);
	}
	
	public function trade()
	{
		return view('trade');
	}

	public function checkoutAccount()
	{
		return view('checkout-account');
	}

	public function detailProduct($code)
	{
		
		$product = Product::where('slug', $code)->first();
		if($product){
			$data['product']= $product;
			$data['detail'] = ProductDetail::where('product_id', $product->id)->first();
			$data['images'] = ProductImage::where('product_id', $product->id)->orderBy('id', 'ASC')->get();
			$data['product_type'] = 'guitar';
		}else{
			abort(404);
		}
		return view('page-detail.guitar', $data);
	}
	public function detailAmplifier($slug)
	{
		
		$product = Amplifier::where('slug', $slug)->first();
		if($product){
			$data['product']= $product;
			$data['detail'] = AmplifierDetail::where('amplifier_id', $product->id)->first();
			$data['images'] = AmplifierImage::where('amplifier_id', $product->id)->orderBy('id', 'ASC')->get();
			$data['product_type'] = 'amplifier';
		}else{
			abort(404);
		}
		return view('page-detail.amplifier', $data);
	}

	

	public function detailVault($slug){
		$product = PrivateVault::where('slug', $slug)->first();
		if($product){
			$data['product']= $product;
			$data['details'] = PrivateVaultDetail::where('product_id', $product->id)->first();
		}else{
			abort(404);
		}
		return view('private_vault_detail', $data);

	}

	public function buyNow(Request $request){
		if($request->product){
            $product = array();
            foreach ($request->product as $key => $value) {
                $item = Product::find(Crypt::decryptString($request->product[$key]));
                array_push($product, $item);
            }
			if(Auth::guard('user')->user()){

				$address = UserAddress::where('user_id', Auth::guard('user')->user()->id);
				$data['address'] = $address->get();
			}
            $data['carts'] = $product;
            return view('checkout' , $data);
        }else{
            return redirect()->route('home');
        }
	}

	public function search(Request $request){
		if($request->keyword != null){
			$data['products'] = Product::where('name', 'LIKE', "%{$request->keyword}%")->get();
		}else{
			$data['products'] = Product::all();
		}

		return view('search', $data);
	}

	public function privacyPolicy(){

		return view('privacy_policy');
	}

	
	public function email($email){
		Mail::to($email)->send(new EmailTesting());
		return $email;
	}

	
	
}

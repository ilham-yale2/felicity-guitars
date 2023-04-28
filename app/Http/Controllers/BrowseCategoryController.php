<?php

namespace App\Http\Controllers;

use App\Amplifier;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class BrowseCategoryController extends Controller
{
    public function index(Request $request)
	{
		$data['price'] = false;
		$data['price_list'] = false;
		$data['brands'] = false;
		$data['products'] = [];
		$data['empty_text'] = '~The best things in life are worth waiting for~';
		$data['type'] = '';
		$data['types'] = null;
		$data['bold'] = false;
		$data['condition'] = true;
		$data['box'] = '';
		$data['route'] = 'detail-product';

		switch ($request->subject) {
			case 'Guitar':
				$data['title'] = $request->ctg;
				$data['price']   = true;
				$data['year'] 	 = true;
				$data['empty_text'] = null;
				$data['products'] = $this->guitarCategory($request);
				if(!$request->ctg){
					$data['title'] = 'All Our Guitars';
				}
				
				if($request->ctg == 'Electric Guitars'){
					$data['brands']  = ['Gibson','Fender','Gretsch','Rickenbacker','ESP','Ibanez','PRS','Epiphone'];
					$data['type']    = 'without acoustic';
				}elseif($request->ctg == 'Acoustic Guitars'){
					$data['brands'] =['Guild', 'Martin', 'Taylor', 'Epiphone', 'Kitharra'];
					$data['type'] = 'none';
				}
				break;
			case 'Amplifiers':
				$data['brands'] = ['Marshall', 'Orange', 'Fender', 'Peavey', 'Positive Grid', 'Vox'];
				$data ['types'] = ['Tube-Valve', 'Solid_State'];
				$data['addition'] = ['Heads', 'Cabinets', 'Combos'];
				$data['year'] = true;
				$data['price']= true;
				$data['col'] = 'col-md-6';
				$data['image'] = 'w-100';
				$data['box'] = 'box-amplifier';
				$data['title'] = 'Amplification';
				$data['route'] = 'detail-amplifier';
				$data['products'] = $this->amplifierCategory($request);
				break;
			case 'Effects Pedals':
				$data['brands'] = [ 'Big Muff','Boss','EarthQuaker Devices','Electro_Harmonix','Ibanez','Jim Dunlop','Marshall','MXR','Polytune','Strymon','TC Electronic' ,'Vox' ,'Wampler' ,'Waza Craft'];
				$data['types']= ['Chorus','Delay', 'Distortion', 'Flanger', 'Fuzz', 'Noise Gate', 'Octave', 'Overdrive', 'Phaser', 'Reverb', 'Tremolo', 'Tuner', 'Volume', 'Wah', 'Combo'];
				$data['col'] = 'col-md-3';
				$data['image'] = 'img-pedals';
				$data['price_list'] = true;
				$data['title'] = 'Pedals & Effects';
				break;
			case 'Vintage Stuff':
				$data['brands'] = ['Gibson', 'Fender', 'Rickenbacker', 'Gretsch', 'Danelectro', 'Epiphone', 'Supro', 'Vox', 'Marshall', 'Other'];
				$data['addition'] = ['Hang Tags', 'Brochures', 'Pamphlets', "Owner's Manuals", 'Warranty Cards', 'Distributor Fliers', 'Banners', 'Concert Promos','Concert Tickets', 'Polishes-Cloths', 'Case Candies', 'Vintage Parts'];
				$data['col'] = 'col-md-3';
				$data['price_list'] = true;
				$data['image'] = 'img-pedals';
				$data['condition'] = false;
				$data['title'] = 'Vintage Stuff';
				break;
			case 'Merch-Apparel':
				$data['types'] = ['Hats', 'Bandanas', 'Batik Stuff', 'Key Chains', 'Phone Covers', 'Pick Cases', 'Pick Trays', 'Stickers', 'Gift Certificates', 'Other'];
				$data['type'] = 'none';
				$data['bold'] = true;
				$data['condition'] = false;
				$data['title'] = 'Merch & Apparel';
				break;
			case 'Parts-Accessories':
				$data['types'] = ['Axe Stands', 'Amp Stands', 'Handmade Straps', 'Straplocks', 'Plectrums', 'Cables-Connectors', 'Cleaning-Polishing', 'Pickguards', 'Replacement Parts', 'Potentiometers', 'Capacitors', 'Strings', 'Gift Certificates', 'Other'];
				$data['type'] = 'none';
				$data['bold'] = false;
				$data['title'] = 'Parts & Accessories';
				$data['condition'] = false;
				break;
			case 'Exotic-Instruments':
				$data['types'] = ['Angklung', 'Calung', 'Gambus', 'Gamelan' , 'Gendang Melayu', 'Gendang Jaipong', 'Gong', 'Kecapi', 'Kolintang', 'Saluang-Suling', 'Sasando', 'Teyhan-Rebab'];
				$data['bold'] = true;
				$data['price'] = true;
				$data['condition'] = false;
				$data['title'] = 'Exotic Instruments';
				break;
			default:
                $data['products'] = $this->guitarCategory($request);

				if($request->ctg == 'Electric Guitars'){
					$data['brands']  = ['Gibson','Fender','Gretsch','Rickenbacker','ESP','Ibanez','PRS','Epiphone'];
					$data['type']    = 'without acoustic';
				}elseif($request->ctg == 'Acoustic Guitars'){
					$data['brands'] =['Guild', 'Martin', 'Taylor', 'Epiphone', 'Kitharra'];
					$data['type'] = 'none';
				}
				$data['price']   = true;
				$data['year'] 	 = true;
				$data['empty_text'] = null;
				break;
		}
 
		if($request->ctg){

			$data['ctg'] = '&ctg='.$request->ctg;
		}
		else{
			$data['ctg'] = '';
		}
		$data['categories'] = Category::all();
		$data['subject']= $request->subject ?? 'Guitar';
		return view('browse-category',$data);	
	}

    public function guitarCategory($request){
		$products = Product::whereNull('status');
		if($request->ctg){ 
			$products->whereHas('category', function ($p) use ($request){
				$p->where('name', $request->ctg);
			})->whereNull('status');
			
		}
		if($request->condition){
			$products->where('condition', $request->condition);
		}

		if($request->type){
			$products->where('type' , $request->type);
		}

		if($request->from_price || $request->to_price){
			$products->where('sell_price', '>=', intval($request->from_price))->where('sell_price', '<=', intval($request->to_price));
		}

		if($request->up_to){
			$products->where('sell_price', '>=', intval($request->up_to));
		}

		if($request->from_year){
			$products->where('year','>=', $request->from_year)->where('year', '<=', $request->to_year);
		}
		if($request->up_year){
			$products->where('year', $request->up_year);
		}

		if($request->brd){
			$products->whereHas('brand', function ($c) use ($request){
				$c->where('name',$request->brd);
			});
		}

		
		return $products->orderBy('order', 'ASC')->paginate(15);
	}


	public function amplifierCategory($request){
		$amplifiers = Amplifier::whereNull('status');
		if($request->condition){
			$amplifiers->where('condition', $request->condition);
		}

		if($request->type){
			$amplifiers->where('type' , $request->type);
		}

		if($request->from_price || $request->to_price){
			$amplifiers->where('sell_price', '>=', intval($request->from_price))->where('sell_price', '<=', intval($request->to_price));
		}

		if($request->up_to){
			$amplifiers->where('sell_price', '>=', intval($request->up_to));
		}

		if($request->from_year){
			$amplifiers->where('year','>=', $request->from_year)->where('year', '<=', $request->to_year);
		}
		if($request->up_year){
			$amplifiers->where('year', $request->up_year);
		}

		if($request->brd){
			$amplifiers->whereHas('brand', function ($c) use ($request){
				$c->where('name',$request->brd);
			});
		}
		
		return $amplifiers->paginate(15);
	}
}

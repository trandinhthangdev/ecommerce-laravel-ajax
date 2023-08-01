<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\News;
use App\HomeSlider;
use App\ProductSlider;
use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Mail\CheckOutMail;
use App\CheckOut;
use App\ReceivedProduct;
use App\Contact;
use App\ProductComment;
use App\NewsComment;
use App\Star;
use Mail;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
	public function __construct()
	{
		$category = Category::where('status', 1)->get();
		$brand = Brand::where('status', 1)->get();
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id', $user_id)->first();
            view()->share(
                [
                    'category' => $category,
                    'brand' => $brand,
                    'customer' => $customer
                ]
            );
        }
        else
        {
    		view()->share(
    			[
    				'category' => $category,
    				'brand' => $brand
    			]
    		);
        }
	}

    public function home()
    {
    	$home_slider = HomeSlider::where('status', 1)->get();
    	$category_featured = Category::where('status', 1)->where('featured', 1)->take(3)->get();
    	$product_featured = Product::where('status', 1)->where('featured', 1)->orderBy('id','DESC')->take(8)->get();
    	$product_recently_added = Product::where('status', 1)->orderBy('id','DESC')->take(8)->get();
    	$last_news = News::where('status', 1)->orderBy('id','DESC')->take(8)->get();
    	return view('client.pages.home',
    		[
    			'home_slider' => $home_slider,
    			'category_featured' => $category_featured,
    			'product_featured' => $product_featured,
    			'product_recently_added' => $product_recently_added,
    			'last_news' => $last_news
    		]
    	);
    }

    public function product()
    {
    	$new_product = Product::where('status', 1)->orderBy('id','DESC')->paginate(9);
    	return view('client.pages.new-product',
    		[
    			'new_product' => $new_product,
    		]
    	);
    }

    public function category_product($category_slug, $category_id)
    {
    	$category_one = Category::find($category_id);
    	$category_product = Product::where('status', 1)->orderBy('id','DESC')->where('category_id', $category_id)->paginate(9);
    	return view('client.pages.category-product',
    		[
    			'category_one' => $category_one,
    			'category_product' => $category_product
	    	]
	    );
    }

    public function brand_product($category_slug, $category_id, $brand_slug, $brand_id)
    {
    	$category_one = Category::find($category_id);
    	$brand_one = Brand::find($brand_id);
    	$brand_product = Product::where('status', 1)->orderBy('id','DESC')->where('brand_id', $brand_id)->paginate(9);
    	return view('client.pages.brand-product',
    		[
    			'category_one' => $category_one,
    			'brand_one' => $brand_one,
    			'brand_product' => $brand_product,
	    	]
	    );
    }

    public function news()
    {
    	$last_news = News::where('status', 1)->orderBy('id', 'DESC')->paginate(9);
    	$featured_news = News::where('status', 1)->where('featured', 1)->orderBy('id', 'DESC')->take(6)->get();
    	return view('client.pages.news',
	    	[
	    		'last_news' => $last_news,
	    		'featured_news' => $featured_news
	    	]
    	);
    }

    /* News Detail */
    public function news_detail($news_id, $news_slug)
    {
    	$news = News::find($news_id);
    	$popular_news = News::where('status', 1)->where('featured', 1)->orderBy('view', 'DESC')->take(6)->get();
        $news_comment = NewsComment::where('news_id', $news_id)->orderBy('id', 'DESC')->get();

    	return view('client.pages.news-detail',
    		[
    			'news' => $news,
    			'popular_news' => $popular_news,
                'news_comment' => $news_comment
    		]
    	);
    }

    public function send_comment_news(Request $request)
    {
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id', $user_id)->first();
            $customer_id = $customer->id;
            $news_id = $request->news_id;
            $comment = $request->comment;
            $data_send_comment_news = [
                'customer_id' => $customer_id,
                'news_id' => $news_id,
                'content' => $comment
            ];
            NewsComment::create($data_send_comment_news);

            return "Bạn đã bình luận thành công !";
        }
    } 
     


    /* Product Detail */ 
    public function product_detail($product_id, $product_slug)
    {
    	$product = Product::find($product_id);
        $product_slider = ProductSlider::where('product_id', $product_id)->get();
        $product_featured = Product::where('status', 1)->where('featured', 1)->orderBy('id','DESC')->take(6)->get();

        $brand_id = $product->brand_id;
        $product_related = Product::where('status', 1)->where('brand_id', $brand_id)->where('id', '<>', $product_id)->orderBy('id','DESC')->take(6)->get();

        $product_comment = ProductComment::where('product_id', $product_id)->orderBy('id','DESC')->get();

        $product_star = Star::where('product_id', $product_id)->orderBy('id','DESC')->get();

        $check_received_product = 0;
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id', $user_id)->first();
            $customer_id = $customer->id;
            if(ReceivedProduct::where('customer_id', $customer_id)->where('product_id', $product_id)->first() != null)
            {
                if(Star::where('customer_id', $customer_id)->where('product_id', $product_id)->first() == null)
                {
                    $check_received_product = 1;
                }         
            }
        }

    	return view('client.pages.product-detail',
    		[
    			'product' => $product,
                'product_slider' => $product_slider,
                'product_featured' => $product_featured,
                'product_related' => $product_related,
                'product_comment' => $product_comment,
                'product_star' => $product_star,
                'check_received_product' => $check_received_product,
    		]
    	);
    }


    public function send_comment_product(Request $request)
    {
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id', $user_id)->first();
            $customer_id = $customer->id;
            $product_id = $request->product_id;
            $comment = $request->comment;
            $data_send_comment_product = [
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'content' => $comment
            ];
            ProductComment::create($data_send_comment_product);
            return "Bạn đã bình luận thành công !";
        }
    }

    public function send_review_product(Request $request)
    {
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id', $user_id)->first();
            $customer_id = $customer->id;
            $product_id = $request->product_id;
            $content = $request->content;
            $number_star = $request->number_star;
            $data_review_product = [
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'number_star' => $number_star,
                'content' => $content
            ];
            Star::create($data_review_product);

            $product = Product::find($product_id);

            $product_star = Star::where('product_id', $product_id)->get();
            $total_star = 0;
            $count = 0;

            foreach ($product_star as $pro_sta) {
                $total_star += $pro_sta->number_star;
                $count++;
            }

            $product_update_star = round($total_star/$count, 1);
            $data_update_product = [
                'star' => $product_update_star
            ];
            $product->update($data_update_product);


            return response()->json(['res_type' => 'success', 'response' => 'Bạn đã đánh giá sản phẩm thành công !']);
        }
    } 


    /* Contact */
    public function contact()
    {
        return view('client.pages.contact');
    }

    public function contact_post(Request $request)
    {
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id', $user_id)->first();
            $customer_id = $customer->id;
            $message = $request->message;
            $data_contact = [
                'customer_id' => $customer_id,
                'message' => $message
            ];
            Contact::create($data_contact);
            return "Cảm ơn bạn đã gửi cho chúng tôi !";
        }
    }



    public function about()
    {
        return view('client.pages.about');
    }

    /* Cart */

    public function show_cart()
    {
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id', $user_id)->first();
            $customer_id = $customer->id;
            $order = Order::where('customer_id',$customer_id)->first();
            if($order != null)
            {
                $order_id = $order->id;
                $order_detail = OrderDetail::where('order_id', $order_id)->get();

                return response()->json($order_detail);
            }   
        }
        else
        {
            return response()->json('');
        }
    }

    public function product_info(Request $request)
    {
        $product_id = $request->product_id;
        $product_info = Product::find($product_id);
        return response()->json($product_info);
    }

    public function add_to_cart(Request $request)
    {
        $user_id = Auth::user()->id;
        $customer = Customer::where('user_id',$user_id)->first();

        $customer_id = $customer->id;
        $order = Order::where('customer_id',$customer_id)->first();
        if($order != null)
        {
            $order_id = $order->id;
        }
        else
        {
            $data_order['customer_id'] = $customer_id;
            $order_id = Order::create($data_order)->id;
        }

        $product_id = $request->product_id;
        $check_product_cart = OrderDetail::where('order_id',$order_id)->where('product_id', $product_id)->first();
        if($check_product_cart != null)
        {
            return response()->json(['res_type' => 'error', 'response' => 'Sản phẩm này đã có trong giỏ hàng của bạn !']);
        }
        else
        {
            $data_order_detail = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => 1
            ];
            OrderDetail::create($data_order_detail);
            return response()->json(['res_type' => 'success', 'response' => 'Đã thêm sản phẩm vào giỏ hàng của bạn thành công !']);
        }    

    }

    public function delete_product_cart(Request $request)
    {

        $order_detail_id = $request->order_detail_id;
        $order_detail = OrderDetail::find($order_detail_id);
        $order_detail->delete();
        return response()->json(['res_type' => 'success', 'response' => 'Đã xóa sản phẩm trong giỏ hàng thành công !']);
    }

    public function update_quantity_order_detail(Request $request)
    {
        $order_detail_id = $request->order_detail_id;
        $change_quantity = $request->change_quantity;
        $order_detail = OrderDetail::find($order_detail_id);
        $product_id = $order_detail->product_id;
        $product = Product::find($product_id);
        $quantity = $product['quantity'];
        if($quantity < $change_quantity)
        {
            return response()->json(['res_type' => 'error', 'response' => 'Bạn đã thêm tối đa số lượng sản phẩm vào giỏ hàng !']);
        }
        else 
        {
            $data_update_order_detail = [
                'quantity' => $change_quantity
            ];
            $order_detail->update($data_update_order_detail);
            return response()->json(['res_type' => 'success', 'response' => 'Bạn đã thay đổi thành công !']);
        }
    }


    /* Checkout */
    public function checkout()
    {
        if(Auth::check() && Auth::user()->role == 0)
        {
            $user_id = Auth::user()->id;
            $customer = Customer::where('user_id',$user_id)->first();
            return view('client.pages.check-out', ['customer'=>$customer]);
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function check_out_post(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $customer = Customer::where('user_id',$user_id)->first();
        $customer_id = $customer->id;

        /* Check out */
        $check_out['customer_id'] = $customer_id;
        $check_out['order_detail'] = $request->order_detail;
        $check_out['status'] = 0;   
        $token_check_out = rand();
        while(CheckOut::where('token_check_out', $token_check_out)->first() != null)
        {
            $token_check_out = rand();
        }
        $check_out['token_check_out'] = $token_check_out;
        $check_out = CheckOut::create($check_out);


        /* Delete Order Detail - Create Received Product */
        $order = Order::where('customer_id', $customer_id)->first();
        $order_id = $order->id;
        $order_detail = OrderDetail::where('order_id', $order_id)->get();

        foreach ($order_detail as $ord) {
            $quantity = $ord->quantity;
            $product_id = $ord->product_id;
            $product = Product::find($product_id);

            $product_quantity = $product->quantity;
            $product_quantity_update = $product_quantity-$quantity;

            

            $data_update_product = [
                'quantity' => $product_quantity_update
            ];

            $product->update($data_update_product);

            $data_received_product = [
                'customer_id' => $customer_id,
                'product_id' => $product_id
            ];

            ReceivedProduct::create($data_received_product);
            $ord->delete();
        }
        
        /* Check mail */
        Mail::to($user->email)->send(new CheckOutMail($check_out));
        return 'Bạn đã check out thành công hãy xác nhận mua hàng qua mail của bạn !';
    }

    public function check_out_confirm($token_check_out)
    {
        $check_out = CheckOut::where('token_check_out', $token_check_out)->first();
        if($check_out != null)
        {
            $check_out['status'] = 1;
            $check_out['token_check_out'] = '';
            $check_out->save();
        }
        return redirect()->route('home');
    }





}

<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\BaseController;
use App\Models\Cards;
use App\Models\Carts;
use App\Models\Checkouts;
use App\Models\checkout_address;
use App\Models\c_checkout;
use App\Models\Products;
use App\Models\Shipping;
use App\Models\Surveys;
use App\Models\user;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Payments;
// use App\Models\User;

use Illuminate\Http\Request;

// use     Auth;
use Illuminate\Support\Facades\Validator;
// use phpseclib3\Crypt\Hash;


class AdminController extends BaseController
{
    // user register api
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
             'phone_no' => 'required',
            'gender' =>'required',
            'password' => 'required',
            'c_password' => 'required|same:password',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $input['c_password'] = Hash::make($input['c_password']);
         $s =    $input['role'] = '1';

        if($s === 1){
            $input['admin_password']= "";
        }




        $user = user::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User register successfully.');
    }

   

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\JsonResponse
     */
    // user login api
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            $success['id'] = $user->id;
            $success['email'] = $user->email;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    // product insert api

    // public function product_insert(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required',
    //         'image_url' => 'required',
    //         'price' => 'required',  
    //     ]);
    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     $input = $request->all();
    //     $products = products::create($input);
    //     $success['title'] = $products->title;

    //     $imageName = time().'.'.$request->image_url->extension();  

    //     $request->image->move(public_path('images'), $imageName);

    //     return $this->sendResponse($success, 'Products created successfully.');

    // }

    // product show api
    public function show()
    {
        $Products = Products::all();

        if (is_null($Products)) {
            return $this->sendError('Products not found.');
        }

        return $this->sendResponse($Products, 'Products retrieved successfully.');
    }

    public function get_pro_byid(Request $request){
        $pro = Products::where('id',$request->id)->get();
        return $this->sendResponse($pro, 'Products retrieved successfully.');

    } 




    //display limited products at the homepage api
    public function pro_display_home()
    {
        $products = Products::inRandomOrder()->limit(3)->get();

        if (is_null($products)) {
            return $this->sendError('Products not found.');
        }

        return $this->sendResponse($products, 'Products retrieved successfully.');
    }

    //cart data display api
    public function cart_show(Request $request)
    {
        // $product = Products::all();
        // $cart = Carts::all();
        $c = Carts::join('Products', 'carts.p_id', '=', 'Products.id')->where('carts.u_id', $request->u_id)->where('carts.status', 0)

            ->get(['Products.title', 'Products.image_url', 'carts.price', 'carts.qty', 'carts.total', 'carts.id', 'products.id']);

        if (is_null($c)) {
            return $this->sendError('cart is empty');
        }
        else  {
            return $this->sendResponse($c, 'products stored in cart');
        }
        // $input = $request->all();
        // $cart = Carts::get($input);
        // $success['id'] = $cart->id;


        // $cart = $request->id;
        // $success['id'] = $cart->id;

        // return $this->sendResponse($c, 'products stored in cart');
    }

    //insert product inside cart api
    public function pro_insert_cart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_id' => 'required',
            'u_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $cart = Carts::create($input);
        $success['id'] = $cart->id;
        $success['u_id'] = $cart->u_id;
        return $this->sendResponse($success, 'product added to cart');
    }
    // forget password api
    public function forget_pass(Request $request, user $user)
    {
        $user = user::where('email', $request->email)->get();
        // return $this->sendResponse($user, 'updated succesfully');
        // print_r($user);
        // echo("<pre>");
        // die();
        $data = $request->all();
        $validator = Validator::make($data, [
            // 'email' => 'required|email|exists:users',
            'password' => 'required',
            'c_password' => 'required'

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }



        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['c_password'] = bcrypt($input['c_password']);
        $u = user::where('email', $request->email)->update($input);
        if ($u === true) {

            return $this->sendResponse($u, 'updated succesfully');
        } else {
            return $this->sendResponse($u, 'update unsuccesfully');
        }
    }



    






    //update_password_api
    public function update_password(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'currentpass' => 'required',
            'password' => 'required',
            'c_password' => 'required'

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = $request->user();
        if(hash::check($request->currentpass,$user->password)){

            if(strcmp($request->get('password'), $request->get('c_password')) == 0){
               

                $user->update([
                    'password'=>hash::make($request->password)
                ]);
                return  $this->sendResponse('ok', 'password update'); }else{
                    return  $this->sendError('nok', 'confirm password did not match'); 
                }
        }else{
            return  $this->sendError('nok', 'old pass does not   match'); 
        }


    }

    //edit user detail in my profile page
    public function edit(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'email'=> 'required',
           
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $u = user::where('id',$request->id)->update($input);
        if($u !==  true){
           return $this->sendResponse($u, 'updated unsuccesfully');
        }
        else{
           return $this->sendResponse($u, 'update succesfully');
        }
      
        
    }

    // get user detail

 public function get_user_detail(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            
            'id' =>'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $u = user::where('id',$request->id)->first();
        if($u ===  true){
            return $this->sendResponse($u, 'updated unsuccesfully');
         }
         else{
            return $this->sendResponse($u, 'fetched value');
         }
    }

public function search_pro(Request $request){
    $data = $request->all();
    
   $e =  $data['title'];

    $result = Products::where('title', 'Like' , '%' .$e. '%' )->get();
    if(count($result)){
        return $this->sendResponse($result, 'searched succes');
    }else{
        $this->sendError('nok', 'searcg error'); 
    }
}










    // store shipping data in shipping database  api

    public function shipping_api(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'u_id' => 'required',
            "c_id" => 'required',
            'addres' => 'required|string|min:5',
            'add_t' => 'required|min:5|string',
            'city' => 'required|string|min:5',
            'state' => 'required',
            'city_code' => 'required|min:3',
            'email' => 'required|string|min:5',
            'phone_number' => 'required|integer|min:10'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        // print_r($input);
        // print("<pre>");
        // exit();
        $ship = Shipping::create($input);
        $succes['first_name'] = $ship->first_name;
        return $this->sendResponse($succes, 'shipping data stored successfully');
    }

    // get cart_id api
    public function get_cart_id(Request $request)
    {


        $input = Carts::where('u_id', $request->u_id)->where('status', '!=', 1)->get('id');
        $cartarray = array();
        foreach ($input as $key => $i) {
            $cartarray[$key] = $i->id;
        }
        $cart_ids = implode(',', $cartarray);
        return $this->sendResponse($cart_ids, 'cart ids');
    }




    // place orders api not required
    public function place_order(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'card_number' => 'required|min:16|integer',
            'card_name' => 'required',
            'expiry_date' => 'required',
            'cvc_code' => 'required|min:3|integer',
            'address' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $order = Cards::create($input);
        $succes['card_name'] = $order->card_name;
        return $this->sendResponse($succes, 'your order is placed');
    }

    // api for payment where check payment fields wriiteen and data store in card table should same then provide option for payment

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_id' => 'required',
            'c_id' => 'required',
            // 'card_id'=>'required',
            'order_status' => 'required',
            // 'order_number'=>'required',
            'payment_status' => 'required',

            'card_number' => 'required',
            'card_name' => 'required',
            'expiry_date' => 'required',
            'cvc_code' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $detail = Cards::where('card_number', '=', $request->card_number)->where('card_name', '=', $request->card_name)->where('expiry_date', '=', $request->expiry_date)->where('cvc_code', '=', $request->cvc_code)->first();
        $input['card_id'] = $detail->id;
        // return($detail);
        // die();



        $checkout_id =  Checkouts::orderBy('id', 'desc')->first();


        // return($checkout_id);

        $str = $checkout_id->id;
        $stringLength = Str::length($str);
        $year = date("Y");
        if ($stringLength == 1) {
            $input['order_number'] = "ORD-$year-000$checkout_id->id";
            $f = $input['order_number'];
        } else if ($stringLength == 2) {
            $input['order_number'] = "ORD-$year-00$checkout_id->id";
            $f = $input['order_number'];
        } else if ($stringLength == 3) {
            $input['order_number'] = "ORD-$year-0$checkout_id->id";
            $f = $input['order_number'];
        } else if ($stringLength == 4) {
            $input['order_number'] = "ORD-$year-00$checkout_id->id";
            $f = $input['order_number'];
        }

        if (isset($detail) && !empty($detail)) {

            $checkout = Checkouts::create($input);

            // $ordernum_get = Checkouts::where('order_number',$request->order_numberd)->first();

            $a = Carts::where('u_id', $request->u_id)->update([
                'status' => 1
            ]);
            $b = [
                'u_id' => $request->u_id,
                'c_id' => $request->c_id,
                'o_id' => $f,
                'status' => 1,
                'date' => now(),
            ];

            $storedata_in_payment_table = Payments::create($b);
            return ($storedata_in_payment_table);

            // return ($checkout);
        } else {
            return $this->sendResponse($detail, 'some details did not match');
        }
    }

    // public function get_card_id(Request $request){
    //     // $validator = Validator::make($request->all(),[
    //     //     'card_id'=>'required' 
    //     // ]);
    //     // if ($validator->fails()) {
    //     //     return $this->sendError('Validation Error.', $validator->errors());
    //     // }
    //     $input = Cards::where('id','=',$request->card_id)->get();
    //     if(count($input)>0){
    //         return $this->sendResponse($input,'valid card id');
    //     }
    //     else{
    //         return $this->sendResponse($input,' not valid card id');
    //     }

    // }


    // api to get order number
    public function get_order_number(Request $request)
    {
        $input = Checkouts::where('u_id', $request->u_id)->orderBy('id', 'desc')->first('order_number');
        return $this->sendResponse($input, 'ordernumber');
    }
    public function my_orders(Request $request)
    {

        $c = Products::join('carts', 'products.id', '=', 'carts.p_id')
            ->join('payments', 'carts.id', '=', 'payments.c_id')
            ->join('checkouts','payments.c_id','=','checkouts.c_id')
            ->get(['products.title', 'products.id', 'products.image_url', 'carts.price', 'carts.qty', 'carts.total', 'payments.status' ,'checkouts.order_number']);

        if (isset($c) && !empty($c)) {

            return $this->sendResponse($c, 'data');
        } else {
            return $this->sendError($c, 'cc');
        }
    }




    // api for product details
    public function details(Request $request)
    {

        $c = Products::where('id', $request->id)->get(['products.title', 'products.image_url', 'products.id']);

        //  $pro_id =  Products::orderBy('id', 'desc')->first();

        if (isset($c) && !empty($c)) {

            return $this->sendResponse($c, 'data');
        } else {
            return $this->sendError($c, 'cc');
        }
    }

    // api to remove product from cart
    public function remove_pro_from_cart(Request $request)
    {


        $query = Carts::select('id')->where('u_id', $request->u_id)
            ->where('p_id', $request->p_id)->delete();


        if (isset($query) && !empty($query)) {

            return $this->sendResponse($query, 'deleted sucess');
        } else {
            return $this->sendError($query, 'data is not deleted');
        }
    }



    // api survey_form

    public function survey_api(Request $request){

        $query = User::where('email',$request->email)->select('id')
                ->first();

        


                // print_r("<pre>");
                // print_r($query);
                // die();
           
              
                $data = array(
                    "user_id" =>$query->id,
                    "response_first" => $request->response_first,
                    "response_second" => $request->response_second,
                  );


                  $ship = Surveys::create($data);

       
        return $this->sendResponse($data, 'value stored');

    }

// ch apis
public function addCheckoutAddress(Request $request)
{
  $data = $request->all();

  if (empty($data['user_id'])) :
    if (isset($data['token']) && !empty($data['token'])) :

      $data['user_id'] = (new Parser())->parse($data['token'])->getClaims()['sub']->getValue();

  endif;
endif;
try {
  $validator = Validator::make($data, [
    'user_id' => 'required',
    'patient_firstname' => 'required',
    'patient_lastname' => 'required',
      //'addressline1' => '',
      //'addressline2' => '',
    'city' => 'required',
    'state' => 'required',
    'zipcode' => 'required',
    'email' => 'required',
    'phone' => '',
    'address_type' => 'required',
  ]);
  if ($validator->fails()) {
    return $this->sendError('Validation Error.', $validator->errors()->all());
  }

  $checkoutaddressdata = c_checkout::create($data);

  return $this->sendResponse($checkoutaddressdata, 'Address added Successfully');
} catch (\Exception $ex) {
  return $this->sendError('Server error', array($ex->getMessage()));
}
}

public function user_show($id)
{


  $user = User::find($id);
  //$success['user_id'] =  $user->id;
  $dateOfBirth = $user->dob;
  $age = Carbon::parse($dateOfBirth)->age;
//   $case_status =  CaseManagement::where("user_id", $user->id)->OrderBy("id", "DESC")->get();

  $order_status = c_checkout::where("user_id", $user->id)->first();

  $complete = true;
  $prescribe_order = false;
  $non_prescribe_order = false;
  $prescribe_non_prescribe_order = false;
//   $case_count = count($case_status);
//   if (isset($case_status[0]) && $case_status[0]->case_status == 'completed') {
//     $complete = false;
//   }

  $status = false;
  if (isset($order_status) && $order_status->user_id == $user->id) {
    if ($order_status->medication_type == 2) {
      $status = true;
    }
  }

  if (isset($case_status[0]) && isset($order_status) && $order_status->user_id == $user->id) {
    $prescribe_non_prescribe_order = true;
  }
//    else if (isset($case_status[0]) && $case_status[0]->case_status == 'completed') {
//     $prescribe_order = true;
//   }
   else {
    if (isset($order_status) && $order_status->user_id == $user->id) {
      if ($order_status->medication_type == 2) {
        $non_prescribe_order = true;
      }
    }
  }
  $user['age'] = $age;
  $user['case_status'] = $complete;
  $user['order_status'] = $status;
  $user['case_count'] = 0;
  $user['prescribe_order'] = $prescribe_order;
  $user['non_prescribe_order'] = $non_prescribe_order;
  $user['prescribe_non_prescribe_order'] = $prescribe_non_prescribe_order;
  return $this->sendResponse($user, 'user Retrived successfully');
}

public function getCheckoutAddress(Request $request)
{
  try {
    $checkout_data = c_checkout::where('user_id', $request->user_id)->where('address_type', '1')->OrderBy('id', 'desc')->first();
    //$checkout_data = Checkout::where('user_id', $request->user_id)->where('cart_id', $request->cart_id)->first();
    if (!empty($checkout_data)) {
      return $this->sendResponse($checkout_data, 'Checkout Address data retrieved successfully.');
    } else {
      return $this->sendResponse($checkout_data = array(), 'No Data Found.');
    }
  } catch (\Exception $ex) {
    return $this->sendError('Server error', array($ex->getMessage()));
  }
}

public function store(Request $request)
{
  $data = $request->all();


  $last_checkout_id = c_checkout::OrderBy('id', 'desc')->first();
  $order_id = "00000001";
  if (!empty($last_checkout_id)) {
    $year = substr($last_checkout_id['order_id'], 4, -9);
    $current_year = date("Y");

    if (!empty($last_checkout_id['order_id']) && ($year == $current_year)) {
      $id = (int)substr($last_checkout_id['order_id'], 9) + 1;
      $order_id = str_pad($id, 8, '0', STR_PAD_LEFT);
    }
  } else {
    $order_id = "00000001";
  }

  $order_id = "ORD-" . date("Y") . "-" . $order_id;
  $data['order_id'] = $order_id;

  //start make paymet and create curexa/shippo order
  $newrequest = new \Illuminate\Http\Request();

  if (isset($data['ordertype']) && !empty($data['ordertype'])) {
    if ($data['ordertype'] == "Non-prescribe") {
      $newrequest->replace([
        'order_id' => $data['order_id'],
        'name' => $data['name'],
        'email' => $data['email'],
        'amount' => $data['amount'],
        'telemedicine_fee' => $data['telemedicine_fee'],
        'gift_code_discount' => $data['gift_code_discount'],
        'tax' => $data['tax'],
        'handling_fee' => $data['handling_fee'],
        'stripeToken' => $data['stripeToken'],
        'card_name' => $data['card_name'],
        'ordertype' => $data['ordertype'],
      ]);
      $payment = (new AdminController)->store($newrequest);
      //dd($payment->original);
      if (isset($payment->original) && !empty($payment->original)) {
        if ($payment->original['success'] == false) {
          return $this->sendError($payment->original['message'], '');
        } else {
          $data["transaction_id"] = $payment->original["data"]["transaction_id"];
          $data["customer"] = $payment->original["data"]["customer"];
          $data["payment_method"] = $payment->original["data"]["payment_method"];
          $data["payment_status"] = $payment->original["data"]["payment_status"];
          $data["transaction_complete_details"] = $payment->original["data"]["transaction_complete_details"];
        }
      }
    }
  }

  if (empty($data['user_id'])) :
    if (isset($data['token']) && !empty($data['token'])) :

      $data['user_id'] = (new Parser())->parse($data['token'])->getClaims()['sub']->getValue();

  endif;
endif;
  // try{
$validator = Validator::make($data, [
  'user_id' => 'required',
]);
if ($validator->fails()) {
  return $this->sendError('Validation Error.', $validator->errors()->all());
}


  //code to insert data in checkout table
if ($data['medication_type'] == 2) {
  $checkout_data_exist = [];
} else {
  $checkout_data_exist = c_checkout::where('user_id', $data['user_id'])->where('case_id', $data['case_id'])->first();
}

if (isset($data['handling_fee']) && !empty($data['handling_fee'])) {
  $handling_fee = $data['handling_fee'];
} else {
  $handling_fee = 0;
}
if (isset($data['lowincome_fee']) && !empty($data['lowincome_fee'])) {
  $lowincome_fee = $data['lowincome_fee'];
} else {
  $lowincome_fee = 0;
}
if (isset($data['telemedicine_fee']) && !empty($data['telemedicine_fee'])) {
  $telemedicine_fee = $data['telemedicine_fee'];
} else {
  $telemedicine_fee = 0;
}
if (isset($checkout_data_exist) && !empty($checkout_data_exist)) {
  $checkout_data_exist = $checkout_data_exist->toArray();
  if (count($checkout_data_exist) > 0) {
    $update_checkout = array();
    $update_checkout['card_name'] = $data['card_name'];
    $update_checkout['cart_id'] = $data['cart_id'];
    $update_checkout['case_id'] = $data['case_id'];
    $update_checkout['email'] = $data['email'];
    $update_checkout['gift_code_discount'] = $data['gift_code_discount'];
    $update_checkout['handling_fee'] = $handling_fee;
    $update_checkout['lowincome_fee'] = $lowincome_fee;
    $update_checkout['medication_type'] = $data['medication_type'];
    $update_checkout['order_id'] = $data['order_id'];
    $update_checkout['patient_firstname'] = $data['patient_firstname'];
    $update_checkout['patient_lastname'] = $data['patient_lastname'];
    $update_checkout['shipping_addreess_id'] = $data['shipping_addreess_id'];
    $update_checkout['shipping_fee'] = $data['shipping_fee'];
    $update_checkout['tax'] = $data['tax'];
    $update_checkout['telemedicine_fee'] = $telemedicine_fee;
    $update_checkout['total_amount'] = $data['total_amount'];
    $update_checkout['user_id'] = $data['user_id'];

    $checkoutdata = c_checkout::where('user_id', $data['user_id'])->where('case_id', $data['case_id'])->update($update_checkout);
    $checkout_id = $checkout_data_exist['id'];
    $checkoutdata = $checkout_data_exist;
  }
} else {
  $checkoutdata = c_checkout::create($data);
  $checkout_id = $checkoutdata->id;
}


$checkcout_address = checkout_address::where('user_id', $data['user_id'])->where('address_type', 1)->where('order_id', null)->OrderBy('id', 'DESC')->first();
$billing_address = checkout_address::where('user_id', $data['user_id'])->where('address_type', 2)->where('order_id', null)->OrderBy('id', 'DESC')->first();

if (!empty($checkcout_address)) {
  $update_checkout_address  =  checkout_address::where('id', $checkcout_address['id'])->update(['order_id' => $checkout_id]);
}
if (!empty($billing_address)) {
  $update_checkout_address  =  checkout_address::where('id', $billing_address['id'])->update(['order_id' => $checkout_id]);
}
$data['checkoutOrderId'] = $checkout_id;
if ($request->medication_type == "2") {
  sleep(3);
    //$addToshipstation = shipStationHelper::createOrder_nonprescribed($data);
  shippoHelper::create_non_pres_order_shippo($data);
  $addToshipstation = "";
  }  else {
    $addToshipstation = "";
  }


  //end of code to insert data in checkout table

  return $this->sendResponse($checkoutdata, 'Order Created Successfully');
}

// public function createShippo()
// {
//     $address = array(
//         'name' => 'Laura Collins',
//         'street1' => 'Apt. C 1101 , Lupine Ct',
//         'city' => 'Raleigh',
//         'state' => 'NC',
//         'zip' => '27606',
//         'country' => 'US',
//         'phone' => '+1 6043499495'
//     );
//     $notes = 'iPledge ID:  9926815226';
//     $product_name = 'Accutane';
//     $order_id = 'F03-2022-00000461';
//     $dp = shippoHelper::create($address, $notes, $product_name, $order_id);
//     // $toAddress = array(
//     //     'name' => 'Mr Hippo"',
//     //     'street1' => '141 , Post Rd E',
//     //     'city' => 'Westport',
//     //     'state' => 'CT',
//     //     'zip' => '06880',
//     //     'country' => 'US',
//     //     'phone' => '+1 6043499495'
//     // );
//     // $dp = shippoHelper::createShipment($toAddress);
//     return $dp;
// }

// public function cart_update(Request $request, $id)
//     {


//         if (isset($request['change_pharmacy'])) {
//             $change_pharmacy = $request['change_pharmacy'];
//         } else {
//             $change_pharmacy = 0;
//         }


//         $data = $request->all();
//         if (isset($request['change_pharmacy'])) {
//             unset($data['change_pharmacy']);
//         }





//         /*try {*/
//         $cart = Carts::find($id);

//         /*Start - code for  pharmacy logic for CH pharmacy network */
//         $userAddress = getUserShippingAddress($cart['user_id']);
//         $shippoStates = getShippoStates();

//          $checkout_data = c_checkout::where('user_id',$cart['user_id'])->select('case_id')->first();

//             $product_type = getUserProduct($cart['user_id'], $checkout_data['case_id']);
//             $pharmacy_address = '-';
//             if(isset($data['pharmacy_pickup']) && $data['pharmacy_pickup'] == 'cash'){

//                 $data['pharmacy_pickup_address'] = '';
//                 $data['pharmacy_name'] = '';
                
//               if ($product_type == 'Accutane' && in_array($userAddress->state, $shippoStates)) {
//                 if(isset($data['pharmacy_pickup'])){
//                     $data['pharmacy_pickup'] = 'Hillcrest';
                    
//                 }
//             }
//         }

//         /*End - code for  pharmacy logic for CH pharmacy network */

       
//         return $this->sendResponse(array(), 'Cart Updated Successfully');
       
//     }
}

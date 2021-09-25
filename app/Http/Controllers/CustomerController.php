<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerController extends Controller
{

	/**
	 *
	 */
	public function __construct() {
		$this->middleware('customer:api', ['except' => ['login', 'register', 'index', 'logout']]);
	}

	/**
	 * 
	 */
	public function index() {
		## Get all customers
		$customers = Customer::all();
		return response()->json($customers);
	}

	/**
	 *
	 */
	public function login(Request $request) {

		## Field Validation
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required|string|min:6'
		]);

		## Failed Validation
		if ($validator->fails()) {

			## return Bad Request
			return response()->json($validator->errors(), 400);
		}

		## One day token validity
		$token_validity = 24 * 60;

		$this->guard()->factory()->setTTL($token_validity);

		## Wrong Email or Password
		if (!$token = $this->guard()->attempt($validator->validated())) {

			## return Unauthorized
			return response()->json(['error' => 'unauthorized'], 401);
		}

		## Successful Login
		return $this->respondWithToken($token);
	}

  /**
   *
   */
  public function logout() {

    $this->guard()->logout();

    ## Successful logout
    return response()->json(['message' => 'User logged out successfully']);

  }
	
  /**
   *
   */
  protected function respondWithToken($token) {

    return response()->json([
      'token' => $token,
      'token_type' => 'bearer',
      'token_validity' => $this->guard()->factory()->getTTL() * 60
    ]);
  }

  /**
   *
   */
  protected function guard() {

    return Auth::guard();
  }
}

<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    /**
     * 
     */
    public function index() {
			## Get all Logins
      $logins = Login::all();
			return response()->json($logins); 
    }

		/**
		 * 
		 */
		public function add() {
			DB::table('logins')->insert(['created_at' => now()]);
		}
}

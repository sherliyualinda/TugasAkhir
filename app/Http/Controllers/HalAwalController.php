<?php

namespace App\Http\Controllers;


use App\Traits\NavbarTrait;


class HalAwalController extends Controller
{
    use NavbarTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    //protected $guarded=[];
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    
            public function halamanAwal(){
                return view('halamanAwal');
            }

        }
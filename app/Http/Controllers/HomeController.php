<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Call;
use PDF;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Call $call )
    {
        $this->middleware('auth');
        $this->users = $user;
        $this->call = $call;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch(Auth::user()->user_type){
            case 0:{
                return view('home');
            };
            break;
            case 1: {
                $dateS = Carbon::now()->subMonth(3); //->startOfMonth()
                $users = $this->users
                ->where("h_name", Auth::user()->h_name)
                ->where("user_type",'!=', Auth::user()->user_type)
                ->get();
                $uer_ids = $users->pluck('id')->toArray();
                $calls = $this->call->whereIn('user_id',$uer_ids)
                    ->where('created_at', '>=', $dateS)
                    ->latest()
                    ->paginate(25);
                return view('master-home', compact('users', 'calls'));
            }
            break;
            case 2:{
                return view('home');
            }
            break;
            default:{
                return view('home');
            }

        }
    }

    // Generate PDF
    public function createPDF() {
        // retreive all records from db
        $dateS = Carbon::now()->subMonth(3); //->startOfMonth()
        $users = $this->users
            ->where("h_name", Auth::user()->h_name)
            ->where("user_type",'!=', Auth::user()->user_type)
            ->get();
        $uer_ids = $users->pluck('id')->toArray();
        $calls = $this->call->whereIn('user_id',$uer_ids)
            ->where('created_at', '>=', $dateS)
            ->latest()
            ->get();
  
        // share data to view
        // return view('pdf_view', compact('users', 'calls'));
        view()->share('calls',$calls);
        $pdf = PDF::loadView('pdf_view', $calls);
  
        // download PDF file with download method
        return $pdf->download('NCS-call-records.pdf');
      }
}

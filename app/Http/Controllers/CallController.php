<?php

namespace App\Http\Controllers;

use App\User;
use App\Call;
use Illuminate\Http\Request;
use App\Events\NewMessage;
use App\Events\Reset;
use App\Events\LastLeave;


class CallController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Call $call)
    {
        $this->user = $user;
        $this->call = $call;
    }

    public function call(Request $request){
        try{
            $h_name = $request->hna;
            $f_number = $request->fno;
            $b_number = $request->bno;
            $b_type = $request->b_type;
            $r_no = $request->rno;
            $r_type = $request->r_type;

            $b_message = $r_type.' '.($r_no?$r_no:'').(($r_no?'':' ').$request->bno?$request->bno.' ':'').($b_type?$b_type:'');
            
            $call = $this->call->where([
                'h_name' => $h_name,
                'b_no' => $b_number,
                'f_no' => $f_number,
                'r_no' => $r_no,
                'r_type' => $r_type,
                'status' => 0
                ])->latest()->first();
                
            if(!$call || $call->status != 0){
                $user = $this->user->where('h_name',$h_name)->where('f_no',$f_number)->first();
                if($user){
                        $add_call = $this->call->create([
                            'user_id' => $user->id,
                            'h_name' => $h_name,
                            'b_no' => $b_number,
                            'r_no' => $r_no,
                            'f_no' => $f_number,
                            'b_type' => $b_type,
                            'r_no' => $r_no,
                            'r_type' => $r_type,
                        ]);
                    
                    $channel_name = "home".$user->id;
                   event(new NewMessage($channel_name, $h_name, $f_number, $b_number, $b_message));
                   
                   return response()->json([
                       "data" => null,
                       "status" => 200,
                       "error" => false,
                       "message" => "Event hit successful."
                   ], 200);
                }else{
                    return response()->json([
                        "data" => null,
                        "status" => 400,
                        "error" => true,
                        "message" => "User not found."
                    ], 400);
                }
            }else{
                return response()->json([
                    "data" => null,
                    "status" => 400,
                    "error" => true,
                    "message" => "Already done."
                ], 400);
            }
            


        }catch(\Exception $e){
            return response()->json([
                "data" => $e->getMessage(),
                "status" => 500,
                "error" => true,
                "message" => "Something went wrong"
            ], 500);
        }
    }

    public function reset(Request $request){
        try{
            $h_name = $request->hna;
            $f_number = $request->fno;
            $b_number = $request->bno;
            $b_type = $request->b_type;
            $r_no = $request->rno;
            $r_type = $request->r_type;
            $b_message = $r_type.' '.($r_no?$r_no.' ':'').($request->bno?$request->bno.' ':'').($b_type?$b_type:'');

            $calls = $this->call->where([
                'h_name' => $h_name,
                'f_no' => $f_number,
                'status' => 0
                ])->get();
            if(count($calls)>0){
                $user = $this->user->where('h_name',$h_name)->where('f_no',$f_number)->first();
                if($user){
                    $channel_name = "home".$user->id;
                    $update_call = $this->call->where([
                        'user_id' => $user->id,
                        'h_name' => $h_name,
                        'b_no' => $b_number,
                        'f_no' => $f_number,
                        'r_no' => $r_no,
                        'r_type' => $r_type,
                    ])->update(['status' => 1]);
                }
                
                if(count($calls) == 1){
                    event(new LastLeave($channel_name,$h_name, $f_number, $b_number, $b_message));
                }else{
                    event(new Reset($channel_name,$h_name, $f_number, $b_number, $b_message));
                }
                return response()->json([
                    "data" => null,
                    "status" => 200,
                    "error" => false,
                    "message" => "Event hit successful."
                ], 200);
            }else{
                return response()->json([
                    "data" => null,
                    "status" => 400,
                    "error" => false,
                    "message" => "No data found for this event."
                ], 200);
            }
            
        }catch(\Exception $e){
            return response()->json([
                "data" => $e->getMessage(),
                "status" => 500,
                "error" => true,
                "message" => "Something went wrong"
            ], 500);
        }
    }
}

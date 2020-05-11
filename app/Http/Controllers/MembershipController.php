<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class MembershipController extends Controller
{
   public function membership(Request $request){
         echo $request->status;

            
         $meta = MetaCSV::where('id_csv','=',$request->id)->get();
         
         if($meta->isEmpty()){

            Matching::where('id',$request->id)->update(['update_status'=>1]);
            $metaCSV = new MetaCSV;

            $metaCSV->id_csv = $request->id;
            $metaCSV->data = $request->data;
            $metaCSV->status = $request->status;
   
            $metaCSV->save();

            $data = [
                'status' => $request->status,
            ];
    
            try{
                $woocommerce = new Client(
                    'https://gerai.kompas.id',
                    'ck_3fa73e006c9a70433a0e93e087366d3742d6eef9',
                    'cs_0c3a50052941334ceb2a5300c4afc1f376df7eb9',
                    [
                        'wp_api' => true,
                        'version' => 'wc/v3',
                        'query_string_auth' => true
                    ]
                );
    
                //var_dump($woocommerce->put('orders/9984866',$data));
                dd($woocommerce->put('orders/'.$request->data, $data));
            }catch(HttpClientException $e){
                $e->getMessage();
                $e->getRequest(); // Last request data.
                $e->getResponse()->getBody(); // Last response data.
                dd($e);
            }  

         }else{
            dd('Data is already exist');
         }
        }
}

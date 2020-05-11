<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


// use App\Model\Apistatus;

class ApiController extends Controller
{
    public function index()
    {
        $category=array();

        // get owner membership
        $posts = DB::connection('mysql')
                    ->table('wp_g4i_posts')
                    ->select('id', 'post_author', 'post_date_gmt', 'post_title', 'post_parent', 'post_type')
                    ->where('post_type', 'wc_memberships_team')
                    ->where('post_author', 1241497)          
                    ->get();
 
        //list membership yang ada pada owner
        $postparent = DB::connection('mysql')
                    ->table('wp_g4i_posts')
                    ->select('id', 'post_author', 'post_date_gmt', 'post_title', 'post_parent', 'post_type')
                    ->where('post_type', 'wc_team_invitation')
                    ->where('post_author', 1241497)   
                    ->where('post_parent', 10297216)       
                    ->get();
                     

        $postmeta = DB::connection('mysql')
                    ->table('wp_g4i_postmeta')
                    ->select('*')
                    ->where('post_id', 10297216)
                    ->get();

                
        //get subscription_id owner
        $getsubs = DB::connection('mysql')
                    ->table('wp_g4i_postmeta')
                    ->select('*')
                    ->where('post_id', 10297212)
                    ->get();
                    dd($getsubs);
                    die();
            
    
    }   


}
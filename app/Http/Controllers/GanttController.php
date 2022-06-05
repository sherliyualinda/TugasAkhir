<?php
namespace App\Http\Controllers;
use App\Task;
use App\Link;
use App\Lahan;
 
class GanttController extends Controller
{
    public function get(){
        session_start();
        $tasks = new Task();
        $links = new Link();
 
        return response()->json([
            "data" => $tasks->orderBy('sortorder')->where('id_lahan', $_SESSION['id_lahan'] )->get(),
            "links" => $links->all()
        ]);
    }
    
}
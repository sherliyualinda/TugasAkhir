<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Task;
use App\Boq;

use Illuminate\Support\Facades\DB;
 
class TaskController extends Controller
{
    public function store(Request $request){
        // dd($request);
        session_start();
        $task = new Task();
 
        $task->text = $request->text ;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
        $task->sortorder = Task::max("sortorder") + 1;
        $task->id_lahan = $_SESSION['id_lahan'];
        $task->qty = 0;
        $task->satuan = 0;
        $task->harga = 0;
        $task->totalHarga = 0;
 
        $task->save();
        // DB::table('wbs')->insert([
        //     'id_kegiatan' => $task->id,
        //     'qty'   => 0,
        //     'satuan'   => '',
        //     'harga' => 0,
        //     'totalHarga' => 0,
        //     'updated_at' => date("Y-m-d H:i:s")
        // ]);
 
        return response()->json([
            "action"=> "inserted",
            "tid" => $task->id
        ]);
    }
 
    public function update($id, Request $request){
        $task = Task::find($id);
 
        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
      
 
        $task->save();

        if($request->has("target")){
            $this->updateOrder($id, $request->target);
        }
 
        return response()->json([
            "action"=> "updated"
        ]);
    }

    private function updateOrder($taskId, $target){
        $nextTask = false;
        $targetId = $target;
     
        if(strpos($target, "next:") === 0){
            $targetId = substr($target, strlen("next:"));
            $nextTask = true;
        }
     
        if($targetId == "null")
            return;
     
        $targetOrder = Task::find($targetId)->sortorder;
        if($nextTask)
            $targetOrder++;
     
        Task::where("sortorder", ">=", $targetOrder)->increment("sortorder");
     
        $updatedTask = Task::find($taskId);
        $updatedTask->sortorder = $targetOrder;
        $updatedTask->save();
    }
 
    public function destroy($id){
        $task = Task::find($id);
        $task->delete();
 
        return response()->json([
            "action"=> "deleted"
        ]);
    }
}

<?php
namespace App\Http\Controllers;
use App\Models\OptimizationWeight; use Illuminate\Http\Request;
class OptimizationWeightController extends Controller {
 public function index(){return view('optimization.index',['weights'=>OptimizationWeight::orderBy('id')->get()]);}
 public function update(Request $request){$data=$request->validate(['weights'=>'required|array','weights.*'=>'required|numeric|min:0|max:100']);if(abs(array_sum($data['weights'])-100)>0.01)return back()->withErrors(['weights'=>'Total bobot harus tepat 100.'])->withInput();foreach($data['weights'] as $id=>$weight)OptimizationWeight::whereKey($id)->update(['weight'=>$weight]);return back()->with('status','Bobot optimasi berhasil diperbarui.');}
}
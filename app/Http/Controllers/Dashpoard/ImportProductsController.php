<?php

namespace App\Http\Controllers\Dashpoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ImportProducts;

class ImportProductsController extends Controller
{
    public function create(){
        return view('dashpoard.products.import');
    }
    public function store(Request $request){
        $job = new ImportProducts($request->post('count'));
        $job->onQueue('import')->delay(now()->addMinutes(5));//->onConnection('import')
        dispatch($job);
        return redirect()->route('dashpoard.products.index')->with('success', 'Products imported successfully');
    }   
}

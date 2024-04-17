<?php

namespace App\Http\Controllers;

use App\Http\Requests\Calculation\CalculationRequest;
use App\Models\Calculation;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    protected $calculation;

    public function __construct(Calculation $calculation)
    {
        $this->calculation = $calculation;
    }

    public function index()
    {
        $calculations = Calculation::get();
        return view('calculation.index',compact('calculations'));
    }

    public function create()
    {
        return view('calculation.create');
    }

    public function store(CalculationRequest $request)
    {
        $value1 = $request->value1;
        $value2 = $request->value2;

        $percentage = ($value1 * $value2) / 100;

        $calculation = $this->calculation->create([
            'value1' => $value1,
            'value2' => $value2,
            'calculated_percentage' => $percentage
        ]);

        return redirect()->route('calculation.index')->with('success','Calculation Completed successfully');
    }

    public function edit($id)
    {
        $calculation = Calculation::where('id',$id)->first();
        return view('calculation.edit',compact('calculation'));
    }

    public function update(CalculationRequest $request, $id)
    {
        $value1 = $request->value1;
        $value2 = $request->value2;

        $percentage = ($value1 * $value2) / 100;

        $calculation = $this->calculation->where('id',$id)->update([
            'value1' => $value1,
            'value2' => $value2,
            'calculated_percentage' => $percentage
        ]);

        return redirect()->route('calculation.index')->with('success','Calculation Updated successfully');
    }

    public function delete($id)
    {
        $categoryData =  $this->calculation->where('id',$id)->delete();

        return redirect()->route('calculation.index')->with('success','Calculation Record Deleted successfully !!');
    }
}

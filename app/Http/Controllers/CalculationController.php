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
        switch ($request->operation) {
            case 'Add':
                $opeation = $request->value1 + $request->value2;
                $percentage = ($request->value2 / $opeation) * 100;
                break;
            case 'Subtract':
                $opeation = $request->value1 - $request->value2;
                $percentage = ($request->value2 / $opeation) * 100;
                break;
            case 'Multiply':
                $opeation = $request->value1 * $request->value2;
                $percentage = ($request->value2 / $opeation) * 100;
                break;
            case 'Divide':
                $opeation = $request->value1 / $request->value2;
                $percentage = ($request->value2 / $opeation) * 100;
                break;
        }

        $result = intval($percentage);
        $calPer = number_format($percentage,2);

        if($result >= 0 && $result <= 100)
        {
            $calData = $this->calculation->create([
                'value1' => $request->value1,
                'value2' => $request->value2,
                'operation' => $request->operation,
                'calculated_percentage' => $calPer
            ]);

            return redirect()->route('calculation.index')->with('success','Calculation completed successfully');
        }
        else{
            return redirect()->route('calculation.index')->with('error', 'Percentage calculation is out of range. Please ensure the values result in a percentage between 0% and 100%.');
        }
    }

    public function edit($id)
    {
        $calculation = Calculation::where('id',$id)->first();
        return view('calculation.edit',compact('calculation'));
    }

    public function update(CalculationRequest $request, $id)
    {
        switch ($request->operation) {
            case 'Add':
                $add = $request->value1 + $request->value2;
                $percentage = ($request->value2 / $add) * 100;
                break;
            case 'Subtract':
                $substract = $request->value1 - $request->value2;
                $percentage = ($request->value2 / $substract) * 100;
                break;
            case 'Multiply':
                $multiply = $request->value1 * $request->value2;
                $percentage = ($request->value2 / $multiply) * 100;
                break;
            case 'Divide':
                $divide = $request->value1 / $request->value2;
                $percentage = ($request->value2 / $divide) * 100;
                break;
        }

        $result = intval($percentage);
        $calPer = number_format($percentage,2);

        if($result >= 0 && $result <= 100)
        {
            $calData = $this->calculation->where('id',$id)->update([
                'value1' => $request->value1,
                'value2' => $request->value2,
                'operation' => $request->operation,
                'calculated_percentage' => $calPer
            ]);

            return redirect()->route('calculation.index')->with('success','Calculation Updated successfully');
        }
        else{
            return redirect()->route('calculation.index')->with('error', 'Percentage calculation is out of range. Please ensure the values result in a percentage between 0% and 100%.');
        }
    }

    public function delete($id)
    {
        $categoryData =  $this->calculation->where('id',$id)->delete();

        return redirect()->route('calculation.index')->with('success','Calculation Record Deleted successfully !!');
    }
}

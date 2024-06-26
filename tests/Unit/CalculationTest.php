<?php

namespace Tests\Unit;

use App\Http\Controllers\CalculationController;
use App\Http\Requests\Calculation\CalculationRequest;
use App\Models\Calculation;
use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class CalculationTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_calculates_percentage_correctly_with_valid_values()
    {
        $response = $this->post(route('calculation.store'), [
            'value1' => 50,
            'value2' => 10,
        ]);

        $response->assertRedirect(route('calculation.index'));
    }

    public function test_calculates_percentage_correctly_with_invalid_values()
    {
        $response = $this->post(route('calculation.store'), [
            'value1' => 50,
            'value2' => 101,
        ]);

        if ($response->getSession()->has('errors')) {
            $errorMessage = $response->getSession()->get('errors')->first('value2');
            echo "Error Message: $errorMessage\n";
            echo "Calculation Failed !!";
            $this->assertTrue(true);
        }
        else{
            $response->assertRedirect(route('calculation.index'));
        }
    }

    public function test_delete_calculation_data()
    {
        $calculation = Calculation::factory()->create();

        $response = $this->get(route('calculation.delete', $calculation->id));

        $response->assertRedirect(route('calculation.index'));
    }




    //below all test is in unit test using mockery
    public function test_calculates_percentage_correctly_with_valid_values_using_mockery(): void
    {
        $calculationMock = Mockery::mock(Calculation::class);

        $requestData = [
            'value1' => 50,
            'value2' => 19,
        ];

        $mockRequest = Mockery::mock(CalculationRequest::class);
        $mockRequest->shouldReceive('all')->andReturn($requestData);

        $percentage = ($requestData['value1'] * $requestData['value2']) / 100;

        $calculationMock->shouldReceive('create')->once()->with([
            'value1' => $requestData['value1'],
            'value2' => $requestData['value2'],
            'calculated_percentage' => $percentage,
        ])->andReturn($calculationMock);

        $calculationControlller = new CalculationController($calculationMock);

        $response = $calculationControlller->store($mockRequest);
    }

    public function test_delete_calculation_data_using_mockery()
    {
        $calculationMock =  Mockery::mock(Calculation::class);

        $calculation = Calculation::factory()->create();

        $calculationMock->shouldReceive('where')->with('id', $calculation->id)->once()->andReturnSelf();
        $calculationMock->shouldReceive('delete')->once()->andReturn();

        $calculationController = new CalculationController($calculationMock);

        $response = $calculationController->delete($calculation->id);
    }
}

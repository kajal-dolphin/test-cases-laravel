<?php

namespace Tests\Unit;

use App\Http\Controllers\CalculationController;
use App\Http\Requests\Calculation\CalculationRequest;
use App\Models\Calculation;
use Mockery;
use Tests\TestCase;

class CalculationTest extends TestCase
{
    /**
     * A basic test example.
     */

    public function test_store_calculation_data()
    {
        $response = $this->post(route('calculation.store'), [
            'value1' => 123.86,
            'value2' => 150,
            'operation' => 'Add'
        ]);

        $this->assertEquals(4, Calculation::count());

        $response->assertRedirect(route('calculation.index'));

        $calculation = Calculation::where('id', 5)->first();

        $this->assertEquals($calculation->value1, '123.86');
    }


    public function test_update_calculation_data(){

        $calculation = Calculation::where('id',5)->first();

        $response = $this->post(route('calculation.update',$calculation->id),[
            'value1' => 123.86,
            'value2' => 1500,
            'operation' => 'Add'
        ]);

        $updated_calculation = Calculation::where('id',5)->first();

        $response->assertRedirect(route('calculation.index'));

        $this->assertEquals('1500',$updated_calculation->value2);
    }

    public function test_delete_calculation_data(){

        $calculation = Calculation::where('id',4)->first();

        $response = $this->get(route('calculation.delete',$calculation->id));

        $response->assertRedirect(route('calculation.index'));
    }




    //below all test is in unit test using mockery
    public function testStoreCalculation(): void
    {
        $mockCal = Mockery::mock(Calculation::class);

        $mockCal->shouldReceive('create')->once()->andReturn();

        $request = new CalculationRequest([
            'value1' => 50,
            'value2' => 150,
            'operation' => 'Add'
        ]);

        $calController = new CalculationController($mockCal);
        $response =  $calController->store($request);

        if ($response->getSession()->has('success')) {
            $successMessage = $response->getSession()->get('success');
            $this->assertStringContainsString('Calculation completed successfully', $successMessage);
            echo "Success: $successMessage\n";
        } elseif ($response->getSession()->has('error')) {
            $errorMessage = $response->getSession()->get('error');
            $this->assertStringContainsString('Percentage calculation is out of range', $errorMessage);
            echo "Error: $errorMessage\n";
        }
    }

    public function testUpdateCalculation()
    {
        $mockCal = Mockery::mock(Calculation::class);

        $calculation = Calculation::factory()->create();

        $request = new CalculationRequest([
            'value1' => 50,
            'value2' => 150,
            'operation' => 'Add'
        ]);

        $mockCal->shouldReceive('where')->with('id', $calculation->id)->once()->andReturnSelf();
        $mockCal->shouldReceive('update')->once()->andReturn();

        $categoryController = new CalculationController($mockCal);
        $response = $categoryController->update($request, $calculation->id);

        if ($response->getSession()->has('success')) {
            $successMessage = $response->getSession()->get('success');
            $this->assertStringContainsString('Calculation Updated successfully', $successMessage);
            echo "Success: $successMessage\n";
        } elseif ($response->getSession()->has('error')) {
            $errorMessage = $response->getSession()->get('error');
            $this->assertStringContainsString('Percentage calculation is out of range', $errorMessage);
            echo "Error: $errorMessage\n";
        }
    }

    public function testDeleteCalculation()
    {
        $calculationMock =  Mockery::mock(Calculation::class);

        $calculation = Calculation::factory()->create();

        $calculationMock->shouldReceive('where')->with('id',$calculation->id)->once()->andReturnSelf();
        $calculationMock->shouldReceive('delete')->once()->andReturn();

        $calculationController = new CalculationController($calculationMock);

        $response = $calculationController->delete($calculation->id);
    }
}

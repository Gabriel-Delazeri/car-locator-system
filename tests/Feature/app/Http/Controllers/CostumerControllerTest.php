<?php

namespace Tests\Feature\app\Http\Controllers;

use Tests\TestCase;
use App\Models\Costumer;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CostumerControllerTest extends TestCase
{
    use DatabaseMigrations;

    const BASE_URL = '/costumers';

    /**
     * @return void
     */
    public function test_index_method_is_returning_costumers_list_and_view_succesfuly()
    {
        $costumer = Costumer::factory()->count(10)->create();

        $response = $this->get(Self::BASE_URL);

        $compactCostumer = $response->viewData('costumers');

        $response->assertStatus(200);
        $response->assertViewIs('costumers.index');
        $this->assertSame($costumer->count(), sizeof($compactCostumer));
    }

    /**
     * @return void
     */
    public function test_create_method_is_create_view_succesfuly()
    {
        $response = $this->get(Self::BASE_URL . '/create');
        $response->assertStatus(200);
        $response->assertViewIs('costumers.create');
    }

    /**
     * @return void
     */
    public function test_store_costumer_succesfuly()
    {
        $costumer = Costumer::factory()->raw();

        $response = $this->post(Self::BASE_URL, $costumer);

        $response->assertStatus(302);
        $this->assertDatabaseHas('costumers', [
            'document_id' => $costumer['document_id']
        ]);
    }

    /**
     * @return void
     */
    public function test_store_validations_waiting_error()
    {
        $costumer = [];

        $response = $this->post(Self::BASE_URL, $costumer);

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_show_method_is_returning_costumer_and_view_succesfuly()
    {
        $costumer = Costumer::factory()->create();

        $response = $this->get(Self::BASE_URL . "/{$costumer->id}");

        $compactCostumer = $response->viewData('costumer');

        $response->assertViewIs('costumers.show');
        $this->assertEquals($compactCostumer->toArray(), $costumer->toArray());
    }

    /**
     * @return void
     */
    public function test_edit_is_returning_costumer_and_view_succesfuly()
    {
        $costumer = Costumer::factory()->create();

        $response = $this->get(Self::BASE_URL . "/{$costumer->id}/edit");

        $compactCostumer = $response->viewData('costumer');

        $response->assertViewIs('costumers.edit');
        $this->assertEquals($compactCostumer->toArray(), $costumer->toArray());
    }

    /**
     * @return void
     */
    public function test_update_costumer_with_same_cpf_waiting_error()
    {
        $costumer = Costumer::factory()->create();

        $response = $this->put(Self::BASE_URL . "/{$costumer->id}", $costumer->toArray());

        $response->assertStatus(302);
    }

    /**
     * @return void
     */
    public function test_updating_costumer_succesfuly()
    {
        $costumer = Costumer::factory()->create();

        $update = [
            "first_name"  => "PHPUNIT",
            "last_name"   => $costumer->last_name,
            "document_id" => $costumer->document_id,
        ];

        $this->put(Self::BASE_URL . "/{$costumer->id}", $update);

        $updatedUser = Costumer::find($costumer->id)->toArray();
        $this->assertEquals('PHPUNIT', $updatedUser['first_name']);
    }

    /**
     * @return void
     */
    public function test_delete_costumer_succesfuly()
    {
        $costumer = Costumer::factory()->create();

        $this->delete(Self::BASE_URL . "/{$costumer->id}");
        $this->assertEmpty(Costumer::find($costumer->id));
    }
}

<?php
namespace Tests\Unit;

use Axilweb\PreOrder\Models\PreOrder;
use Axilweb\PreOrder\Models\Product;
use Axilweb\PreOrder\Services\PreOrderService;
use Illuminate\Foundation\Testing\RefreshDatabase; // Include if you're using database refresh
use Tests\TestCase;

class PreOrderServiceTest extends TestCase
{
//    use RefreshDatabase;

    protected $preOrderService;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an instance of the PreOrderService for testing
        $this->preOrderService = new PreOrderService();
    }

    /** @test */
    public function it_can_create_a_preorder()
    {
        // Mock the validated data
        $validatedData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'product_id' => 1, // Make sure this product exists in your test database
        ];

        // Call the storePreOrder method
        $preOrder = $this->preOrderService->storePreOrder($validatedData);

        // Assert the pre-order was created in the database
        $this->assertDatabaseHas('pre_orders', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'product_id' => 1,
        ]);

        // Assert that the returned preOrder matches the validated data
        $this->assertInstanceOf(PreOrder::class, $preOrder);
        $this->assertEquals('John Doe', $preOrder->name);
        $this->assertEquals('john@example.com', $preOrder->email);
        $this->assertEquals('1234567890', $preOrder->phone);
        $this->assertEquals(1, $preOrder->product_id);
    }

}

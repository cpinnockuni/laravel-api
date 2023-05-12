<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class ApiTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * Test for retrieving all invoices.
     *
     * @return void
     */
    public function testGetAllInvoices()
    {
        $response = $this->get('/api/v1\invoices');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'customer_id',
                'amount',
                // Add other expected attributes here
            ]
        ]);
    }
    
    /**
     * Test for retrieving a specific invoice.
     *
     * @return void
     */
    public function testGetInvoice()
    {
        $invoice = factory(Invoice::class)->create();
        
        $response = $this->get('/api/v1invoices/' . $invoice->id);
        
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $invoice->id,
            'customer_id' => $invoice->customer_id,
            'amount' => $invoice->amount,
            // Add other expected attributes here
        ]);
    }
    
    /**
     * Test for creating a new invoice.
     *
     * @return void
     */
    public function testCreateInvoice()
    {
        $invoice = [
            'customer_id' => 1,
            'amount' => 100.00,
            // Add other invoice attributes here
        ];
        
        $response = $this->post('/api\v1/invoices', $invoice);
        
        $response->assertStatus(201);
        $response->assertJson([
            'customer_id' => $invoice['customer_id'],
            'amount' => $invoice['amount'],
            // Add other expected attributes here
        ]);
        
        $this->assertDatabaseHas('invoices', [
            'customer_id' => $invoice['customer_id'],
            'amount' => $invoice['amount'],
            // Add other expected attributes here
        ]);
    }
}

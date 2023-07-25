<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'id_transaction' => 'T001',
            'customer_name' => 'Andi Novita',
            'product_ordered' => 'Nasi Ayam Goreng',
            'quantity' => 1,
            'price' => 25000,
            'status' => 'lunas'
        ]);
    }
}

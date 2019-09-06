<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $orders = factory(App\Order::class, 10)->create();
        $status_order_item = ['doing', 'done', 'cancel'];
        foreach ($orders as $order) {
            $services = App\Service::find([rand(1, 10), rand(1, 10), rand(1, 10)]);
            foreach ($services as $service) {
                $order->orderItems()->create([
                    'service_id' => $service->id,
                    'quantity' => 1,
                    'amount' => $service->price,
                    'extra' => null,
                    'status' => $status_order_item[array_rand($status_order_item)],
                ]);
            }

            $bill = $order->bills()->create([
                'no' => rand(100, 999),
                'amount' => $order->amount,
                'store_id' => $order->store_id,
                'customer_id' => $order->customer_id,
                'staff_id' => $order->staff_id,
            ]);

            foreach ($order->orderItems as $orderItem) {
                $order->amount = $order->amount + $orderItem->amount;
                $service = App\Service::find($orderItem->service_id);
                $orderItem->billItem()->create([
                    'bill_id' => $bill->id,
                    'amount' => $orderItem->amount,
                    'extra' => $orderItem->extra,
                    'quantity' => $orderItem->quantity,
                    'name' => $service->name,
                    'description' => $service->description,
                ]);
            }
            $order->save();
            $bill->amount = $order->amount;
            $bill->save();
        }
    }
}

<?php

use App\Extra;
use App\Menu;
use App\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $extras = [
            [
                "name" => "Kích cỡ",
                "multiple" => false,
                "index" => 1,
                "options" => [
                    ["name" => "S", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "M", "index" => 2, "default" => false, "price" => 0],
                    ["name" => "L", "index" => 3, "default" => false, "price" => 0],
                ],
            ],
            [
                "name" => "Đá",
                "multiple" => false,
                "index" => 2,
                "options" => [
                    ["name" => "25%", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "50%", "index" => 2, "default" => false, "price" => 0],
                    ["name" => "70%", "index" => 3, "default" => false, "price" => 0],
                    ["name" => "100%", "index" => 4, "default" => false, "price" => 0],
                ],
            ],
            [
                "name" => "Đường",
                "multiple" => false,
                "index" => 3,
                "options" => [
                    ["name" => "25%", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "50%", "index" => 2, "default" => false, "price" => 0],
                    ["name" => "70%", "index" => 3, "default" => false, "price" => 0],
                    ["name" => "100%", "index" => 4, "default" => false, "price" => 0],
                ],
            ],
            [
                "name" => "Toppin",
                "multiple" => true,
                "index" => 4,
                "options" => [
                    [
                        "name" => "Trân châu",
                        "default" => false,
                        "price" => 10,
                        "index" => 1,
                    ],
                    [
                        "name" => "Thạch",
                        "default" => false,
                        "price" => 10,
                        "index" => 2,
                    ],
                    [
                        "name" => "Kiwi",
                        "default" => false,
                        "price" => 10,
                        "index" => 3,
                    ],
                    [
                        "name" => "Yogurt",
                        "default" => false,
                        "price" => 10,
                        "index" => 4,
                    ],
                ],
            ],
        ];

        $menus = [
            [
                "name" => 'Đồ uống',
                "index" => 1,
                "parent_id" => null,
                "services" => [
                    [
                        "name" => "Coffee",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly",
                        "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Coffee sửa",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly",
                        "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Trà đào",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly",
                        "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Trà chanh",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly", "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Trà sửa",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly", "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Trà đen",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly", "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Đá xay socola",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly", "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Đá xay trà xanh",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly", "extras" => json_encode($extras),
                    ],
                    [
                        "name" => "Đá xay coffee",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Ly", "extras" => json_encode($extras),
                    ],
                ],
            ],
            [
                "name" => 'Đồ ăn',
                "index" => 2,
                "parent_id" => null,
                "services" => [
                    [
                        "name" => "Bánh canh",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Tô",
                    ],
                    [
                        "name" => "Mỳ tôm",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Tô",
                    ],
                    [
                        "name" => "Mỳ quảng",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Tô",
                    ],
                    [
                        "name" => "Buốn chả cá",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Tô",
                    ],
                    [
                        "name" => "Bánh mỳ",
                        "description" => $faker->text(),
                        "price" => rand(20, 50),
                        "minutes" => rand(5, 15),
                        "unit" => "Cái",
                    ],
                ],
            ],
        ];

        foreach ($menus as $m) {
            $menu = Menu::create(["name" => $m['name'], "index" => $m['index'], "parent_id" => $m['parent_id']]);
            foreach ($m['services'] as $s) {
                $service = Service::create($s);
                $service->menus()->attach($menu, ['price' => rand(20, 50)]);
            }
        }

        foreach ($extras as $ex) {
            $extra = Extra::create(["name" => $ex['name'], "index" => $ex['index'], "multiple" => $ex['multiple']]);
            $extra->options()->createMany($ex['options']);
        }
    }
}

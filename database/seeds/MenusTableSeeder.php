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
        $array_price = [20000, 25000, 30000, 35000, 40000, 45000, 50000];
        $array_minute = [5, 10, 15];

        $extras = [
            [
                "name" => "Kích cỡ",
                "slug" => "kich-co",
                "multiple" => false,
                "index" => 1,
                "options" => [
                    ["name" => "S", "slug" => "s", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "M", "slug" => "m", "index" => 2, "default" => false, "price" => 5000],
                    ["name" => "L", "slug" => "l", "index" => 3, "default" => false, "price" => 10000],
                ],
            ],
            [
                "name" => "Đá",
                "slug" => "da",
                "multiple" => false,
                "index" => 2,
                "options" => [
                    ["name" => "25", "slug" => "25", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "50", "slug" => "50", "index" => 2, "default" => false, "price" => 0],
                    ["name" => "70", "slug" => "70", "index" => 3, "default" => false, "price" => 0],
                    ["name" => "100", "slug" => "100", "index" => 4, "default" => false, "price" => 0],
                ],
            ],
            [
                "name" => "Đường",
                "slug" => "duong",
                "multiple" => false,
                "index" => 3,
                "options" => [
                    ["name" => "25", "slug" => "25", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "50", "slug" => "50", "index" => 2, "default" => false, "price" => 0],
                    ["name" => "70", "slug" => "70", "index" => 3, "default" => false, "price" => 0],
                    ["name" => "100", "slug" => "100", "index" => 4, "default" => false, "price" => 0],
                ],
            ],
            [
                "name" => "Toppin",
                "slug" => "toppin",
                "multiple" => true,
                "index" => 4,
                "options" => [
                    [
                        "name" => "Trân châu",
                        "slug" => "tran-chau",
                        "default" => false,
                        "price" => 10000,
                        "index" => 1,
                    ],
                    [
                        "name" => "Thạch",
                        "slug" => "thach",
                        "default" => false,
                        "price" => 10000,
                        "index" => 2,
                    ],
                    [
                        "name" => "Kiwi",
                        "slug" => "kiwi",
                        "default" => false,
                        "price" => 10000,
                        "index" => 3,
                    ],
                    [
                        "name" => "Yogurt",
                        "slug" => "yogurt",
                        "default" => false,
                        "price" => 10000,
                        "index" => 4,
                    ],
                ],
            ],
        ];

        $extras_default = [
            [
                "name" => "Kích cỡ",
                "slug" => "kich-co",
                "multiple" => false,
                "index" => 1,
                "options" => [
                    ["name" => "S", "slug" => "s", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "M", "slug" => "m", "index" => 2, "default" => false, "price" => 5000],
                    ["name" => "L", "slug" => "l", "index" => 3, "default" => false, "price" => 10000],
                ],
            ],
            [
                "name" => "Đá",
                "slug" => "da",
                "multiple" => false,
                "index" => 2,
                "options" => [
                    ["name" => "25", "slug" => "25", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "50", "slug" => "50", "index" => 2, "default" => false, "price" => 0],
                    ["name" => "70", "slug" => "70", "index" => 3, "default" => false, "price" => 0],
                    ["name" => "100", "slug" => "100", "index" => 4, "default" => false, "price" => 0],
                ],
            ],
            [
                "name" => "Đường",
                "slug" => "duong",
                "multiple" => false,
                "index" => 3,
                "options" => [
                    ["name" => "25", "slug" => "25", "index" => 1, "default" => true, "price" => 0],
                    ["name" => "50", "slug" => "50", "index" => 2, "default" => false, "price" => 0],
                    ["name" => "70", "slug" => "70", "index" => 3, "default" => false, "price" => 0],
                    ["name" => "100", "slug" => "100", "index" => 4, "default" => false, "price" => 0],
                ],
            ],

        ];

        $extras_toppin = [
            "name" => "Toppin",
            "slug" => "toppin",
            "multiple" => true,
            "index" => 4,
            "options" => [
                [
                    "name" => "Trân châu",
                    "slug" => "tran-chau",
                    "default" => false,
                    "price" => 10,
                    "index" => 1,
                ],
                [
                    "name" => "Thạch",
                    "slug" => "thach",
                    "default" => false,
                    "price" => 10,
                    "index" => 2,
                ],
                [
                    "name" => "Kiwi",
                    "slug" => "kiwi",
                    "default" => false,
                    "price" => 10,
                    "index" => 3,
                ],
                [
                    "name" => "Yogurt",
                    "slug" => "yogurt",
                    "default" => false,
                    "price" => 10,
                    "index" => 4,
                ],
            ],
        ];

        $menus = [
            [
                "name" => 'Đồ uống',
                "index" => 1,
                "parent_id" => null,
                "children" => [
                    [
                        "name" => 'Cà phê',
                        "index" => 1,
                        "services" => [
                            [
                                "name" => "Cà phê đen",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fcafe_den.jpg?alt=media&token=2f869cb5-1c47-43a0-ab4a-6e27462b5d22",
                                "extras" => $extras_default,
                            ],
                            [
                                "name" => "Cà phê sữa",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fcafe_sua.jpg?alt=media&token=24100608-e543-4391-955b-f6db5ae64825",
                                "extras" => $extras_default,
                            ],
                        ],
                    ],
                    [
                        "name" => 'Trà',
                        "index" => 1,
                        "services" => [
                            [
                                "name" => "Trà đào",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Ftra_dao.jpg?alt=media&token=96ebbba9-add8-448b-aa86-b884c7f42495",
                                "extras" => $extras,
                            ],
                            [
                                "name" => "Trà chanh",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Ftra_chanh.jpg?alt=media&token=0d9e390a-a22e-4e08-8599-8c3cbb122917",
                                "extras" => $extras,
                            ],
                            [
                                "name" => "Trà sữa",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Ftra_sua.jpg?alt=media&token=9496754b-8414-4fc0-bbfe-e9e3d0acf3a6",
                                "extras" => $extras,
                            ],
                            [
                                "name" => "Trà đen",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Ftra_den.jpg?alt=media&token=cabe1d74-cc9b-4fa6-a9db-718e668a13f3",
                                "extras" => $extras,
                            ],
                        ],
                    ],
                    [
                        "name" => 'Đá xay',
                        "index" => 1,
                        "services" => [
                            [
                                "name" => "Đá xay socola",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fsocola_daxay.jpg?alt=media&token=28fd3a03-ad14-4f79-a62c-457f8bba4e31",
                                "extras" => $extras,
                            ],
                            [
                                "name" => "Đá xay trà xanh",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Ly",
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Ftraxanh_daxay.jpg?alt=media&token=10ab69f2-7d96-4362-9ff0-01ee6257fea8",
                                "extras" => $extras,
                            ],
                            [
                                "name" => "Đá xay coffee",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fcafe_daxay.png?alt=media&token=e9ddb288-d9d5-4e52-8657-24066aeb5927",
                                "unit" => "Ly",
                                "extras" => $extras,
                            ],
                        ],
                    ],
                ],
            ],
            [
                "name" => 'Đồ ăn',
                "index" => 2,
                "parent_id" => null,
                "children" => [
                    [
                        "name" => 'Bún',
                        "index" => 2,
                        "services" => [
                            [
                                "name" => "Bún chả cá",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fbun_cha_ca.jpg?alt=media&token=e7513e3c-a503-4405-81ec-a2f57e6b800b",
                                "unit" => "Tô",
                            ],
                            [
                                "name" => "Bún mắm",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fbun_mam.jpg?alt=media&token=28cbea4b-d161-4f5e-b648-f980522a5ca4",
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Tô",
                            ],
                        ],
                    ],
                    [
                        "name" => 'Mỳ',
                        "index" => 2,
                        "services" => [
                            [
                                "name" => "Mỳ tôm",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fmy_tom.jpg?alt=media&token=1c02e317-c6db-417a-a0dd-7795d4b6b750",
                                "unit" => "Tô",
                            ],
                            [
                                "name" => "Mỳ quảng",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fmi_quang.jpg?alt=media&token=843102d4-fdc7-41db-a21d-cc6b6e526407",
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "unit" => "Tô",
                            ],
                        ],
                    ],
                    [
                        "name" => 'Bánh',
                        "index" => 2,
                        "services" => [
                            [
                                "name" => "Bánh canh",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fbanh_canh.jpg?alt=media&token=b69c375e-c0f5-4d53-8b0a-d42675bd9a12",
                                "unit" => "Tô",
                            ],
                            [
                                "name" => "Bánh mỳ",
                                "description" => $faker->text(),
                                "price" => $array_price[array_rand($array_price)],
                                "minutes" => $array_minute[array_rand($array_minute)],
                                "image" => "https://firebasestorage.googleapis.com/v0/b/smartstoredemo-9025a.appspot.com/o/services%2Fbanh_my.jpg?alt=media&token=c4438541-0ab8-42ad-b51d-c0cceb507dfc",
                                "unit" => "Cái",
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($menus as $menuItem) {
            $menu = Menu::create(["name" => $menuItem['name'], "index" => $menuItem['index'], "parent_id" => $menuItem['parent_id']]);
            foreach ($menuItem['children'] as $item) {
                $child = $menu->children()->create(["name" => $item['name'], "index" => $item['index']]);
                foreach ($item['services'] as $serviceItem) {
                    $service = Service::create($serviceItem);
                    $service->menus()->attach($child, ['price' => $array_price[array_rand($array_price)]]);
                }
            }
        }

        foreach ($extras as $extraItem) {
            $extra = Extra::create(["name" => $extraItem['name'], "slug" => $extraItem['slug'], "index" => $extraItem['index'], "multiple" => $extraItem['multiple']]);
            $extra->options()->createMany($extraItem['options']);
        }
    }
}

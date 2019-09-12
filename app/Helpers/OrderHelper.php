<?php

namespace App\Helpers;

use App\Service;

class OrderHelper
{
    /**
     *
     * Tổng tiền của 1 service kèm extra
     */

    public function amount($serviceItem)
    {
        $amount = 0;
        $amount = $amount + $serviceItem['price'] * $serviceItem['quantity'];
        if (isset($serviceItem['extras'])) {
            foreach ($serviceItem['extras'] as $extra) {
                $amount = $amount + $this->totalPrice($extra['options'], count($extra['options']));
            }
        }
        return $amount;
    }

    /**
     *
     * Đệ quy tính tổng tiền của options của extra
     */
    public function totalPrice($options, $count)
    {
        if ($count == 0) {
            return 0;
        }
        if ($count == 1) {
            return $options[$count - 1]['price'];
        }
        return $options[$count - 1]['price'] + $this->totalPrice($options, $count - 1);
    }

    /**
     *
     * Kiểm tra dữ liệu service extra
     */

    public function validateExtra($services)
    {
        $dataService = [];
        foreach ($services as $serviceItem) {
            $item = [
                'extras' => [],
            ];
            $service = Service::select('id', 'price', 'extras')->find($serviceItem['service_id']);
            if ($service) {
                $serviceExtra = collect($service->extras);
                if (isset($serviceItem['extras'])) {
                    foreach ($serviceItem['extras'] as $extraItem) {
                        $extra = $serviceExtra->firstWhere('slug', $extraItem['slug']);
                        if ($extra) {
                            $options = collect($extra['options']);
                            $dataOption = [];
                            foreach ($extraItem['options'] as $optionItem) {
                                $option = $options->where('slug', $optionItem)->first();
                                if ($option) {
                                    array_push($dataOption, ["name" => $option['name'], "price" => $option['price']]);
                                } else {
                                    return null;
                                }
                            }
                            $extra['options'] = $dataOption;
                            array_push($item['extras'], ["name" => $extra['name'], "options" => $extra['options']]);
                        } else {
                            return null;
                        }
                    }
                }
                $item['quantity'] = $serviceItem['quantity'];
                $item['service_id'] = $serviceItem['service_id'];
                $item['price'] = $service->price;
                if (isset($serviceItem['id'])) {
                    $item['id'] = $serviceItem['id'];
                }
            } else {
                return null;
            }
            array_push($dataService, $item);
        }
        return $dataService;
    }
}

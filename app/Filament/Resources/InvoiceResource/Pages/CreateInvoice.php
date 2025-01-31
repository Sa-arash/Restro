<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;


    public function beforeCreate()
    {
        foreach ($this->data['products'] as $key => $value) {
            
            $this->data['products'][$key]['total'] = $value['count'] * str_replace(',', '', $value['price']);
        }
        // dd($this->data['products']);
        $this->data['total_discount'] = collect($this->data['products'])->sum('discount');
        $this->data['total_amount'] = collect($this->data['products'])->sum(fn($item) => str_replace(',', '', $item['price']));
        // dd($this->data ,collect($this->data['products'])->map(fn($item)=>$item['total']=$item['count']*str_replace(',','',$item['price'])));
    }
}

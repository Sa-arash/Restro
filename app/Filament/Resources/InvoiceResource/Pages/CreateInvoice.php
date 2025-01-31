<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;
use Throwable;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;


    // public function beforeCreate()
    // {
    //     foreach ($this->data['products'] as $key => $value) {

    //         $this->data['products'][$key]['total'] = $value['count'] * str_replace(',', '', $value['price']);
    //     }
    //     // dd($this->data['products']);
    //     $this->data['total_discount'] = collect($this->data['products'])->sum('discount');
    //     $this->data['total_amount'] = collect($this->data['products'])->sum(fn($item) => str_replace(',', '', $item['price']));
    //     // dd($this->data ,collect($this->data['products'])->map(fn($item)=>$item['total']=$item['count']*str_replace(',','',$item['price'])));
    // }
    public function create(bool $another = false): void
    {
        $this->authorizeAccess();

        try {
            $this->beginDatabaseTransaction();

            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeCreate($data);




            foreach ($this->data['products'] as $key => $value) {

                $this->data['products'][$key]['total'] = $value['count'] * str_replace(',', '', $value['price']);
            }
            // dd($this->data['products']);
            $this->data['total_discount'] = collect($this->data['products'])->sum('discount');
            $this->data['total_amount'] = collect($this->data['products'])->sum(fn($item) => str_replace(',', '', $item['price']));
            // dd($this->data ,collect($this->data['products'])->map(fn($item)=>$item['total']=$item['count']*str_replace(',','',$item['price'])));
$data = $this->data;

            $this->callHook('beforeCreate');

            $this->record = $this->handleRecordCreation($data);
            // dd($this->record);
            $this->form->model($this->getRecord())->saveRelationships();

            $this->callHook('afterCreate');

            $this->commitDatabaseTransaction();
        } catch (Halt $exception) {
            $exception->shouldRollbackDatabaseTransaction() ?
                $this->rollBackDatabaseTransaction() :
                $this->commitDatabaseTransaction();

            return;
        } catch (Throwable $exception) {
            $this->rollBackDatabaseTransaction();

            throw $exception;
        }

        $this->rememberData();

        $this->getCreatedNotification()?->send();

        if ($another) {
            // Ensure that the form record is anonymized so that relationships aren't loaded.
            $this->form->model($this->getRecord()::class);
            $this->record = null;

            $this->fillForm();

            return;
        }

        $redirectUrl = $this->getRedirectUrl();

    }
}

<?php

namespace App\Http\Controllers\Api\Transaction;

use Illuminate\Http\Request;
use App\Actions\Transaction\Hosttohost\BookingAction;
use App\Actions\Transaction\Hosttohost\CancelAction;
use App\Actions\Transaction\Hosttohost\FareAction;
use App\Actions\Transaction\Hosttohost\SearchAction;
use App\Actions\Transaction\Hosttohost\TicketingAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\Hosttohost\BookingResource;
use App\Http\Resources\Transaction\Hosttohost\CancelResource;
use App\Http\Resources\Transaction\Hosttohost\FareResource;
use App\Http\Resources\Transaction\Hosttohost\SearchResource;
use App\Http\Resources\Transaction\Hosttohost\TicketingResource;

class HosttohostController extends Controller
{
    public function search(SearchAction $action, Request $request)
    {
        return SearchResource::collection($action->search($request->all()));
    }

    public function fare(FareAction $action, Request $request)
    {
        return new FareResource($action->fare($request->all()));
    }

    public function booking(BookingAction $action, Request $request)
    {
        return new BookingResource($action->booking($request->all()));
    }

    public function ticketing(TicketingAction $action, Request $request)
    {
        return new TicketingResource($action->ticketing($request->all()));
    }

    public function cancel(CancelAction $action, Request $request)
    {
        return new CancelResource($action->cancel($request->all()));
    }
}
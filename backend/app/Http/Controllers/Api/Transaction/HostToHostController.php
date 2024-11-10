<?php

namespace App\Http\Controllers\Api\Transaction;

use Illuminate\Http\Request;
use App\Actions\Transaction\HostToHost\BookingAction;
use App\Actions\Transaction\HostToHost\CancelAction;
use App\Actions\Transaction\HostToHost\FareAction;
use App\Actions\Transaction\HostToHost\SearchAction;
use App\Actions\Transaction\HostToHost\TicketingAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\HostToHost\BookingResource;
use App\Http\Resources\Transaction\HostToHost\CancelResource;
use App\Http\Resources\Transaction\HostToHost\FareResource;
use App\Http\Resources\Transaction\HostToHost\SearchResource;
use App\Http\Resources\Transaction\HostToHost\TicketingResource;

class HostToHostController extends Controller
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
<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointsTransferRequest;
use App\Http\Requests\UpdatePointsTransferRequest;
use App\Http\Resources\PointsTransferResource;
use App\Models\PointsTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class PointsTransferController extends Controller
{

    public function __construct(Request $request){
        // parent::__construct($request);
        // $this->authorizeResource(PointsTransfer::class,Str::snake("PointsTransfer"));
    }
    public function index(Request $request)
    {
        return PointsTransferResource::collection(PointsTransfer::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StorePointsTransferRequest $request)
    {
        $pointsTransfer = PointsTransfer::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $pointsTransfer->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new PointsTransferResource($pointsTransfer);
    }
    public function show(Request $request,PointsTransfer $pointsTransfer)
    {
        return new PointsTransferResource($pointsTransfer);
    }
    public function update(UpdatePointsTransferRequest $request, PointsTransfer $pointsTransfer)
    {
        // $pointsTransfer->update($request->validated());
        //   if ($request->translations) {
        //     foreach ($request->translations as $translation)
        //         $pointsTransfer->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        // }
        return new PointsTransferResource($pointsTransfer);
    }
    public function destroy(Request $request,PointsTransfer $pointsTransfer)
    {
        $pointsTransfer->delete();
        return new PointsTransferResource($pointsTransfer);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneNumberRequest;
use App\Http\Resources\PhoneNumberResponseDTO;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PhoneNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $phoneNumbers = PhoneNumber::query()->paginate(
            perPage: $request->input('perPage', 10),
            page: $request->input('page', 1),
        );

        $phoneNumbers->getCollection()->transform(function ($phoneNumber) {
            return new PhoneNumberResponseDTO($phoneNumber);
        });

        return response()->json($phoneNumbers, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhoneNumberRequest $request)
    {
        $phoneNumber = $request->validated();

        PhoneNumber::query()->create([
            'value' => $phoneNumber['value'],
            'monthly_price' => $phoneNumber['monthlyPrice'],
            'setup_price' => $phoneNumber['setupPrice'],
            'currency' => $phoneNumber['currency'],
        ]);

        return response()->json([
            'message' => 'Número de telefone criado com sucesso',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(PhoneNumber $phoneNumber)
    {
        return response()->json(new PhoneNumberResponseDTO($phoneNumber), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhoneNumber $phoneNumber)
    {
        $phoneNumberInput = $request->validate([
            'value' => 'sometimes|phone_number|unique:phone_numbers,value',
            'monthlyPrice' => 'sometimes|numeric',
            'setupPrice' => 'sometimes|numeric',
            'currency' => 'sometimes|string',
        ]);

        $phoneNumber->update([
            'value' => $phoneNumberInput['value'] ?? $phoneNumber->value,
            'monthly_price' => $phoneNumberInput['monthlyPrice'] ?? $phoneNumber->monthly_price,
            'setup_price' => $phoneNumberInput['setupPrice'] ?? $phoneNumber->setup_price,
            'currency' => $phoneNumberInput['currency'] ?? $phoneNumber->currency,
        ]);

        return response()->json([
            'message' => 'Número de telefone atualizado com sucesso',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhoneNumber $phoneNumber)
    {
        $phoneNumber->delete();

        return response()->json([
            'message' => 'Número de telefone deletado com sucesso',
        ], Response::HTTP_OK);
    }
}

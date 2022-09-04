<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'paid_amoint' => $this->paid_amount,
            'user_email' => $this->user_email,
            'currency' => $this->currency,
            'status' => $this->status,
            'payment_date' => $this->payment_date->format('Y-m-d'),
            'user' => new UserResource($this->user)
        ];
    }
}

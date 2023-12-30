<?php

namespace App\Http\Resources;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use function PHPUnit\Framework\assertFileEquals;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "mobile" => $this->mobile,
            "company" => $this->when(
                !is_null($this->company),
                $this->company,
                trans("ticket.model_company_is_null", ["model" => trans("ticket.model")]
                )
            ),
            "subject" => $this->subject,
            "message" => $this->when(
                Str::contains($request->route()->getName(), "show"),
                $this->message
            ),
            "status" => $this->when(
                $this->status,
                trans("ticket.model_seen", ["model" => trans("ticket.model")]),
                trans("ticket.model_unseen", ["model" => trans("ticket.model")]),
            ),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $today = Carbon::now();
        $startDate = Carbon::parse($this->start);
        $endDate = Carbon::parse($this->end);

        // Format tanggal menjadi "01 Jan 2025"
        $formattedStartDate = $startDate->format('d M Y');
        $formattedEndDate = $endDate->format('d M Y');

        // Hitung sisa hari
        $remainingDays = $endDate->isPast() ? 0 : $today->diffInDays($endDate, false);

        // Tentukan status event
        $status = $endDate->isPast() ? 'Ended' : ($startDate->isFuture() ? 'Upcoming' : 'Ongoing');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => $formattedStartDate, 
            'end' => $formattedEndDate, 
            'color' => $this->color,
            'status' => $status,
            'remaining_days' => $remainingDays,
            'created_at' => $this->created_at, 
            'updated_at' => $this->updated_at->format('d M Y H:i:s') 
        ];
    }
}

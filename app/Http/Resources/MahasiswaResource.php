<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'nama'     => $this->nama,
            'nim'      => $this->nim,
            'prodi'    => $this->prodi,
            'angkatan' => $this->angkatan,
            'ipk'      => $this->ipk,
            'email'    => $this->email,
            'github'   => $this->github,
            'bio'      => $this->bio,
            'user'     => [
                'id'   => $this->user?->id,
                'name' => $this->user?->name,
            ],
        ];
    }
}

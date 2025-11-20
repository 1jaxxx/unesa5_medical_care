<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id_users', 'nama', 'email', 'role', 'specialization', 'is_active')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Role',
            'Spesialisasi',
            'Status',
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id_users,
            $user->nama,
            $user->email,
            $user->role,
            $user->specialization,
            $user->is_active ? 'Aktif' : 'Tidak Aktif',
        ];
    }
}

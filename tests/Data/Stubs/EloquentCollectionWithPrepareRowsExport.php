<?php

namespace Maatwebsite\Excel\Tests\Data\Stubs;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Tests\Data\Stubs\Database\User;

class EloquentCollectionWithPrepareRowsExport implements FromCollection
{
    use Exportable;

    /**
     * @return Collection
     */
    public function collection()
    {
        return new Collection([
            new User([
                'firstname' => 'Patrick',
                'lastname'  => 'Brouwers',
            ]),
        ]);
    }

    /**
     * @param  iterable  $rows
     * @return iterable
     */
    public function prepareRows($rows)
    {
        return $rows->transform(function ($user) {
            $user->name .= '_prepared_name';

            return $user;
        })->toArray();
    }
}

<?php

namespace App\Imports;

use App\Jobs\BookImporter;
use App\Models\Base\Book;
use App\Models\Base\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Concerns\ToModel;

class BookImport implements ToModel
{
    public function model(array $row)
    {
        Queue::push(new BookImporter(Auth::user()->ID,$row[0],$row[1],$row[2]));
    }
}
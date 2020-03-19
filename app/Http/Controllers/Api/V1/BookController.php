<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Imports\BookImport;
use App\Jobs\BookImporter;
use App\Models\Base\Book;
use App\Models\Base\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Facades\Excel;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookController extends Controller
{
    public function __construct()
    {
         //$this->middleware('auth');
    }

    public function AllBook()
    {
        return Auth::user();
        return response()->AloResponse(Book::all(), 'success', Lang::get('messages.AllBooks'));
    }

    public function AddBook(Request $request)
    {
        if ($request->hasFile('Books')) {
            $Books = Excel::toArray(new BookImport, $request->file('Books'));
            foreach ($Books[0] as $book) {
                //dispatch(new BookImporter(Auth::user()->ID,$book[0],$book[1],$book[2]));
                Queue::push(new BookImporter(Auth::user()->ID,$book[0],$book[1],$book[2]));

            }
            return response()->AloResponse($Books, 'success', Lang::get('messages.BooksAdded'));
        }
        $this->validate($request, [
            'BookName' => 'required',
            'BookPrice' => 'required',
            'BookRentPrice' => 'required',
        ]);
        $Book = Book::create([
            'BookName' => $request->BookName,
            'BookPrice' => $request->BookPrice,
            'BookRentPrice' => $request->BookRentPrice,
            'user_id' => Auth::user()->ID,
        ]);
        if (!empty($request->tag)) {
            $tags = explode(',', $request->tag[0]);
            for ($x = 0; $x < count($tags); $x++) {
                $Book->tag()->attach($tags[$x]);
            }
        }


        return response()->AloResponse($Book, 'success', Lang::get('messages.BooksAdded'));
    }

    public function Update(Request $request, $id)
    {
        $Book = Book::find($id);
        if (empty($Book) || $Book == null) {
            return response()->AloResponse(null, 'fail', Lang::get('messages.IncorrectID'));
        }
        $Book->BookName = !empty($request->BookName) ? $request->BookName : $Book->BookName;
        $Book->BookPrice = !empty($request->BookPrice) ? $request->BookPrice : $Book->BookPrice;
        $Book->BookRentPrice = !empty($request->BookRentPrice) ? $request->BookRentPrice : $Book->BookRentPrice;
        $Book->update();
        if (!empty($request->tag)) {
            $tags = explode(',', $request->tag[0]);
            for ($x = 0; $x < count($tags); $x++) {
                $Book->tag()->attach($tags[$x]);
            }
        }
        return response()->AloResponse($Book, 'success', Lang::get('messages.BookUpdated'));
    }

    public function Show($id)
    {
        return response()->AloResponse(Book::where('id', $id)->first(), 'success', Lang::get('messages.BookFind'));
    }

    public function Delete($id)
    {
        $Book = Book::find($id);
        if (!empty($Book)) {
            $Book->delete();
            return response()->AloResponse(null, 'success', Lang::get('messages.BookDeleted'));
        }
        return response()->AloResponse(null, 'fail', Lang::get('messages.IncorrectID'));
    }

    public function FindByTag($tag)
    {

        try {
            $Books = Tag::where('name', $tag)->firstOrfail()->Books;
        } catch (ModelNotFoundException $exception) {
            return response()->AloResponse(null, 'fail', Lang::get('messages.IncorrectID'));

        }
        return response()->AloResponse($Books, 'success', Lang::get('messages.SearchComplete'));

    }

}
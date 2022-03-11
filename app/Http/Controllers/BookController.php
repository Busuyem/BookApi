<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Throw_;
use Throwable;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __invoke()
    {
        $response = Http::acceptJson()->get('https://www.anapioficeandfire.com/api/books');

        $res = json_decode($response->getBody()->getContents(), true);

        try{
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => $res
            ]);

        }catch(Throwable $e){
            return response()->json([
                "status_code" => 404,
                "Status" => "Not found",
                "data"=> []
            ]);
        }
    }

    public function index()
    {
        try{
            $books = Book::all();

            return response()->json([
                "status_code" =>200,
                "status" => "success",
                "data" => ApiResource::collection($books)
            ]);

        }catch(Throwable $e){
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => []
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $book)
    {
        $book = $book->validated();

        $book['release_date'] = date('Y-m-d', strtotime($book['release_date']));

        $createdBook = Book::create($book);

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "data" => new ApiResource($createdBook)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "data" => new ApiResource($book)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $bookRequest, Book $book)
    {
        $validateBookData = $bookRequest->validated();

        $validateBookData['release_date'] = date('Y-m-d', strtotime($validateBookData['release_date']));

        $updatedBook = $book->update($validateBookData);

        if($updatedBook){
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => new ApiResource($book)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $deleteBook = $book->delete();

        if($deleteBook){
            return response()->json([
                "status_code" => 200,
                "success" => "success",
                "data" => []
            ]);
        }
    }

}

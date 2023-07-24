<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class bookController extends Controller
{
    
    public function index()
    {
        return Book::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required'
        ]); 
        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $book = Book::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully',
            'book' => $book
        ]);
    }

    
    public function show($id)
    {
        return Book::find($id);
    }


    public function edit($id)
    {
       
    }

    
    public function update(Request $request, $id)
    {
         if(Book::where('id', $id)->exists()){
            $book = Book::find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->save();
            return response()->json([
                'message' => 'Book record updated'
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Book record not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        if(Book:: where('id', $id)->exists()){
            $book = Book::find($id);
            $book->delete();
            return response()->json([
                'message' => 'Book deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Record not found'
            ], 404);
        }
    }
}

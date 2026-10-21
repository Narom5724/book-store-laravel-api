<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookAuthors = DB::table('tblBookAuthor')
            ->join('tblBook', 'tblBookAuthor.BookID', '=', 'tblBook.BookID')
            ->join('tblAuthor', 'tblBookAuthor.AuthorID', '=', 'tblAuthor.AuthorID')
            ->select('tblBookAuthor.*', 'tblBook.BookTitle', 'tblAuthor.AuthorName')
            ->get();

        return response()->json($bookAuthors, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'BookID' => 'required|exists:tblBook,BookID',
            'AuthorID' => 'required|exists:tblAuthor,AuthorID',
        ]);

        DB::table('tblBookAuthor')->insert([
            'BookID' => $request->BookID,
            'AuthorID' => $request->AuthorID,
            'AuthorDate' => $request->AuthorDate ?? now(),
            'Remark' => $request->Remark,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Book author relation created successfully',
            'data' => $request->all()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $bookId)
    {
        $bookAuthors = DB::table('tblBookAuthor')
            ->join('tblBook', 'tblBookAuthor.BookID', '=', 'tblBook.BookID')
            ->join('tblAuthor', 'tblBookAuthor.AuthorID', '=', 'tblAuthor.AuthorID')
            ->where('tblBookAuthor.BookID', $bookId)
            ->select('tblBookAuthor.*', 'tblBook.BookTitle', 'tblAuthor.AuthorName')
            ->get();

        if ($bookAuthors->isEmpty()) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($bookAuthors, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $bookId)
    {
        $authorId = $request->input('OldAuthorID');

        $updated = DB::table('tblBookAuthor')
            ->where('BookID', $bookId)
            ->where('AuthorID', $authorId)
            ->update([
                'AuthorDate' => $request->AuthorDate,
                'Remark' => $request->Remark,
                'updated_at' => now(),
            ]);

        if (!$updated) {
            return response()->json(['message' => 'Record not found or no changes made'], 404);
        }

        return response()->json([
            'message' => 'Book author relation updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $bookId)
    {
        $deleted = DB::table('tblBookAuthor')
            ->where('BookID', $bookId)
            ->delete();

        if (!$deleted) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json([
            'message' => 'Book author relation deleted successfully'
        ], 200);
    }
}

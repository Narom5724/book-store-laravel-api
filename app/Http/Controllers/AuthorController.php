<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Author::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = Author::create($request->all());
        return response()->json([
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $author = Author::find($id);
        if (!$author) return response()->json(['message' => 'Not Found'], 404);
        return response()->json($author, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);
        if (!$author) return response()->json(['message' => 'Not Found'], 404);

        $author->update($request->all());
        return response()->json([
            'message' => 'Author updated successfully',
            'data' => $author
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);
        if (!$author) return response()->json(['message' => 'Not Found'], 404);

        $author->delete();
        return response()->json(['message' => 'Author deleted successfully'], 200);
    }
}

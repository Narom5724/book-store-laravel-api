<?php

namespace App\Http\Controllers;

use App\Models\BookType;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(BookType::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bookType = BookType::create($request->all());
        return response()->json([
            'message' => 'Book Type created successfully',
            'data' => $bookType
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookType = BookType::find($id);
        if (!$bookType) return response()->json(['message' => 'Not Found'], 404);
        return response()->json($bookType, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookType = BookType::find($id);
        if (!$bookType) return response()->json(['message' => 'Not Found'], 404);

        $bookType->update($request->all());
        return response()->json([
            'message' => 'Book Type updated successfully',
            'data' => $bookType
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookType = BookType::find($id);
        if (!$bookType) return response()->json(['message' => 'Not Found'], 404);

        $bookType->delete();
        return response()->json(['message' => 'Book Type deleted successfully'], 200);
    }
}

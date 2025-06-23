<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WasteCategory;
use Illuminate\Http\Request;

class IdeaGeneratorController extends Controller
{
    public function generateIdea(Request $request)
    {
        $message = strtolower($request->input('message'));
        
        // Cari kategori sampah yang cocok berdasarkan kata kunci
        $matchedCategory = WasteCategory::all()->first(function($category) use ($message) {
            foreach ($category->detection_keywords as $keyword) {
                if (str_contains($message, strtolower($keyword))) {
                    return true;
                }
            }
            return false;
        });

        if (!$matchedCategory) {
            return response()->json([
                'ai_message' => 'Maaf, saya belum bisa mengidentifikasi jenis sampah yang Anda sebutkan. Mohon berikan detail lebih spesifik tentang sampahnya.',
                'ideas' => []
            ]);
        }

        $ideas = $matchedCategory->productIdeas;

        return response()->json([
            'ai_message' => "Saya punya beberapa ide kreatif untuk mendaur ulang {$matchedCategory->name}!",
            'ideas' => $ideas
        ]);
    }
}

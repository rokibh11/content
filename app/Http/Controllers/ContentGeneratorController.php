<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\GeneratedContent;

class ContentGeneratorController extends Controller
{
    public function index()
    {
        return view('content.index');
    }

    public function generate(Request $request)
{
    $keyword = $request->input('keyword');
    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ])
    ->timeout(90)
    ->post('http://localhost:4000/generate', [
        'keyword' => $keyword
    ]);

    if ($response->successful()) {
        $aiContent = $response->json();

        // ✅ ডাটাবেজে Save করুন
        GeneratedContent::create([
            'keyword' => $keyword,
            'title' => $aiContent['title'] ?? null,
            'meta_title' => $aiContent['meta_title'] ?? null,
            'meta_description' => $aiContent['meta_description'] ?? null,
            'h1' => $aiContent['h1'] ?? null,
            'inbound_link' => $aiContent['inbound_link'] ?? null,
            'outbound_link' => $aiContent['outbound_link'] ?? null,
            'content' => $aiContent['content'] ?? null,
            'content_length' => $aiContent['content_length'] ?? strlen(strip_tags($aiContent['content'] ?? ''))
        ]);
    } else {
        $aiContent = [
            'title' => 'Error',
            'content' => 'Failed to get content from Deepseek API',
        ];
    }

    return view('content.index', compact('aiContent', 'keyword'));
}

public function history()
{
    $all = \App\Models\GeneratedContent::latest()->paginate(20);
    return view('content.history', compact('all'));
}

}

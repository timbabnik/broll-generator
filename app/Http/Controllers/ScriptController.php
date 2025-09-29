<?php

namespace App\Http\Controllers;

use App\Models\Script;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScriptController extends Controller
{
    /**
     * Display a listing of user's scripts
     */
    public function index()
    {
        $scripts = Script::where('user_id', Auth::id() ?? null)
            ->with(['sentences.assets'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('scripts.index', compact('scripts'));
    }

    /**
     * Show the form for creating a new script
     */
    public function create()
    {
        return view('scripts.create');
    }

    /**
     * Display the specified script
     */
    public function show(Script $script)
    {
        // For testing, allow access to all scripts
        // In production, you'd want to add proper authorization
        $script->load(['sentences.assets']);
        
        return view('scripts.show', compact('script'));
    }

    /**
     * Remove the specified script from storage
     */
    public function destroy(Script $script)
    {
        // For testing, allow deletion of all scripts
        // In production, you'd want to add proper authorization
        $script->delete();

        return redirect()->route('scripts.index')
            ->with('success', 'Script deleted successfully.');
    }

    /**
     * Get script status for AJAX requests
     */
    public function status(Script $script)
    {
        // For testing, allow access to all scripts
        // In production, you'd want to add proper authorization
        $script->load(['sentences.assets']);

        return response()->json([
            'id' => $script->id,
            'status' => $script->status,
            'sentences_count' => $script->sentences->count(),
            'completed_sentences' => $script->sentences->where('status', 'completed')->count(),
            'assets_count' => $script->sentences->flatMap->assets->count(),
            'completed_assets' => $script->sentences->flatMap->assets->where('status', 'completed')->count(),
            'created_at' => $script->created_at,
            'updated_at' => $script->updated_at,
        ]);
    }
}

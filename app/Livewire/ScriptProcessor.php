<?php

namespace App\Livewire;

use App\Jobs\ProcessScriptJob;
use App\Models\Script;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ScriptProcessor extends Component
{
    public $script = '';
    public $isProcessing = false;
    public $currentScript = null;
    public $sentences = [];
    public $assets = [];

    protected $rules = [
        'script' => 'required|string|min:10|max:10000',
    ];

    public function mount()
    {
        // Load user's recent scripts
        $this->loadRecentScripts();
    }

    public function submitScript()
    {
        $this->validate();

        try {
            // Create script record (without user_id for now)
            $script = Script::create([
                'user_id' => null, // No user required for testing
                'content' => $this->script,
                'status' => 'pending'
            ]);

            $this->currentScript = $script;
            $this->isProcessing = true;

            // Dispatch processing job
            ProcessScriptJob::dispatch($script);

            // Clear the form
            $this->script = '';

            session()->flash('message', 'Script submitted successfully! Processing will begin shortly.');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to submit script: ' . $e->getMessage());
        }
    }

    public function loadScript($scriptId)
    {
        $this->currentScript = Script::with(['sentences.assets'])->find($scriptId);
        $this->sentences = $this->currentScript->sentences;
        $this->assets = $this->currentScript->sentences->flatMap->assets;
    }

    public function refreshStatus()
    {
        if ($this->currentScript) {
            $this->currentScript->refresh();
            $this->sentences = $this->currentScript->sentences;
            $this->assets = $this->currentScript->sentences->flatMap->assets;
            
            if ($this->currentScript->isCompleted() || $this->currentScript->isFailed()) {
                $this->isProcessing = false;
            }
        }
    }

    private function loadRecentScripts()
    {
        // This could be used to show recent scripts in a sidebar
        // Implementation depends on UI requirements
    }

    public function render()
    {
        return view('livewire.script-processor');
    }
}

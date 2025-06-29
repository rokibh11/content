@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-primary">AI Content Generator</h1>
    <form id="aiForm" action="{{ route('generate') }}" method="POST" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="keyword" class="form-label fw-bold">কীওয়ার্ড দিন</label>
            <input type="text" name="keyword" id="keyword" class="form-control form-control-lg" placeholder="e.g. Digital Marketing" value="{{ old('keyword', $keyword ?? '') }}">
        </div>
        <button type="submit" class="btn btn-primary px-4">Generate Content</button>
    </form>

    <!-- Loading Spinner -->
    <div id="loadingBar" class="text-center my-4 d-none">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="mt-2 text-primary">Generating content, please wait...</div>
    </div>

    @if(isset($aiContent['title']) || isset($aiContent['content']))
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Generated Content</h4>
                    <div>
                        <button class="btn btn-light btn-sm me-2" onclick="copyContent()">Copy</button>
                        <button class="btn btn-light btn-sm me-2" onclick="downloadContent()">Download</button>
                        <button class="btn btn-light btn-sm" onclick="exportContent()">Export</button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-4">
                            <tbody>
                                <tr>
                                    <th class="highlight">Meta Title</th>
                                    <td><span class="fw-bold">{{ $aiContent['meta_title'] ?? '-' }}</span></td>
                                </tr>
                                <tr>
                                    <th class="highlight">Meta Description</th>
                                    <td><span class="fw-bold">{{ $aiContent['meta_description'] ?? '-' }}</span></td>
                                </tr>
                                <tr>
                                    <th class="highlight">H1</th>
                                    <td><span class="fw-bold text-primary">{{ $aiContent['h1'] ?? '-' }}</span></td>
                                </tr>
                                <tr>
                                    <th class="highlight">Content Length</th>
                                    <td><span class="fw-bold">{{ $aiContent['content_length'] ?? strlen(strip_tags($aiContent['content'] ?? '')) }} words</span></td>
                                </tr>
                                <tr>
                                    <th class="highlight">Inbound Link</th>
                                    <td>
                                        @if(!empty($aiContent['inbound_link']))
                                            <a href="{{ $aiContent['inbound_link'] }}" class="link-primary fw-bold" target="_blank">{{ $aiContent['inbound_link'] }}</a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="highlight">Outbound Link</th>
                                    <td>
                                        @if(!empty($aiContent['outbound_link']))
                                            <a href="{{ $aiContent['outbound_link'] }}" class="link-danger fw-bold" target="_blank">{{ $aiContent['outbound_link'] }}</a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="highlight">Main Content</th>
                                    <td>
                                        <div id="mainContent" class="p-3 border rounded mt-2 main-content-box" style="max-height:350px; overflow:auto;">
                                            {!! isset($aiContent['content']) 
                                                ? (\Illuminate\Support\Str::contains($aiContent['content'], '<') 
                                                    ? $aiContent['content'] 
                                                    : nl2br(e($aiContent['content']))) 
                                                : '<span class="text-muted">No content available.</span>' !!}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Success Message -->
                    <div id="copyMsg" class="alert alert-success d-none mt-2">Copied to clipboard!</div>
                    <div id="downloadMsg" class="alert alert-info d-none mt-2">Downloaded as text file!</div>
                    <div id="exportMsg" class="alert alert-warning d-none mt-2">Exported as JSON!</div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function copyContent() {
        let temp = document.createElement("textarea");
        temp.value = document.getElementById('mainContent').innerText;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);
        showMsg('copyMsg');
    }
    function downloadContent() {
        let text = document.getElementById('mainContent').innerText;
        let blob = new Blob([text], {type: "text/plain"});
        let link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = "ai-content.txt";
        link.click();
        showMsg('downloadMsg');
    }
    function exportContent() {
        let data = @json($aiContent);
        let blob = new Blob([JSON.stringify(data, null, 2)], {type: "application/json"});
        let link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = "ai-content.json";
        link.click();
        showMsg('exportMsg');
    }
    function showMsg(id) {
        ['copyMsg','downloadMsg','exportMsg'].forEach(function(x){
            document.getElementById(x).classList.add('d-none');
        });
        document.getElementById(id).classList.remove('d-none');
        setTimeout(function(){ document.getElementById(id).classList.add('d-none'); }, 1500);
    }
    document.getElementById('aiForm').addEventListener('submit', function() {
        document.getElementById('loadingBar').classList.remove('d-none');
    });
    </script>
    @endif
</div>
@endsection

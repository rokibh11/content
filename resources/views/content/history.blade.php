@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary">All Generated Contents</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Keyword</th>
                    <th>Title</th>
                    <th>Meta Title</th>
                    <th>H1</th>
                    <th>Content Length</th>
                    <th>Created</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @forelse($all as $content)
                <tr>
                    <td>{{ $content->id }}</td>
                    <td>{{ Str::limit($content->keyword, 30) }}</td>
                    <td>{{ Str::limit($content->title, 30) }}</td>
                    <td>{{ Str::limit($content->meta_title, 30) }}</td>
                    <td>{{ Str::limit($content->h1, 30) }}</td>
                    <td>{{ $content->content_length }}</td>
                    <td>{{ $content->created_at->diffForHumans() }}</td>
                    <td>
                        <!-- future: single view page -->
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#contentModal{{ $content->id }}">View</button>
                    </td>
                </tr>

                <!-- Modal for details -->
                <div class="modal fade" id="contentModal{{ $content->id }}" tabindex="-1" aria-labelledby="contentModalLabel{{ $content->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="contentModalLabel{{ $content->id }}">Full Content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-break">
                        <b>Title:</b> {{ $content->title }} <br>
                        <b>Meta Title:</b> {{ $content->meta_title }} <br>
                        <b>Meta Description:</b> {{ $content->meta_description }} <br>
                        <b>H1:</b> {{ $content->h1 }} <br>
                        <b>Inbound Link:</b> <a href="{{ $content->inbound_link }}" target="_blank">{{ $content->inbound_link }}</a><br>
                        <b>Outbound Link:</b> <a href="{{ $content->outbound_link }}" target="_blank">{{ $content->outbound_link }}</a><br>
                        <b>Content:</b> <div class="border rounded p-3 mt-2" style="background: #f8f9fa;">{!! $content->content !!}</div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No content found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $all->links() }}
        </div>
    </div>
</div>
@endsection

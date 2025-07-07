@extends('layouts.app')

@section('content')
<section class="work section" id="work-details">
    <div class="container">
        <div class="work__card" style="max-width: 700px; margin: 0 auto;">
            <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('assets/img/work1.png') }}" alt="" class="work__img" style="width:100%;height:auto;">
            <h2 class="work__title" style="margin-top: 1rem;">{{ $project->title }}</h2>
            <div style="margin-bottom: 1rem;">
                @foreach($project->tags as $tag)
                    <span class="work__item" style="margin-right: 5px;">{{ $tag->name }}</span>
                @endforeach
            </div>
            <p><strong>Description:</strong> {{ $project->description }}</p>
            @if($project->explanation)
                <p><strong>Explanation:</strong> {{ $project->explanation }}</p>
            @endif
            <p>
                <strong>Start:</strong> {{ $project->start_date }}<br>
                <strong>End:</strong> {{ $project->end_date }}<br>
                <strong>Duration:</strong> {{ \Carbon\Carbon::parse($project->start_date)->diffInDays(\Carbon\Carbon::parse($project->end_date)) }} days
            </p>
            @if($project->role)
                <p><strong>Role:</strong> {{ $project->role }}</p>
            @endif
            @if($project->what_learned)
                <p><strong>What I Learned:</strong> {{ $project->what_learned }}</p>
            @endif
            @if($project->files && $project->files->count())
                <div style="margin-top: 1rem;">
                    <strong>Files:</strong>
                    <ul>
                        @foreach($project->files as $file)
                            <li><a href="{{ asset('storage/' . $file->file_path) }}" download>{{ $file->file_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

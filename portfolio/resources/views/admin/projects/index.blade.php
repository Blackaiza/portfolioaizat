@extends('layouts.app')

@section('content')
<section class="work section" id="admin-work">
    <span class="section__subtitle">Admin Panel</span>
    <h2 class="section__title">Manage Projects</h2>
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('admin.projects.create') }}" class="button">Add Project</a>
    </div>
    <div class="work__container container grid">
        @foreach($projects as $project)
            <div class="work__card">
                <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('assets/img/work1.png') }}" alt="" class="work__img">
                <h3 class="work__title">{{ $project->title }}</h3>
                <div style="margin-bottom: 1rem;">
                    @foreach($project->tags as $tag)
                        <span class="work__item" style="margin-right: 5px;">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <a href="{{ route('admin.projects.edit', $project) }}" class="button button--ghost">Edit</a>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button" style="background:#e74c3c;color:#fff;margin-left:10px;">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</section>
@endsection

@extends('layouts.app')

@section('content')
<!--=============== WORK ===============-->
<section class="work section" id="work">
    <span class="section__subtitle">My Portfolio</span>
    <h2 class="section__title">Recent Works</h2>

    <div class="work__filters">
        <span class="work__item active-work" data-filter='all'>All</span>
        @foreach($tags as $tag)
            <span class="work__item" data-filter='.{{ strtolower($tag->name) }}'>{{ $tag->name }}</span>
        @endforeach
    </div>

    <div class="work__container container grid">
        @foreach($projects as $project)
            <div class="work__card mix {{ implode(' ', $project->tags->pluck('name')->map(fn($n) => strtolower($n))->toArray()) }}">
                <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('assets/img/work1.png') }}" alt="" class="work__img">
                <h3 class="work__title">{{ $project->title }}</h3>
                <a href="{{ route('projects.show', $project) }}" class="work__button">
                    Details <i class="bx bx-right-arrow-alt work__icon"></i>
                </a>
            </div>
        @endforeach
    </div>
</section>
@endsection

@extends('layouts.app')

@section('content')
<section class="work section" id="admin-create-project">
    <div class="container" style="max-width: 700px; margin: 0 auto;">
        <div class="work__card">
            <h2 class="work__title" style="margin-bottom: 1rem;">Add Project</h2>
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="contact__form-input" required>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="contact__form-input" required></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="explanation">Explanation</label>
                    <textarea name="explanation" id="explanation" class="contact__form-input"></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="contact__form-input" required>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="contact__form-input" required>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="role">Role</label>
                    <input type="text" name="role" id="role" class="contact__form-input">
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="what_learned">What I Learned</label>
                    <textarea name="what_learned" id="what_learned" class="contact__form-input"></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label>Tags:</label><br>
                    @foreach($tags as $tag)
                        <label style="margin-right: 10px;"><input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}</label>
                    @endforeach
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="files">Files:</label>
                    <input type="file" name="files[]" id="files" multiple class="contact__form-input">
                </div>
                <button type="submit" class="button">Save</button>
            </form>
        </div>
    </div>
</section>
@endsection

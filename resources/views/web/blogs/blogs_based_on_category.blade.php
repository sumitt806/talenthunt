@extends('web.layouts.app')
@section('title')
    {{ __('web.post_of').$blogCategories[$categoryId] }}
@endsection
@section('content')
    <!-- ===== Start of Candidate Profile Header Section ===== -->
    <section class="page-header blog-page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.post_of').$blogCategories[$categoryId] }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-listing ptb80" id="version1">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12 blog-posts-wrapper">
                    @forelse($blogs as $blog)
                        <article class="col-md-12 blog-post">
                            <div class="col-md-4 blog-thumbnail">
                                <a href="{{ route('front.posts.details',$blog->id) }}" class="hover-link"><img
                                            src="{{ $blog->blog_image_url }}"
                                            class="img-responsive" alt=""></a>
                                <div class="date">
                                    <span class="day">{{ $blog->created_at->format('d') }}</span>
                                    <span class="publish-month">{{ $blog->created_at->format('M') }}</span>
                                </div>
                            </div>

                            <div class="col-md-8 blog-desc">
                                <h5><a href="{{ route('front.posts.details',$blog->id) }}">{{ $blog->title }}</a>
                                </h5>
                                <div class="post-detail pt10 pb20">
                                    <span><i class="fa fa-user"></i>{{ $blog->user->full_name }}</span>
                                </div>
                                <p>{!! !empty($blog->description) ? nl2br(Str::limit($blog->description, 100, ' ...')):__('messages.common.n/a') !!}</p>
                                <a href="{{ route('front.posts.details',$blog->id) }}"
                                   class="btn btn-purple btn-effect mt10 position-absolute bottom-0">{{ __('web.post_menu.read_more') }}</a>
                            </div>
                        </article>
                    @empty
                        <h3><span class="no-blog-available">
                               {{ __('messages.post.no_posts_available') }}
                            </span></h3>
                    @endforelse
                </div>
                @include('web.blogs.blog-sidebar')
            </div>
        </div>
    </section>
@endsection

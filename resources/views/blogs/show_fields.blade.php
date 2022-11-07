<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('title', __('messages.post.title').':', ['class' => 'font-weight-bold']) }}
            <p>{{$post->title}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('blog_category', __('messages.post_category.post_category').':', ['class' => 'font-weight-bold']) }}
            <br>
            @if($selectedBlogCategories->isNotEmpty())
                <span>{{ \App\Models\PostCategory::whereIn('id',$selectedBlogCategories)->pluck('name')->implode(', ') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('attachment', __('messages.post.image').':', ['class' => 'font-weight-bold']) }}
            <br>
            @if(!empty($post->blog_image_url))
                <a href="{{$post->blog_image_url}}" target="_blank">{{ __('messages.common.view') }}</a>
            @else
                {{ __('messages.common.n/a') }}
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('notes', __('messages.post.description').':', ['class' => 'font-weight-bold']) }}
            <p> {!! !empty($post->description)? nl2br($post->description):__('messages.common.n/a') !!}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('created_at', __('messages.common.created_on').':', ['class' => 'font-weight-bold']) }}
            <br>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ date('jS M, Y', strtotime($post->created_at)) }}">{{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('updated_at', __('messages.common.last_updated').':',['class'=>'font-weight-bold']) }}<br>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ date('jS M, Y', strtotime($post->updated_at)) }}">{{ $post->updated_at->diffForHumans() }}</span>
        </div>
    </div>
</div>

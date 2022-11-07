<section class="pt40 pb80" id="job-post">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12 mb20">
            <h2 class="capitalize"><i class="fa fa-clipboard"></i> {{ __('web.home_menu.notices') }}</h2>
        </div>
        @foreach($notices as $notice)
            <div class="col-md-12 col-sm-12 col-xs-12 topic">
                <div class="noticeBoard">
                    <h6 class="question">
                        {{ $notice->title }} | {{ $notice->created_at->diffForHumans() }}
                    </h6>
                    <i class="fa fa-angle-down  open"></i>
                </div>
                <p class="answer">
                    <span class="text-muted">
                    {{ date('jS M, Y', strtotime($notice->created_at)) }},
                    </span><br>
                    {!! nl2br(strip_tags($notice->description)) !!}
                </p>
            </div>
        @endforeach
    </div>
</section>

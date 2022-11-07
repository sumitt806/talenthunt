<section class="ptb80" id="testimonials">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title">
            <h2 class="text-white">{{ __('web.home_menu.testimonials') }}</h2>
        </div>
        <!-- Start of Owl Slider -->
        <div class="owl-carousel testimonial">
            <!-- Start of Slide item -->
            @foreach($testimonials as $testimonial)
                <div class="item">
                    <div class="review">
                        <blockquote>{!! !empty(nl2br($testimonial->description))?nl2br($testimonial->description):'N/A' !!}  </blockquote>
                    </div>
                    <div class="customer">
                        @if(!empty($testimonial->customer_image_url))
                            <img src="{{ $testimonial->customer_image_url }}" class="web-testimonial-customer-img"
                                 alt="">
                        @else
                            <img src="{{ asset('assets/img/infyom-logo.png') }}"
                                 class="web-testimonial-customer-img thumbnail-preview" alt="">
                        @endif
                        <h4 class="uppercase pt20">{{ $testimonial->customer_name }}</h4>
                    </div>
                </div>
        @endforeach
        <!-- End Slide item -->
        </div>
        <!-- End of Owl Slider -->
    </div>
</section>

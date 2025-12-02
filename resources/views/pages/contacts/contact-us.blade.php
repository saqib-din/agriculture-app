 @extends('layouts.landing')

 @section('hero')
     <!-- Page-title -->
     <div class="page-title page-contact-us  ">
         <div class="rellax" data-rellax-speed="5">
             <img src="{{ asset('assets/images/page-title/contact-us.jpg') }}" alt="">
         </div>
         <div class="content-wrap">
             <div class="tf-container w-1290">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="content">
                             <p class="sub-title">
                                 Contact Us Today To Work Together
                             </p>
                             <h1 class="title">
                                 Contact Us
                             </h1>
                             <div class="icon-img">
                                 <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt="">
                             </div>
                             <div class="breadcrumb">
                                 <a href="{{ url('/') }}">Home</a>
                                 <div class="icon">
                                     <i class="icon-arrow-right1"></i>
                                 </div>
                                 <a href="javascript:void(0)">Contact Us </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="img-item item-2">
             <img src="{{ asset('assets/images/item/grass.png') }}" alt="">
         </div>
     </div><!-- /.Page-title -->
 @endsection

 @section('content')
     <div class="main-content pt-0 pb-0 page-contact-us">

         <!-- Section contact us -->
         <section class="s-contact-us style-2 bg-white">
             <div class="section-wrap">
                 <div class="tf-container w-1290">
                     <div class="row">
                         <div class="col-lg-5">
                             <div class="content-left">
                                 <div class="image mb-30">
                                     <img src="{{ asset('assets/images/section/s-contact.jpg') }}"
                                         alt="{{ asset('assets/images/section/s-contact.jpg') }}" class=" img lazyload" />
                                     <img src="{{ asset('assets/images/item/leaf.png') }}" alt=""
                                         class="img-item tf-animate__rotate-left" />
                                 </div>
                                 <ul class="contact-list">
                                     <li class="wow fadeInUp" data-wow-duration="1.4s">
                                         <div class="icon style-circle">
                                             <i class="fa-solid fa-location-dot"></i>
                                         </div>
                                         <div class="infor">
                                             <p class="title">
                                                 Farm Address
                                             </p>
                                             @if ($variables->isNotEmpty())
                                                 <p class="text">
                                                     {{ $variables->first()->map }}
                                                 </p>
                                             @else
                                                 <p class="text">
                                                     Prinsengracht 250, 2501016 PM <br>
                                                     Amsterdam Netherlands
                                                 </p>
                                             @endif
                                         </div>
                                     </li>
                                     <li class="wow fadeInUp" data-wow-duration="1.4s">
                                         <div class="icon style-circle">
                                             <i class="fa-solid fa-address-book"></i>
                                         </div>
                                         <div class="infor">
                                             <p class="title">
                                                 Contact Us
                                             </p>
                                             @if ($variables->isNotEmpty())
                                                 <p class="text">
                                                     {{ $variables->first()->email }} <br>
                                                     Call Us 24/7: {{ $variables->first()->phone }}
                                                 </p>
                                             @else
                                                 <p class="text">
                                                     Donalfarms@gmail.com <br>
                                                     Call Us 24/7: +1 987 654 3210
                                                 </p>
                                             @endif
                                         </div>
                                     </li>
                                     <li class="wow fadeInUp" data-wow-duration="1.4s">
                                         <div class="icon style-circle">
                                             <i class="fa-solid fa-clock"></i>
                                         </div>
                                         <div class="infor">

                                             <p class="title">
                                                 Working Hours
                                             </p>
                                             @if ($variables->isNotEmpty())
                                                 <p class="text">
                                                     Mon - Fri: {{ $variables->first()->working_hours }}
                                                     {{-- <br> Sat: {{ $variables->first()->working_hours}} Holidays: Closes --}}
                                                 </p>
                                             @else
                                                 <p class="text">
                                                     Mon - Fri: 8.00am - 18.00pm <br>
                                                     Sat: 9.00am - 17.00pm Holidays: Closes
                                                 </p>
                                             @endif
                                         </div>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                         <div class="col-lg-7">
                             <div class="content-section">
                                 <div class="heading-section has-text mb-50">
                                     <p class="sub-title">Let's Cooperate Together</p>
                                     <p class="title wow fadeInUp" data-wow-delay="0s">Contact Us Today!</p>

                                     @if (session('success'))
                                         <p class="text" id="msg">
                                             We will reply you within 24 hours via email, thank you for contacting
                                         </p>
                                     @endif

                                     <script>
                                         setTimeout(function() {
                                             $("#msg").fadeOut();
                                         }, 5000);
                                     </script>

                                     <div class="img-item">
                                         <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}"
                                             alt="" />
                                     </div>
                                 </div>

                                 <form id="contactform" method="post" action="{{ url('/contact-submit') }}"
                                     class="form-send-message style-2">
                                     @csrf

                                     <div class="cols style-2 mb-15">
                                         <fieldset>
                                             <input type="text" class="form-control" name="name" placeholder="Name*"
                                                 required />
                                         </fieldset>
                                         <fieldset>
                                             <input type="text" class="form-control" name="subject"
                                                 placeholder="Subject*" required />
                                         </fieldset>
                                     </div>

                                     <div class="cols style-2 mb-15">
                                         <fieldset>
                                             <input type="email" class="form-control" name="email" placeholder="Email*"
                                                 required />
                                         </fieldset>
                                         <fieldset>
                                             <input type="text" class="form-control" name="phone" placeholder="Phone*"
                                                 required />
                                         </fieldset>
                                     </div>

                                     <div class="cols mb-30">
                                         <fieldset>
                                             <textarea name="message" placeholder="Message..." required></textarea>
                                         </fieldset>
                                     </div>

                                     <div class="checkbox-item send-wrap mb-3">
                                         <label class="mb-0">
                                             <span class="text font-nunito">Agree to our terms and conditions</span>
                                             <input type="checkbox" name="terms" class="checkbox-item" required>
                                             <span class="btn-checkbox"></span>
                                         </label>
                                         <button type="submit" class="tf-btn ">
                                             <span class="text-style">
                                                 Send Message
                                             </span>
                                             <span class="icon">
                                                 <i class="icon-arrow_right"></i>
                                             </span>
                                         </button>
                                     </div>

                                     <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                                     @error('recaptcha_token')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror


                                 </form>

                                 <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

                                 <script>
                                     document.getElementById('contactform').addEventListener('submit', function(e) {
                                         e.preventDefault();

                                         grecaptcha.ready(function() {
                                             grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                                                 action: 'contact_form'
                                             }).then(function(token) {
                                                 document.getElementById('recaptcha_token').value = token;
                                                 document.getElementById('contactform').submit();
                                             });
                                         });
                                     });
                                 </script>

                                 <style>
                                     .grecaptcha-badge {
                                         visibility: visible !important;
                                     }
                                 </style>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section><!-- /.Section contact us -->

         <!-- Section map -->
         <div class="box-map">
             <iframe src="https://www.google.com/maps?q=33.5261858,73.1330973&hl=en&z=18&output=embed" width="1530"
                 height="450" style="border:0;" allowfullscreen="" loading="lazy"
                 referrerpolicy="no-referrer-when-downgrade">
             </iframe>
         </div><!-- Section map -->

     </div><!-- /.Main-content -->
 @endsection

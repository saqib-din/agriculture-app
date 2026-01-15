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
                                                     N/A
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
                                                     N/A
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
                                                     N/A
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

                                     <!-- Success Message (Initially Hidden) -->
                                     <div id="msg" class="success-message-box" style="display: none;">
                                         <div class="success-content">
                                             <div class="success-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                     <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                     <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                 </svg>
                                             </div>
                                             <div>
                                                 <strong>Message Sent Successfully!</strong>
                                                 <p>We will reply you within 24 hours via email, thank you for contacting
                                                 </p>
                                             </div>
                                         </div>
                                     </div>

                                     <!-- Error Message (Initially Hidden) -->
                                     <div id="error-msg" class="error-message-box" style="display: none;">
                                         <div class="error-content">
                                             <div class="error-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                     <circle cx="12" cy="12" r="10"></circle>
                                                     <line x1="12" y1="8" x2="12" y2="12">
                                                     </line>
                                                     <line x1="12" y1="16" x2="12.01" y2="16">
                                                     </line>
                                                 </svg>
                                             </div>
                                             <div>
                                                 <strong>Error!</strong>
                                                 <p>Something went wrong. Please try again.</p>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="img-item">
                                         <img class="tf-animate-1"
                                             src="{{ asset('assets/images/item/rice-plant-2.png') }}" alt="" />
                                     </div>
                                 </div>

                                 <form id="contactform" method="post" action="{{ url('/contact-submit') }}"
                                     class="form-send-message style-2">
                                     @csrf

                                     <div class="cols style-2 mb-15">
                                         <fieldset>
                                             <input type="text" class="form-control" name="name"
                                                 placeholder="Name*" required />
                                         </fieldset>
                                         <fieldset>
                                             <input type="text" class="form-control" name="subject"
                                                 placeholder="Subject*" required />
                                         </fieldset>
                                     </div>

                                     <div class="cols style-2 mb-15">
                                         <fieldset>
                                             <input type="email" class="form-control" name="email"
                                                 placeholder="Email*" required />
                                         </fieldset>
                                         <fieldset>
                                             <input type="text" class="form-control" name="phone"
                                                 placeholder="Phone*" required />
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
                                         <button type="submit" class="tf-btn" id="submit-btn">
                                             <span class="text-style">Send Message</span>
                                             <span class="icon">
                                                 <i class="icon-arrow_right"></i>
                                             </span>
                                         </button>
                                     </div>

                                     <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                                     <span class="text-danger" id="recaptcha-error" style="display: none;"></span>
                                 </form>

                                 <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
                                 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                 <script>
                                     document.getElementById('contactform').addEventListener('submit', function(e) {
                                         e.preventDefault(); // Page reload stop

                                         const submitBtn = document.getElementById('submit-btn');
                                         submitBtn.disabled = true; // Button disable during submit
                                         submitBtn.innerHTML =
                                             '<span class="text-style">Sending...</span><span class="icon"><i class="icon-arrow_right"></i></span>';

                                         grecaptcha.ready(function() {
                                             grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                                                 action: 'contact_form'
                                             }).then(function(token) {
                                                 document.getElementById('recaptcha_token').value = token;

                                                 // AJAX Request
                                                 const formData = new FormData(document.getElementById('contactform'));

                                                 fetch('{{ url('/contact-submit') }}', {
                                                         method: 'POST',
                                                         body: formData,
                                                         headers: {
                                                             'X-Requested-With': 'XMLHttpRequest'
                                                         }
                                                     })
                                                     .then(response => response.json())
                                                     .then(data => {
                                                         if (data.success) {
                                                             // Success message show 
                                                             document.getElementById('msg').style.display = 'block';
                                                             document.getElementById('error-msg').style.display = 'none';

                                                             // Form reset 
                                                             document.getElementById('contactform').reset();

                                                             // Smooth scroll to message
                                                             document.getElementById('msg').scrollIntoView({
                                                                 behavior: 'smooth',
                                                                 block: 'center'
                                                             });

                                                             setTimeout(function() {
                                                                 $("#msg").fadeOut(600);
                                                             }, 5000);
                                                         } else {
                                                             // Error message
                                                             const errorBox = document.getElementById('error-msg');
                                                             errorBox.querySelector('p').textContent = data.message ||
                                                                 'Something went wrong';
                                                             errorBox.style.display = 'block';
                                                             document.getElementById('msg').style.display = 'none';

                                                             // Smooth scroll to error
                                                             errorBox.scrollIntoView({
                                                                 behavior: 'smooth',
                                                                 block: 'center'
                                                             });
                                                         }

                                                         // Button enable return
                                                         submitBtn.disabled = false;
                                                         submitBtn.innerHTML =
                                                             '<span class="text-style">Send Message</span><span class="icon"><i class="icon-arrow_right"></i></span>';
                                                     })
                                                     .catch(error => {
                                                         console.error('Error:', error);

                                                         const errorBox = document.getElementById('error-msg');

                                                         // Check if validation errors exist
                                                         if (error.response && error.response.status === 422) {
                                                             const errors = error.response.data.errors;
                                                             let errorMessage = 'Please fix the following errors:\n';
                                                             for (let field in errors) {
                                                                 errorMessage += '- ' + errors[field][0] + '\n';
                                                             }
                                                             errorBox.querySelector('p').textContent = errorMessage;
                                                         } else {
                                                             errorBox.querySelector('p').textContent =
                                                                 'Network error. Please try again.';
                                                         }

                                                         errorBox.style.display = 'block';

                                                         // Smooth scroll to error
                                                         errorBox.scrollIntoView({
                                                             behavior: 'smooth',
                                                             block: 'center'
                                                         });

                                                         // Button enable return
                                                         submitBtn.disabled = false;
                                                         submitBtn.innerHTML =
                                                             '<span class="text-style">Send Message</span><span class="icon"><i class="icon-arrow_right"></i></span>';
                                                     });
                                             });
                                         });
                                     });
                                 </script>

                                 <style>
                                     .grecaptcha-badge {
                                         visibility: visible !important;
                                     }

                                     .success-message-box {
                                         background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                         border-left: 5px solid #28a745;
                                         padding: 20px 25px;
                                         border-radius: 12px;
                                         margin-bottom: 25px;
                                         box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
                                         animation: slideDown 0.5s ease-out;
                                     }

                                     .success-content {
                                         display: flex;
                                         align-items: center;
                                         gap: 15px;
                                         color: #ffffff;
                                     }

                                     .success-content i {
                                         font-size: 32px;
                                         color: #28a745;
                                         background: rgba(255, 255, 255, 0.2);
                                         padding: 10px;
                                         border-radius: 50%;
                                         min-width: 50px;
                                         text-align: center;
                                     }

                                     .success-content strong {
                                         font-size: 18px;
                                         font-weight: 600;
                                         display: block;
                                         margin-bottom: 5px;
                                     }

                                     .success-content p {
                                         margin: 0;
                                         font-size: 14px;
                                         opacity: 0.9;
                                         line-height: 1.5;
                                     }

                                     .error-message-box {
                                         background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                                         border-left: 5px solid #dc3545;
                                         padding: 20px 25px;
                                         border-radius: 12px;
                                         margin-bottom: 25px;
                                         box-shadow: 0 8px 20px rgba(245, 87, 108, 0.3);
                                         animation: slideDown 0.5s ease-out;
                                     }

                                     .error-content {
                                         display: flex;
                                         align-items: center;
                                         gap: 15px;
                                         color: #ffffff;
                                     }

                                     .error-content i {
                                         font-size: 32px;
                                         color: #dc3545;
                                         background: rgba(255, 255, 255, 0.2);
                                         padding: 10px;
                                         border-radius: 50%;
                                         min-width: 50px;
                                         text-align: center;
                                     }

                                     .error-content strong {
                                         font-size: 18px;
                                         font-weight: 600;
                                         display: block;
                                         margin-bottom: 5px;
                                     }

                                     .error-content p {
                                         margin: 0;
                                         font-size: 14px;
                                         opacity: 0.9;
                                         line-height: 1.5;
                                     }

                                     @keyframes slideDown {
                                         from {
                                             opacity: 0;
                                             transform: translateY(-20px);
                                         }

                                         to {
                                             opacity: 1;
                                             transform: translateY(0);
                                         }
                                     }

                                     @media (max-width: 768px) {

                                         .success-message-box,
                                         .error-message-box {
                                             padding: 15px 20px;
                                         }

                                         .success-content,
                                         .error-content {
                                             gap: 12px;
                                         }

                                         .success-content i,
                                         .error-content i {
                                             font-size: 24px;
                                             min-width: 40px;
                                             padding: 8px;
                                         }

                                         .success-content strong,
                                         .error-content strong {
                                             font-size: 16px;
                                         }

                                         .success-content p,
                                         .error-content p {
                                             font-size: 13px;
                                         }
                                     }
                                 </style>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section><!-- /.Section contact us -->

         <!-- Section map -->
         <div class="box-map d-flex justify-content-center">
             <iframe src="https://www.google.com/maps?q=33.5261858,73.1330973&hl=en&z=18&output=embed" width="1530"
                 height="450" style="border:0;" allowfullscreen="" loading="lazy"
                 referrerpolicy="no-referrer-when-downgrade">
             </iframe>
         </div><!-- Section map -->

     </div><!-- /.Main-content -->
 @endsection

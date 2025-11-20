 @extends('layouts.landing')

@section('hero')
 <div class="main-content pt-0 pb-0 page-contact-us">

            <!-- Section contact us -->
            <section class="s-contact-us style-2 bg-white pt-118 pb-88">
                <div class="section-wrap">
                    <div class="tf-container w-1290">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="content-left">
                                    <div class="image mb-30">
                                        <img src="{{ asset('assets/images/section/s-contact.jpg') }}" alt="{{ asset('assets/images/section/s-contact.jpg') }}"
                                            class=" img lazyload" />
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
                                                <p class="text">
                                                    Prinsengracht 250, 2501016 PM
                                                    Amsterdam Netherlands
                                                </p>
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
                                                <p class="text">
                                                    Donalfarms@gmail.com <br>
                                                    Call Us 24/7: +1 987 654 3210
                                                </p>
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
                                                <p class="text">
                                                    Mon - Fri: 8.00am - 18.00pm <br>
                                                    Sat: 9.00am - 17.00pm Holidays: Closes
                                                </p>
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
                                        <p class="text">
                                            We will reply you within 24 hours via email, thank you for contacting

                                        </p>
                                        <div class="img-item">
                                            <img class="tf-animate-1" src="{{ asset('assets/images/item/rice-plant-2.png') }}" alt="" />
                                        </div>
                                    </div>
                                    <form id="contactform" method="post" action="./contact/contact-process.php"
                                        novalidate="novalidate" class="form-send-message style-2">
                                        <div class="cols style-2 mb-15">
                                            <fieldset>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Name*" aria-required="true" required />
                                            </fieldset>
                                            <fieldset>
                                                <input type="email" class="form-control email" id="mail" name="mail"
                                                    placeholder="Email*" required />
                                            </fieldset>
                                        </div>
                                        <div class="cols style-2 mb-15">
                                            <fieldset>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="Phone*" aria-required="true" required />
                                            </fieldset>
                                            <fieldset class="dropdown">
                                                <select name="text" id="Support">
                                                    <option value="You need to suport?" selected="">You need to
                                                        suport?
                                                    </option>
                                                    <option value="You need to suport? 1">You need to suport? 1
                                                    </option>
                                                    <option value="You need to suport? 2">You need to suport? 2
                                                    </option>
                                                    <option value="You need to suport? 3">You need to suport? 3
                                                    </option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="cols mb-30">
                                            <fieldset>
                                                <textarea name="message" id="message"
                                                    placeholder="Message..."></textarea>
                                            </fieldset>
                                        </div>
                                        <div class="checkbox-item send-wrap">
                                            <label class="mb-0">
                                                <span class="text font-nunito">Agree to our terms and
                                                    conditions</span>
                                                <input type="checkbox" class="checkbox-item" checked>
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.Section contact us -->

            <!-- Section map -->
            <div class="box-map">
                <div id="map" class="map"></div>
            </div><!-- Section map -->

        </div><!-- /.Main-content -->
    @endsection

<div class="contact fullscreen parallax"
    style="background-image:url({{ asset('bootstrap/assets/images/bg-contact.jpg') }}" data-img-width="2000"
    data-img-height="1334" data-diff="100">
    <div class="overlay">
        <div class="container-fluid">
            <div class="row contact-row mx-auto">
                <div class="col-sm-4  twitter-timeline">
                    <a data-chrome="nofooter noborders noscrollbar" data-width="320" data-theme="dark" data-height="335"
                        class="twitter-timeline" href="https://twitter.com/FoundDocument">Tweets by FoundDocument</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                <!-- /.address and contact -->
                <div class="col-sm-4 contact-left ">
                    <h2>
                        <span class="highlight">Get</span> in touch
                    </h2>
                    <ul class="ul-address">
                        <li>
                            <i class="pe-7s-map-marker"></i>East Africa</br>
                            <!--California 55000-->
                        </li>
                        <li>
                            <i class="pe-7s-phone"></i>+254 (0) 704 180 939</br>
                            +256 (0) 701 184 399
                        </li>
                        <li>
                            <i class="pe-7s-mail"></i>
                            <a href="mailto:founddocument@gmail.com">founddocument@gmail.com </a>
                        </li>
                        <li>
                            <i class="pe-7s-look"></i>
                            <a href="#">www.founddocument.com</a>
                        </li>
                    </ul>
                </div>
                <!-- /.contact form -->
                <div class="col-sm-4 contact-right" id="contact-form-con">
                    <form action="{{ route('contact-us') }}" class="form-horizontal" id="contact-form" method="post"
                        accept-charset="utf-8">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control " placeholder="Name"
                                value="" required />
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" id="subject" class="form-control "
                                placeholder="Suject" value="" required />
                        </div>
                        <div class="form-group">
                            <h6 id="emailResult">
                                </h2>
                                <input type="text" name="email" id="email" class="form-control "
                                    placeholder="Email" value="" required />
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="20" cols="20" id="message" class="form-control input-message "
                                placeholder="Message" value="" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Submit" class="btn btn-success " id="validate">
                        </div>
                        <div id="feedback"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row row-serv">
        <div class="col-md-10 col-md-offset-1 col-sm-12 text-center service-title">
            <!-- /.Service title -->
            <h2 class="text-center wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"> Our
                Services </h2>
            <div class="title-line wow fadeInRight animated"
                style="visibility: visible; animation-name: fadeInRight; margin-bottom: 5%;"></div>
        </div>
        <div class="col-md-4 text-center">
            <div id="services_carousel" class="hero-carousel carousel slide hidden-xs hidden-sm" data-ride="carousel">
                @php
                    $counter = 0;
                @endphp
                <ol class="carousel-indicators">
                    @foreach ($advertTwos->where('status', 1) as $advert)
                        <!-- Indicators -->
                        <li data-target="#services_carousel" data-slide-to="@php echo $counter @endphp"
                            class="@if ($counter == 0) active @endif">
                        </li>
                        @php
                            $counter += 1;
                        @endphp
                    @endforeach
                </ol>


                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($advertTwos->where('status', 1) as $advert)
                        <div class="item @if ($counter === 0) active @endif">
                            <div class="ooverlay"></div>
                            <img src="{{ asset('assets/cms/' . $advert->image) }}" alt="Chania" id='img3'>
                        </div>
                        @php
                            $counter += 1;
                        @endphp
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-8 serv-list">
            <div class="row">
                <!-- /.service 1 -->
                <div class="col-sm-6 serv-list">
                    <i class="pe-7s-timer pe-5x pe-va wow fadeInUp animated" data-wow-delay="0.4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;"></i>
                    <div class="inner">
                        <h4>MANAGE DOCUMENTS</h4>
                        <p>Open a FREE account with FoundDocument and save your document detials e.g. type and serial
                            number
                            on cloud. When the document is lost, you can report it by clicking a button without worrying
                            to
                            locate the serial number and other details of the document .
                        </p>
                    </div>
                </div>
                <!-- /.service 2 -->
                <div class="col-sm-6 serv-list">
                    <i class="pe-7s-mail-open-file pe-5x pe-va wow fadeInUp animated" data-wow-delay="0.4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp; margin-bottom: 5%;"></i>
                    <div class="inner">
                        <h4>MATCH & NOTIFY</h4>
                        <p>When a document reported as lost is also reported as found, we match them. The owner of the
                            document is then notified that the document is found. Through FREE subscription, user can
                            choose
                            notification through email, SMS or both.</p>
                    </div>
                </div>
                <!-- /.service 3 -->
                <div class="col-sm-6 serv-list" style="margim-left:40%">
                    <i class="pe-7s-box1 pe-5x pe-va wow fadeInUp animated" data-wow-delay="0.4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;"></i>
                    <div class="inner">
                        <h4>COURIER</h4>
                        <p>If at all your document if found in alocation that you may not reach immediately,
                            FoundDocument
                            will send it to you. Kindly refer to our <a href="#">price list</a> for the parcel
                            categories.</p>
                    </div>
                </div>
                <!-- /.service 4 -->
                <div class="col-sm-6 serv-list">
                    <i class="pe-7s-map pe-5x pe-va wow fadeInUp animated" data-wow-delay="0.4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;"></i>
                    <div class="inner">
                        <h4>RECOVERY SUPPORT</h4>
                        <p>We share a map showing location of the found document. This helps the owner to be able to
                            trace
                            his/her way to the location the document is in case they do not want it couriered to their
                            location.</p>
                    </div>
                </div>
                <!-- /.service 5 -->
                <div class="col-sm-6 serv-list">
                    <i class="pe-7s-target pe-5x pe-va wow fadeInUp animated" data-wow-delay="0.4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;"></i>
                    <div class="inner">
                        <h4>ADVERTISING</h4>
                        <p>Our traffic presents opportunity to display your information or make a presentation. The <a
                                href="#">Ad rates</a> are based on the advertisement space and time zone.</p>
                    </div>
                </div>
                <!-- /.service 6 -->
                <div class="col-sm-6 serv-list">
                    <i class="pe-7s-star pe-5x pe-va wow fadeInUp animated" data-wow-delay="0.4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;"></i>
                    <div class="inner">
                        <h4>CARD PRINTING</h4>
                        <p>We print quality cards with this platform connection. When missplaced and found, it can
                            easily be
                            reporting to <a href="#">FoundDocument</a> for the owner to be notified.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

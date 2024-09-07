<footer id="footer" class="footer">
    <div class="container ">
        <div class="row">
            <div class="col pull-left text-white" style="font-size: 14px; color:rgb(255, 255, 255);">copyright&copy;
                @php echo date('Y');@endphp.{{ env('APP_NAME') }}.
            </div>
            <!-- /.social links -->
            <div class="col social text-center">
                <ul>
                    <li><a class=" " href="https://twitter.com/founddocument"><i class="fa fa-twitter"></i></a></li>
                    <li><a class=" " href="https://www.facebook.com/founddocument" data-wow-delay="0.2s"><i
                                class="fa fa-facebook"></i></a></li>
                    <li><a class=" " href="https://plus.google.com/" data-wow-delay="0.4s"><i
                                class="fa fa-google-plus"></i></a></li>
                    <li><a class=" " href="https://instagram.com/founddocument" data-wow-delay="0.6s"><i
                                class="fa fa-instagram"></i></a></li>

                </ul>
            </div>
            <div class="col pull-right pt-8"><span class="pull-right"
                    style="font-size: 14px; color:rgb(255, 255, 255);"> Powered by <a
                        href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a></span>
            </div>
            <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
        </div>
    </div>
</footer>

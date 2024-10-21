<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-auto pull-left text-white" style="font-size: 14px; color:rgb(255, 255, 255);">
                <span class="align-bottom">
                    copyright&copy; @php echo date('Y');@endphp.{{ env('APP_NAME') }}.
                </span>
            </div>
            <!-- /.social links -->
            <div class="col-auto social text-center">
                <ul>
                    <li><a class="" href="https://twitter.com/founddocument"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="" href="https://www.facebook.com/founddocument" data-wow-delay="0.2s"><i
                                class="fa fa-facebook"></i></a></li>
                    <li><a class="" href="https://plus.google.com/" data-wow-delay="0.4s"><i
                                class="fa fa-google-plus"></i></a></li>
                    <li><a class="" href="https://instagram.com/founddocument" data-wow-delay="0.6s"><i
                                class="fa fa-instagram"></i></a></li>

                </ul>
            </div>
            <div class="col-auto pull-right">
                <span class="pull-right text-white" style="font-size: 14px; color:rgb(255, 255, 255);">
                    Powered by <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
                </span>
            </div>
            <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
        </div>
    </div>
</footer>

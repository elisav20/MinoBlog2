<!-- .contact -->
<section class="contact">
    <div class="container">
        <h2>Contact</h2>
        <div class="row">
            <div class="col-12">
                <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" style="height: 400px">
                    <iframe src="https://maps.google.com/maps?q=Manhatan&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="contact__title">How to Contact us</div>
                <p class="contact__text">This contact use Contact Form 7 plugin. When you installed default Contact
                    Form 7 form submission, it will adapted to Mino default CSS styles as you seen in this page.</p>

                <form id="form" action="/contact" method="post" class="submitForm">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="contact-name" name="contact-name" class="form-control">
                                <label for="contact-name" class="">Your name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="email" id="contact-email" name="contact-email" class="form-control">
                                <label for="contact-email" class="">Your email</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <input type="text" id="contact-subject" name="contact-subject" class="form-control">
                                <label for="contact-Subject" class="">Subject</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <textarea id="contact-message" name="contact-message" class="form-control md-textarea"
                                    rows="3"></textarea>
                                <label for="contact-message">Your message</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-default btn-rounded btn-md submitBtn" type="submit">SEND</button>
                    </div>

                </form>

            </div>
            <!-- /.col-6 -->

            <div class="col-6">
                <div class="contact__title">How you can reach us <br>Tonjoo </div>
                <p class="contact__text">Jalan Tongkol Raya No 5 - Minomartani Ngaglik Sleman, Yogyakarta 55581
                    +62 812 1865 7154.</p>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.contact -->
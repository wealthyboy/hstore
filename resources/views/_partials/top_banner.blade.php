<div style="background-color: {{ $global_promo->background_color }}" class="top-notice text-white">
    <div class="container-fluid text-center">
        <div class="row">
            @foreach($global_promo->promo_texts as $promo_text)
            <div class="col-12 border-right ">
                <h5 class="d-inline-block color--light text-uppercase  mb-0"><b><i class="fas fa-money-check"></i>
                {{ $promo_text->promo}}</b>
                </h5>
            </div>
            @endforeach
            

        </div>
    </div><!-- End .container -->
</div>
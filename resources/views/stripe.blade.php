<!DOCTYPE html>
<html>
<head>
    <title>Checkout-Sarey.co</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    	<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/images/brand/favi.png')}}" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="{{url('public/assets/images/logo.png')}}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin|'Open Sans'|sans-serif">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    
    <style type="text/css">

        body{
            background-color: #f6f9fc !important;

            font-family:'Cabin','Open Sans', sans-serisf ;
            font-weight: 400;
            font-style: normal;
            font-feature-settings: "pnum";
            font-variant-numeric: proportional-nums;
            
        }


        .panel-title {
            display: inline;
            font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }

        .shadow{
            box-shadow: 0px 2px 6px #cccccc !important;
        }
        .form-control:focus{
            border:none !important;
            
            box-shadow: none;
            border-bottom:1px solid !important;
            border-color: #69bb4d  !important;
        }

        .form-control{
            border-radius: 0 !important;
            border:none !important;
            box-shadow: none;
            border-bottom:1px solid  #ccc !important;
            margin-bottom:20px
        
        }
        .control-label{
            font-weight:500;
        }

        .has-error input{
            border-radius: 0 !important;
            border:none !important;
            box-shadow: none !important;
            border-bottom:1px solid  red !important;
        }

        .has-error input:focus{
            border:none !important;
            box-shadow: none;
            border-bottom:1px solid !important;
            border-color: red  !important;
        }

        .panel-default{
            padding:40px 30px !important;
        }


        @media screen and (max-width:768px){
            .panel-default{
            padding:30px 30px !important;
            }
        }

        .rounded {
            border-radius: 3px;
        }

        .nav-pills .nav-link {
            color: #555
        }

        .nav-pills .nav-item.active a {
            color: white;
            background-color: #E30613 !important;
        }

       

        .bold {
            font-weight: bold
        }

        .shadow-sm {
            box-shadow: 0 .125rem .50rem rgba(0,0,0,.075)!important;
        }


        .nav-pills{
            display: flex;
        }
        .nav-fill .nav-item {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            text-align: center;
        }

        .mr-2{
            margin-right: 10px;
        }
       

       .form-group{
        margin-bottom: 4px !important;
       }

       .btn{
           font-size: 14px !important;
       }
    
    </style>






</head>
<body>
    
    <div class="container" style="margin-top: 40px">
       
        <div class="row">
            <div class="col-lg-6 col-md-8 col-lg-offset-3 col-md-offset-2">
                <div class="panel panel-default credit-card-box shadow">
                    <div class="text-center " style="margin-bottom:20px;">
                        <a href="https://sarey.co/">
                            <img src="http://sarey.co/wp-content/uploads/2020/09/Master-Logo-Artwork@20x.png" alt="" style="width:150px;">

                        </a>
                    </div>

                    <ul class="list-group list-group-flush" style="color:#555;margin:10px 0 0;">
                       
                        <li class="list-group-item listnoback">
                            <b><span class="fas fa-file-invoice-dollar mr-2"></span>Invoice Number</b> <a class="pull-right text-aqua" >INV-002</a>
                        </li>
                        <li class="list-group-item listnoback">
                            <b><span class="fas fa-envelope mr-2"></span>Email Address: </b> <a class="pull-right text-aqua" >mustafasadat338@gmail.com</a>
                        </li>
                        <li class="list-group-item listnoback">
                            <b><span class="fas fa-money-check-alt mr-2"></span>Amount</b> <a class="pull-right text-aqua" >300</a>
                        </li>
                    </ul>

                   

                        <div style="padding:20px 0 10px 0;">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3 bg-white  shadow-sm" style="font-size: 15px !important">
                                <li class="nav-item active"> <a data-toggle="pill" href="#credit-card" class="nav-link  "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#other" class="nav-link "> <i class="fas fa-money mr-2"></i>Other </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#info" class="nav-link "> <i class="fas fa-info mr-2"></i> Info </a> </li>
                            </ul>
                        </div> <!-- End -->

                       
                        <div class="tab-content">
                            <div id="credit-card" class="tab-pane fade in active" style="padding:20px 20px 0 ;">
                               
                                

                                <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                id="payment-form">
                                @csrf
                                
                                {{-- <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Name on Card</label> <input
                                        class='form-control' size='4' type='text'>
                                    </div>
                                </div> --}}
                                
                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group card required'>
                                                <label class='control-label'>Card Number</label> <input
                                                autocomplete='off' class='form-control card-number' placeholder="---- ---- ---- ----" type="text" size="19" name="ccnum" id="ccnum">
                                            </div>
                                        </div>
        
                                
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                                class='form-control card-cvc' placeholder="---"  size="4" type="text" name="cvc" id="cvc">
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' maxlength = "2"
                                                type='text' onkeypress="return onlyNumberKey(event)">
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' maxlength = "4"
                                                type='text' onkeypress="return onlyNumberKey(event)">
                                            </div>
                                        </div>
                                
                                        <div class='form-row row' style="margin-top:10px;">
                                            <div class='col-md-12 error form-group hide'>
                                                <div class='alert-danger alert'>Please correct the errors and try
                                                    again.
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn btn-block" type="submit"  style="background:#E30613;color:white;border-radius:3px; ">Pay  <span style="font-weight:200px; margin-right:1px;margin-left:10px;;">( £</span> 300 )</button>
                                            </div>
                                        </div>
  
                                    {{-- <input type="hidden" name="request_total" value="{{$total}}" > --}}
                                </form>





                            </div>
                            <div id="paypal" class="tab-pane fade" style="padding:20px 20px 0;">
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-xs-12">
                                        <a 
                                        {{-- href="{{url('payment')}}/{{$total}}"  --}}
                                        class="btn btn-primary btn-block" style="background:#0070ba">
                                            <span class="fab fa-paypal " style="margin-right: 4px;" id="linkButton"> </span> PayPal   <span style="font-weight:200px; margin-right:1px;margin-left:10px;;">( £</span> 300 )
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="other" class="tab-pane fade" style="padding:20px 20px 0;">
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-xs-12">
                                        <a  class="btn btn-primary btn-block" style="background:black">
                                            <span class="fab fa-apple"  style="margin-right: 4px;" id="linkButton"> </span> Apple  <span style="font-weight:200px; margin-right:1px;margin-left:10px;;">( £</span> 300 )
                                        </a>
                                    </div>
                                    <div class="col-xs-12" style="margin-top: 10px;">
                                        <a  class="btn btn-primary btn-block" style="background:#0070ba">
                                            <span class="fab fa-google"  style="margin-right: 4px;" id="linkButton"> </span> Google  <span style="font-weight:200px; margin-right:1px;margin-left:10px;;">( £</span> 300 )
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="info" class="tab-pane fade" style="padding:20px;">
                                <div style="padding:10px 20px;">
                                    <a href="sarey.co" style="text-decoration: underline;"><span class="fas fa-info mr-2"></span>Click For More Your Information.</a>
                                </div>
                            </div>
                        </div>

                       
                    
                </div>        
            </div>
        </div>
        
    </div>
   

</body>


<script src="{{url('public/js/payform.min.js')}}" ></script>
<script>
    var ccnum  = document.getElementById('ccnum'),
    cvc    = document.getElementById('cvc');
    
    payform.cardNumberInput(ccnum);
    payform.cvcInput(cvc);


    function onlyNumberKey(evt) {
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
              return false;
          return true;
      }

</script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
        var $form         = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
            'input[type=text]', 'input[type=file]',
            'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
            $errorMessage.addClass('hide');
            
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
            
        });
        
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
            } else {
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
        
    });
</script>




   

</html>
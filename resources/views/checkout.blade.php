<!DOCTYPE html>
<html>
<head>
    <title>Checkout-Sarey.co</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/images/brand/favi.png')}}" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="{{url('public/assets/images/logo.png')}}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|'Open Sans'|sans-serif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('public/assets/invoice/style.css') }}" rel="stylesheet" /> --}}


    <style type="text/css">

        body{
            background-color: #f6f9fc !important;

            font-family:"Montserrat", sans-serif;
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

        /* .form-control{
            border-radius: 0 !important;
            border:none !important;
            box-shadow: none;
            border-bottom:1px solid  #ccc !important;
            margin-bottom:20px
        
        } */
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
            padding:40px 30px 50px !important;
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
    
     <div class="container" style="margin-top: 50px;margin-bottom:20px;">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-lg-offset-1 col-md-offset-2">
                <div class="panel panel-default credit-card-box shadow">
                  <div class="text-center " style="margin-bottom:40px;margin-top:20px;"> 
                        <a href="https://sarey.co/">
                            <img src="http://sarey.co/wp-content/uploads/2020/09/Master-Logo-Artwork@20x.png" alt="" style="width:160px;">

                        </a>
                    </div> 

                     <ul class="list-group list-group-flush" style="color:#555;margin:20px 0;">
                        <b><span class="fas fa-file-invoice-dollar mr-2"></span>Invoice Number</b> <span class="" >#{{$info[0]->invoice_number}}</span>

                  
                    </ul>  
                    <table class="table table-hover">
                        <thead>
                            <tr style="background-color: #E30613;color:#ffffff">
                                <td>#</td>
                                <td>Item Description</td>
                                <td>Price</td>
                                <td>Quantity</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter=1; $total=0; @endphp
                            @foreach ($invoices as $row)
                                
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$row->description}}</td>
                                <td>  @if($currency=="USD") $ @elseif ($currency=="GBR") £ @else  € @endif {{$row->amount}}</td>
                                <td>{{$row->qty}}</td>
                                <td>  @if($currency=="USD") $ @elseif ($currency=="GBR") £ @else  € @endif{{$row->amount*$row->qty}}</td>
                            </tr>
                            @php  $total+=(int)$row->amount*(int)$row->qty; @endphp

                            @endforeach

                    
                        </tbody>
                    </table>
                    <section class="balance-info">
                        <div class="row">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4">
                                <table class="table border-0 table-hover">
                                    <tbody>
                                    </tbody><tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td>  @if($currency=="USD") $ @elseif ($currency=="GBR") £ @else  € @endif{{$total}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                             
                            </div>
                        </div>
                    </section>
                        <div style="padding:20px 0 10px 0;">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3 bg-white  shadow-sm" style="font-size: 15px !important">
                                <li class="nav-item active"> <a data-toggle="pill" href="#credit-card" class="nav-link  "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                            </ul>
                        </div> <!-- End -->

                       
                        <div class="tab-content">
                            <div id="credit-card" class="tab-pane fade in active" style="padding:20px 20px 0 ;">
                                <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                   data-cc-on-file="false"  data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                     @csrf
                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group card required'>
                                                <label class='control-label'>Card Number </label> 
                                                <input autocomplete='off' class='form-control card-number' placeholder="---- ---- ---- ----" type="text" size="19" name="ccnum" id="ccnum">
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
                                                <div class='alert-danger alert'>Please correct the errors and try again.
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn btn btn-block" type="submit"  style="background:#E30613;color:white;border-radius:3px; ">Checkout</button>
                                            </div>
                                        </div>
  
                                    <input type="hidden" name="amount" value="{{$total}}" >
                                    <input type="hidden" name="invoice_id" value="{{$info[0]->invoice_number}}" >
                                    <input type="hidden" name="currency" value="{{Helper::getProject($info[0]->project_id)->currency}}" >

                                </form>
                            </div>
                            <div id="paypal" class="tab-pane fade" style="padding:20px 20px 0;">
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-xs-12">
                                        <a href="{{url('paypal')}}/{{$info[0]->invoice_id}}/{{$total}}"  class="btn btn-primary btn-block" style="background:#0070ba">
                                            <span class="fab fa-paypal " style="margin-right: 4px;" id="linkButton"> </span> PayPal Checkout

                                        </a>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>

                       
                    
                {{-- </div>         --}}
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


    <!-- NOTIFICATIONS JS -->
		<script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>


    
   
 @if (session()->has('warning'))

 <script>
       
        $.growl.warning({
            message:<?php echo '"'.session()->get('warning').'"'  ?>,
            title: 'warning !',
        });

</script>


@endif





</html>

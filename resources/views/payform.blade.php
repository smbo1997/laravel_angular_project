@extends('layouts.app')
@section('content')

    <style>
        .alert.parsley {
            margin-top: 5px;
            margin-bottom: 0px;
            padding: 10px 15px 10px 15px;
        }

        .check .alert {
            margin-top: 20px;
        }
    </style>

    <div class="container">
        @if (isset($error))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($error->all() as $errors)
                        <li>{{ $errors }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if (isset($success))
                {{dd($success)}}
                <span  style="color: green;padding:10px;">Your Payment was successful</span>
            @endif
        <div class="col-xs-3">
            <form method="post" id ="payment-form" action="{{url('paywithcard')}}">
                <div class="col-md-12">
                    <span class="payment-errors" style="color: red;margin-top:10px;"></span>
                </div><br><br>
                {{ csrf_field() }}
                <div class="form-group" class="col-sm-6">
                    <label for="usr">Card No:</label>
                    <input type="text" class="form-control card-number" name="number" required>
                </div>
                <div class="form-group" class="col-sm-6">
                    <label for="pwd">Exp Month:</label>
                    <input type="text" class="form-control card-expiry-month" name="exp_month" required>
                </div>
                <div class="form-group" class="col-sm-6">
                    <label for="pwd">Exp Year:</label>
                    <input type="text" class="form-control card-expiry-year" name="exp_year" required>
                </div>
                <div class="form-group" class="col-sm-6">
                    <label for="pwd">CVC No:</label>
                    <input type="text" class="form-control card-cvc" name="cvc" required>
                </div>
                <div class="form-group" class="col-sm-6">
                    <label for="pwd">Total:</label>
                    <input type="text" class="form-control" name="total" required>
                </div><br>

                <button type="submit" class="btn btn-primary" id="submitBtn">Pay</button><br/><br/>
            </form>
        </div>

    </div>
    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };
    </script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey("<?php echo env('STRIPE_KEY') ?>");
        jQuery(function($) {
            $('#payment-form').submit(function(event) {
                //$form.find('.payment-errors').addClass('hidden');
                var $form = $(this);
                $form.find('#submitBtn').prop('disabled', true);
                Stripe.card.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
                return false;
                //Stripe.card.createToken($form, stripeResponseHandler);
            });
        });
        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');
            if (response.error) {
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').addClass('alert alert-danger');
                $form.find('#submitBtn').prop('disabled', false);
                $('#submitBtn').button('reset');
            } else {
                var token = response.id;
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                $form.get(0).submit();
            }
        };
    </script>
@endsection

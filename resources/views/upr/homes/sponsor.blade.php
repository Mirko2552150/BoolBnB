@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('guest.homes.index')}}">Home</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('upr.homes.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sponsor</li>
          </ol>
        </nav>
      </div>
    </div>
</div>
@if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{-- FORM POCO PERSONALIZZABILE/ NATIVO DI BRAINTREE --}}
                    <form method="post" id="payment-form" action="{{url('/checkout')}}">
                        @csrf
                        <section>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" id="24h" name="amount" value="2.99">
                                        <label for="24h">24h - 2.99€</label><br>
                                        <input type="radio" id="72h" name="amount" value="5.99">
                                        <label for="72h">72h - 5.99€</label><br>
                                        <input type="radio" id="144h" name="amount" value="9.99">
                                        <label for="144h">144h - 9.99€</label><br>
                                    </div>
                                </div>
                            </div>

                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </section>

                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button class="button" type="submit"><span>Test Transaction</span></button>
                    </form>
                    <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
                    <script>
                        var form = document.querySelector('#payment-form');
                        var client_token = "{{ $token }}";

                        braintree.dropin.create({
                          authorization: client_token,
                          selector: '#bt-dropin',

                        }, function (createErr, instance) {
                          if (createErr) {
                            console.log('Create Error', createErr);
                            return;
                          }
                          form.addEventListener('submit', function (event) {
                            event.preventDefault();

                            instance.requestPaymentMethod(function (err, payload) {
                              if (err) {
                                console.log('Request Payment Method Error', err);
                                return;
                              }

                              // Add the nonce to the form and submit
                              document.querySelector('#nonce').value = payload.nonce;
                              form.submit();
                            });
                          });
                        });
                    </script>
                    {{-- FINE FORM NATIVO DI BRAINTREE --}}



                    {{-- INIZIO HOSTED FIELDS PERSONALIZZABILI --}}
                    {{-- FORM PERSONALIZZABILE CON HOSTED FIELDS --}}
                    {{--<form action="{{url('/checkout')}}" id="my-sample-form" method="post">
                      @csrf
                      <label for="card-number">Card Number</label>
                      <div id="card-number"></div>

                      <label for="cvv">CVV</label>
                      <div id="cvv"></div>

                      <label for="expiration-date">Expiration Date</label>
                      <div id="expiration-date"></div>

                      <input type="submit" value="Pay"/>
                    </form>

                    <script src="https://js.braintreegateway.com/web/3.62.2/js/client.min.js"></script>
                    <script src="https://js.braintreegateway.com/web/3.62.2/js/hosted-fields.min.js"></script>
                    <script>
                      var form = document.querySelector('#my-sample-form');
                      var submit = document.querySelector('input[type="submit"]');

                      braintree.client.create({
                        authorization: '{{ $token }}'
                      }, function (clientErr, clientInstance) {
                        if (clientErr) {
                          console.error(clientErr);
                          return;
                        }

                        // This example shows Hosted Fields, but you can also use this
                        // client instance to create additional components here, such as
                        // PayPal or Data Collector.

                        braintree.hostedFields.create({
                          client: clientInstance,
                          styles: {
                            'input': {
                              'font-size': '14px'
                            },
                            'input.invalid': {
                              'color': 'red'
                            },
                            'input.valid': {
                              'color': 'green'
                            }
                          },
                          fields: {
                            number: {
                              selector: '#card-number',
                              placeholder: '4111 1111 1111 1111'
                            },
                            cvv: {
                              selector: '#cvv',
                              placeholder: '123'
                            },
                            expirationDate: {
                              selector: '#expiration-date',
                              placeholder: '10/2022'
                            }
                          }
                        }, function (hostedFieldsErr, hostedFieldsInstance) {
                          if (hostedFieldsErr) {
                            console.error(hostedFieldsErr);
                            return;
                          }

                          // submit.removeAttribute('disabled');

                          form.addEventListener('submit', function (event) {
                            event.preventDefault();

                            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                              if (tokenizeErr) {
                                console.error(tokenizeErr);
                                return;
                              }

                              // If this was a real integration, this is where you would
                              // send the nonce to your server.
                              // console.log('Got a nonce: ' + payload.nonce);
                              document.querySelector('#nonce').value = payload.nonce;
                              form.submit();
                            });
                          }, false);
                        });
                      });
                  </script>--}}
                  {{-- FINE HOSTED FIELDS --}}

                </div>
            </div>
        </div>

@endsection

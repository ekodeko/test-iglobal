@extends('layouts.main')
@section('pageTitle', 'Data Jadwal Dokter')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                        </div>
                    </div>
                </div>
                <div class="ooef">
                    <form class="orderonline-embed-form" data-username="indohaircut" data-product-slug="test-ongkir"
                        id="oo-embed-form-test-ongkir-7151">
                        <div class="ooef-loader">
                            <style>
                                .ooef-loader {
                                    visibility: hidden;
                                    opacity: 0;
                                    position: absolute;
                                    left: 0;
                                    right: 0;
                                    top: 0;
                                    bottom: 0;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    flex-direction: column;
                                    animation: ooLoadingIn 10s ease;
                                    -webkit-animation: ooLoadingIn 10s ease;
                                    animation-fill-mode: forwards;
                                    overflow: hidden
                                }

                                @keyframes ooLoadingIn {
                                    0% {
                                        visibility: hidden;
                                        opacity: 0
                                    }

                                    20% {
                                        visibility: visible;
                                        opacity: 0
                                    }

                                    100% {
                                        visibility: visible;
                                        opacity: 1
                                    }
                                }

                                @-webkit-keyframes ooLoadingIn {
                                    0% {
                                        visibility: hidden;
                                        opacity: 0
                                    }

                                    20% {
                                        visibility: visible;
                                        opacity: 0
                                    }

                                    100% {
                                        visibility: visible;
                                        opacity: 1
                                    }
                                }

                                .ooef-loader>div,
                                .ooef-loader>div:after {
                                    border-radius: 50%;
                                    width: 2.5rem;
                                    height: 2.5rem
                                }

                                .ooef-loader>div {
                                    font-size: 10px;
                                    position: relative;
                                    text-indent: -9999em;
                                    border: .25rem solid #f5f5f5;
                                    border-left: .25rem solid #55c4cf;
                                    -webkit-transform: translateZ(0);
                                    -ms-transform: translateZ(0);
                                    transform: translateZ(0);
                                    -webkit-animation: ooLoading 1.1s infinite linear;
                                    animation: ooLoading 1.1s infinite linear
                                }

                                .ooef-loader.error>div {
                                    border-left: .25rem solid #ff4500;
                                    animation-duration: 5s
                                }

                                @-webkit-keyframes ooLoading {
                                    0% {
                                        -webkit-transform: rotate(0);
                                        transform: rotate(0)
                                    }

                                    100% {
                                        -webkit-transform: rotate(360deg);
                                        transform: rotate(360deg)
                                    }
                                }

                                @keyframes ooLoading {
                                    0% {
                                        -webkit-transform: rotate(0);
                                        transform: rotate(0)
                                    }

                                    100% {
                                        -webkit-transform: rotate(360deg);
                                        transform: rotate(360deg)
                                    }
                                }

                            </style>
                            <div aria-live="polite" role="status">
                                <div>Loading...</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        if (typeof ooLogError != 'function') {
            var ooLogError = function(error) {
                var req = new XMLHttpRequest();
                var payload = JSON.stringify({
                    url: document.location.href,
                    line: error.line,
                    stack: error.stack
                });
                var params = 'message=' + encodeURIComponent(error.name) + '&payload=' + encodeURIComponent(payload) +
                    '&type=embed&level=error';
                req.open('POST', 'https://api.orderonline.id/log', true);
                req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                req.send(params);
            };
        }
        try {
            if (typeof ooEmbedScript != 'function') {
                var ooEmbedScript = function() {
                    ! function(w, d, e, v, id, t, s) {
                        if (d.getElementById(id)) return;
                        t = d.createElement(e);
                        t.async = !0;
                        t.src = v;
                        t.id = id;
                        s = d.getElementsByTagName(e)[0];
                        s.parentNode.insertBefore(t, s);
                    }(window, document, 'script', 'https://cdn.orderonline.id/js/embed-slim.min.js?v=6.2.0',
                        'oo-embed-js');
                };
            }
            if (typeof orderOnlineInit != 'function') {
                var orderOnlineInit = function(w, n) {
                    if (w.ooe) return;
                    n = w.ooe = function() {
                        n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                    };
                    if (!w._ooe) w._ooe = n;
                    n.push = n;
                    n.loaded = !0;
                    n.version = '6.2.0';
                    n.queue = [];
                };
            }
            orderOnlineInit(window);
            ooe('setup', 'redirect', 'https://indohaircut.orderonline.id');
            ooe('init', 'indohaircut', 'test-ongkir', null, 'oo-embed-form-test-ongkir-7151', {
                "mode": "page",
                "action": "Klik untuk pemesanan",
                "title": "Form Pemesanan",
                "triggerPixel": true,
                "triggerGtm": false
            });
            if (!window.jQuery) {
                ! function(w, d, e, v, id, t, s) {
                    if (d.getElementById(id)) return;
                    t = d.createElement(e);
                    t.async = !0;
                    t.src = v;
                    t.id = id;
                    t.addEventListener('load', ooEmbedScript);
                    s = d.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t, s);
                }(window, document, 'script', 'https://cdn.orderonline.id/js/vendor/jquery.min.js', 'oo-embed-jquery');
            } else {
                ooEmbedScript();
            }
        } catch (e) {
            ooLogError(e);
            throw e;
        }

    </script>
@endpush

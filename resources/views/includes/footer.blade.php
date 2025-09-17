<section id="contact" class="bg-blue-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div data-aos="fade" data-aos-duration="900" data-aos-easing="ease-in-out" class="text-center title under-green">
                        <h2 class="d-inline text-white fw-bolder display-5">
                            @lang("CONTACT US")
                        </h2>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column-reverse flex-md-row mt-2 mt-lg-5 row">
                <div class="mt-4 mt-lg-0 col-lg-4">
                    <img src="{{ $settings['footerLogo'] }}" alt="" class="mb-4 img-fluid" width="350">
                    <p class="text-white lead">{!! $settings['siteAddress'] !!}</p>
                    <div class="row gx-1">
                        @foreach ($settings['socialMediaLinks'] as $item)
                            <div class="col-1">
                                <a href="{{ $item['link'] }}" class="d-block"><img src="{{ $item['icon'] }}" alt="" class="w-100 img-fluid"></a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-8">
                    <form action="{{ route('secure-contact') }}" method="POST" id="contact-form">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-12">
                              <input type="text" name="name" class="form-control custom-form" autocomplete="name" placeholder="Full Name" aria-label="Full Name" required>
                            </div>
                            <div class="col-12">
                              <input type="text" name="company" class="form-control custom-form" autocomplete="work" placeholder="Company" aria-label="Company" required>
                            </div>
                            <div class="col-12">
                              <input type="email" name="email" class="form-control custom-form" autocomplete="email" placeholder="Email" aria-label="Email" required>
                            </div>
                            <div class="col-12">
                              <input type="tel" oninput="this.value = this.value.replace(/[^0-9+]/g, '').replace(/(\..*?)\..*/g, '$1');" name="phone" class="form-control custom-form" autocomplete="mobile" placeholder="Phone Number" aria-label="Phone Number">
                            </div>
                            <div class="col-12">
                                <textarea name="message" id="message" rows="5" placeholder="Message" class="form-control custom-form"></textarea>
                            </div>
                            <div class="d-flex flex-column flex-md-row col-12">
                                <div>
                                    <div class="ms-auto g-recaptcha" data-sitekey="{{config('services.recaptcha.sitekey')}}"></div>
                                </div>
                                <div class="d-inline-block ms-md-auto mt-2 mt-md-0">
                                    <button type="submit" class="d-inline-flex px-5 text-white btn btn-green-light fw-medium">SUBMIT <span class="custom-icon" aria-hidden="true" style="background-image: url('{{ asset('img/icons/arrow.png') }}')"></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>  

@push('floating')
    <div id="whatsapp-icon">
        <img src="{{ asset('img/icons/wa.png') }}" alt="" class="img-fluid">
    </div>
    <div class="shadow-lg widget-wrapper" id="chat-widget">
        <div class="position-relative bg-blue-light p-3 rounded-top-3 text-white header">
            <div class="d-flex align-items-center row gx-2">
                <div class="col-2">
                    <div class="profile-image">
                        <img src="{{ asset('img/Logo.jpg') }}" alt="Goodseeds.id Logo" class="rounded-circle img-fluid">
                    </div>
                </div>
                <div class="col">
                    <h6 class="mb-0 fw-bold">Goodseeds.id</h6>
                    <small class="fw-medium">Senin - Jumat (09:00 - 18:00 WIB)</small>
                </div>
            </div>
            {{-- close icon bootstap times --}}
            <button type="button" class="top-0 position-absolute me-2 mt-2 btn-close btn-sm btn-close-white end-0" aria-label="Close"></button>
        </div>
        <div class="px-3 py-4 body" style="background-image: url({{asset('img/chats/ChatBackground.png')}})">
            <div>
                <div class="px-3 py-2 rounded chat-message">
                    <div class="chat-message-content">
                        <p class="mb-1 text-black-50 fs-7">
                            <strong>goodseeds.id</strong>
                        </p>
                        <p class="mb-2 fs-7">
                            {{ $settings['whatsappPopupGreetingMessage'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-3 rounded-bottom-3 footer">
            <a href="{{ $settings['whatsappLink'] }}" title="Mulai Chat" class="d-block rounded-pill text-white btn btn-sm btn-green-light" id="start-chat">Mulai Chat</a>
        </div>
    </div>
@endpush

@push('scripts')

<script>
    // const navbar = document.getElementById('custom-nav');
    const navbarMobile = document.getElementById('mobile-custom-nav');

    // let navbarHeight = navbar.offsetHeight;
    navbarMobile.querySelector('.menu-icon').addEventListener('click', function() {
        navbarMobile.classList.toggle('open');
    });

    const chatWidget = document.getElementById('chat-widget');
    const widgetTrigger = document.getElementById('whatsapp-icon');
    const startChat = document.getElementById('start-chat');
    const chatClose = chatWidget.querySelector('.btn-close');
    

    document.addEventListener('DOMContentLoaded', function() {

        // const body = document.body;
        // body.style.paddingTop = navbarHeight + 'px';

        setTimeout(() => {
            navbarMobile.querySelector('.menu').classList.add('shouldanimate');

        }, 3000);

        // Handel submit contact-form
        storeFormData();

        // Handle whatsapp widget
        widgetTrigger.addEventListener('click', function() {
            chatWidget.classList.toggle('open');
        });

        chatClose.addEventListener('click', function() {
            chatWidget.classList.remove('open');
        });

        startChat.addEventListener('click', function(e) {
            e.preventDefault();
            window.open(this.href, 'newwindow', 'width=800, height=600');
        });


    });

    function storeFormData() {
        const form = document.getElementById('contact-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            let url = form.getAttribute('action');

            // disable submit button
            form.querySelector('button[type="submit"]').setAttribute('disabled', 'disabled');

            axios.post(url, data)
                .then(response => {
                    form.reset();
                    let name = data.name;

                    alert('Thank you, ' + name + '. Your message has been sent successfully.');
                })
                .catch(error => {
                    console.error(error);

                    // Handle Error
                    // 419 - Expired Session | Do reload page
                    // 422 - Validation Error

                    if (error.response.status === 419) {
                        alert('Session expired. Please try again.');
                        location.reload();
                        return;
                    }

                    if (error.response.status === 422) {
                        let errors = error.response.data.errors;
                        let message = '';
                        for (const key in errors) {
                            message += errors[key][0] + '\n';
                        }
                        alert(message);
                    }else if (error.response.status === 400 && error.response.data.message == 'recaptcha_failed') {
                        // reset recaptcha
                        alert('Recaptcha failed. Please try again.');
                    }else {
                        alert('Something went wrong. Please try again later.');
                    }
                })
                .finally(() => {
                    console.log('finally');
                    // allways reset recaptcha
                    grecaptcha.reset();
                    // enable submit button
                    form.querySelector('button[type="submit"]').removeAttribute('disabled');
                });
        });
    }
</script>

@endpush
@include('header')

<style>
    .hero-about {
        background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') no-repeat center/cover;
        height: 45vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .hero-about h1 {
        background: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 10px;
    }

    .contact-section {
        padding: 50px 0;
    }


    .contact-section h2 {
        margin-bottom: 40px;
    }

    .form-controls {
        width: 80%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        height: 40%;
    }

    .btn-primary {
        background-color: #ff8800;
        border: none;
    }

    .btn-primary:hover {
        background-color: #e07b00;
    }

    .contact-info p {
        margin-bottom: 10px;
    }

    .map-responsive {
        overflow: hidden;
        padding-bottom: 56.25%;
        position: relative;
        height: 0;
    }

    .map-responsive iframe {
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        position: absolute;
    }
</style>

<!-- 🌟 HERO SECTION -->
<section class="hero-about">
    <div>
        <h1>Contact Us</h1>
        <p>Learn more about our blog, mission, and team</p>
    </div>
</section>

<div class="contact-section container">
    <section class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-6 mb-4">
                <form action="{{ url('/contact') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <h4 for="name">Your Name</h4>
                        {{-- <label for="name" class="form-label">Your Name</label> --}}
                        <input type="text" class="form-controls" id="name" name="name" required>
                    </div>

                    <div class="mb-4">
                        <h4 for="email">Your Email</h4>
                        {{-- <label for="email" class="form-label">Your Email</label> --}}
                        <input type="email" class="form-controls" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <h4 for="message">Message</h4>
                        {{-- <label for="message" class="form-label">Message</label> --}}
                        <textarea class="form-controls" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="col-md-5 contact-info">
                <h5>Our Office</h5>
                <p><strong>Email:</strong> dailythoghts@gmal.com</p>
                <p><strong>Phone:</strong> +91 9979606440</p>
                <p><strong>Address:</strong> 56 Athwagate, Surat, India</p>



                <!-- Map -->
                <div class="map-responsive mt-3">
                    <iframe src="https://maps.google.com/maps?q=India&t=&z=5&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
@include('footer')

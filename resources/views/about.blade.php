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

    .about-section {
        padding: 50px 0;
    }

    .about-section p {
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .team-member img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 15px;
    }
</style>

<!-- 🌟 HERO SECTION -->
<section class="hero-about">
    <div>
        <h1>About Us</h1>
        <p>Learn more about our blog, mission, and team</p>
    </div>
</section>

<!-- 📖 ABOUT SECTION -->
<section class="about-section container">
    <h2 class="text-center mb-4">Who We Are</h2>
    <p>
        Welcome to our blog! We are passionate about sharing insightful articles, tips, and stories
        that inspire, educate, and entertain our readers. Our mission is to provide valuable content
        across a wide range of topics including technology, lifestyle, travel, and personal development.
    </p>

    <p>
        Our team of dedicated writers and editors work tirelessly to bring you the latest trends,
        tips, and inspiration. Whether you’re here to learn, explore, or just enjoy a good story,
        our blog is designed to provide a seamless reading experience.
    </p>

    <h3 class="mt-5 mb-4 text-center">Meet Our Team</h3>
    <div class="row text-center">
        <div class="col-md-3 team-member">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Team Member">
            <h5>John Doe</h5>
            <p>Founder & Editor</p>
        </div>
        <div class="col-md-3 team-member">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Team Member">
            <h5>Jane Smith</h5>
            <p>Content Strategist</p>
        </div>
        <div class="col-md-3 team-member">
            <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Team Member">
            <h5>Mike Johnson</h5>
            <p>Senior Writer</p>
        </div>
        <div class="col-md-3 team-member">
            <img src="https://randomuser.me/api/portraits/women/66.jpg" alt="Team Member">
            <h5>Emma Brown</h5>
            <p>Designer & Developer</p>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="/home" class="btn btn-warning">Back to Home</a>
    </div>
</section>

@include('footer')

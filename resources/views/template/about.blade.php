<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('assets/css/about-contact.css') }}">
</head>

<body>
    <div class="container">
        <header>
            <h1>About Us</h1>
            <button class="back-button" onclick="location.href='{{ route('home') }}';">Back to Home</button>
        </header>

        <main>
            <section>
                <h2>Our History</h2>
                <p>Founded in 2010, our mission has always been to provide the best services in the industry...</p>
            </section>

            <section>
                <h2>Mission & Vision</h2>
                <p>Our mission is to create innovative solutions that empower businesses and individuals...</p>
            </section>

            <section>
                <h2>Our Team</h2>
                <div class="team">
                    <div class="team-member">
                        <img src="team1.jpg" alt="Team Member 1">
                        <h3>John Doe</h3>
                        <p>CEO & Founder</p>
                    </div>
                    <div class="team-member">
                        <img src="team2.jpg" alt="Team Member 2">
                        <h3>Jane Smith</h3>
                        <p>Head of Marketing</p>
                    </div>
                </div>
            </section>

            <section>
                <h2>Our Achievements</h2>
                <p>Awarded Best Startup of 2021...</p>
            </section>

            <footer>
                <p>Follow us:</p>
                <a href="https://facebook.com" target="_blank">Facebook</a> |
                <a href="https://twitter.com" target="_blank">Twitter</a> |
                <a href="https://instagram.com" target="_blank">Instagram</a>
            </footer>
        </main>
    </div>
</body>

</html>

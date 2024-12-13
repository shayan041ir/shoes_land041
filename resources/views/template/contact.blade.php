<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('assets/css/about-contact.css') }}">
</head>

<body>
    <div class="container">
        <header>
            <h1>Contact Us</h1>
            <button class="back-button" onclick="location.href='{{ route('home') }}';">Back to Home</button>
        </header>

        <main>
            <section>
                <h2>Get in Touch</h2>
                <p>If you have any questions, feel free to reach out to us via the form below or using the contact information provided.</p>
            </section>

            <section>
                <h2>Contact Information</h2>
                <ul>
                    <li><strong>Phone:</strong> +1 234 567 890</li>
                    <li><strong>Email:</strong> support@example.com</li>
                    <li><strong>Address:</strong> 123 Main Street, City, Country</li>
                </ul>
            </section>

            <section>
                <h2>Our Location</h2>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.123456789012!2d-123.456789012!3d37.123456789012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f123456789012%3A0x1234567890123456!2sYour+Company+Location!5e0!3m2!1sen!2s!4v1681234567890" 
                    width="100%" 
                    height="300" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"></iframe>
            </section>

            <section>
                <h2>Frequently Asked Questions</h2>
                <p><strong>Q:</strong> How can I contact support?<br><strong>A:</strong> You can email us at support@example.com or call us.</p>
                <p><strong>Q:</strong> What are your working hours?<br><strong>A:</strong> Monday to Friday, 9:00 AM - 6:00 PM.</p>
            </section>

            <section>
                <form action="contact.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea><br>

                    <input type="submit" value="Submit" class="submit-button">
                </form>
            </section>
        </main>
    </div>
</body>

</html>

<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";
?>

<style>
    /* General Styles */

    body {
        background-color: #150070; /* Light grey background for the whole page for a slight contrast */
        color: #333; /* Darker text for better readability */
        font-family: Arial, sans-serif;
    }

    .section {
        background-color: #ffffff; /* Keep sections white but add shadows for depth */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        margin: 20px auto; /* Centering */
        padding: 20px;
        border-radius: 8px; /* Soft rounded corners */
        max-width: 800px; /* Consistent width */
    }

    .section h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .section p, .section ul, .section h3 {
        color: #555; /* Slightly lighter text for body content */
        text-align: left;
    }

    /* Specific styles for contact and policy sections to enhance visibility */
    .contactInfo, .hours, .libraryPolicies {
        background-color: #e9ecef; /* Lighter background for these sections for differentiation */
        padding: 15px;
        border-radius: 8px; /* Soft rounded corners */
        margin-bottom: 20px;
    }

    .contactInfo h3, .hours h3, .libraryPolicies h3 {
        color: #333;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .section p, .section ul {
            text-align: center;
        }
    }
</style>

<div class="section" id="overview">
    <h2>Overview</h2>
    <p>Welcome to our Library! Founded in [Year], our library has been a cornerstone of the community, providing access to a vast collection of books, digital resources, and learning opportunities. Our mission is to empower individuals through knowledge and learning. We are committed to creating a welcoming, inclusive environment where everyone can explore, discover, and grow.</p>
</div>

<div class="section" id="features">
    <h2>Features</h2>
    <h3>History of the Library</h3>
    <p>Our library was established in [Year] with the aim of...</p>
    <h3>Mission Statement</h3>
    <p>Our mission is to empower...</p>
    <h3>Objectives</h3>
    <ul>
        <li>Provide access to educational resources.</li>
        <li>Support lifelong learning and growth.</li>
        <li>Create a community hub for knowledge and culture.</li>
    </ul>
</div>

<div class="section" id="contact-info">
    <div class="contactInfo">
        <h3>Contact Information</h3>
        <p>123 Library Avenue, City, State, Zip</p>
        <p>Email: contact@ourlibrary.com</p>
        <p>Phone: (123) 456-7890</p>
    </div>
    <div class="hours">
        <h3>Opening Hours</h3>
        <p>Monday - Friday: 9 am to 8 pm</p>
        <p>Saturday: 10 am to 6 pm</p>
        <p>Sunday: Closed</p>
    </div>
</div>

<div class="section" id="policies-membership">
    <div class="libraryPolicies">
        <h3>Library Policies and Membership</h3>
        <p>Our library offers various membership options to cater to our community's needs. Members can borrow books, access digital resources, and participate in library events. For more information on our policies and how to become a member, please contact us or visit our library.</p>
    </div>
</div>

<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>

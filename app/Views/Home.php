<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Sun Son Solar</title>
    <link rel="stylesheet" href="/css/sunson.css">
</head>
<body>


<!-- NAVIGATION -->
<nav class="navbar">
    <div class="logo-area">
        <img
            src="/images/logo.png"
            alt="Sun Son Solar Logo"
        >
        <div class="logo-text">
            SUN SON
            <span>
                SOLAR
            </span>
        </div>
    </div>


    <div class="nav-links">
        <button
            onclick="showPage('home')"
        >
            Home
        </button>

        <button
            onclick="showPage('products')"
        >
            Products
        </button>


        <button
            onclick="showPage('services')"
        >
            Services
        </button>


        <button
            onclick="showPage('about')"
        >
            About
        </button>


        <button
            onclick="showPage('login')"
        >
            Login
        </button>


        <button
            class="nav-register"
            onclick="showPage('registration')"
        >
            Register
        </button>
    </div>
</nav>


<!-- HOME -->
<section
    id="home"
    class="page active"
>

    <div class="hero">
        <div class="hero-left">
            <div class="small-title">
                COST SAVING
                &nbsp; • &nbsp;
                SUSTAINABILITY
                &nbsp; • &nbsp;
                ENERGY INDEPENDENCE
            </div>


            <h1>
                Power Your Future
                with Solar
            </h1>


            <p>
                Reliable solar power, smart batteries,
                and expert installation designed to
                keep your home powered day and night.
            </p>


            <div class="hero-buttons">
                <button
                    class="primary-button"
                    onclick="showPage('products')"
                >
                    Explore Products
                </button>


                <button
                    class="secondary-button"
                    onclick="showPage('services')"
                >
                    Our Services →
                </button>
            </div>
        </div>


        <div class="hero-right">
            <div class="home-card">
                <h2>
                    ☀️ Sun Son Solar
                </h2>

                <p>
                    Powering a Brighter Future
                </p>


                <div class="card">
                    <h3>
                        Clean Energy
                    </h3>

                    <p>
                        Discover solar solutions
                        for your home and business.
                    </p>
                </div>

                <br>

                <div class="card">
                    <h3>
                        Complete Solar Services
                    </h3>

                    <p>
                        Consultation, designing,
                        permitting, installation,
                        maintenance, repair and monitoring.
                    </p>
                </div>

                <br>

                <button
                    class="main-button"
                    onclick="showPage('registration')"
                >
                    CREATE YOUR ACCOUNT →
            </button>
            </div>
        </div>
    </div>


    <footer class="footer">
        <p>
            <strong>
                Sun Son Solar
            </strong>
        </p>

        <p>
            Powering a Brighter Future
        </p>
    </footer>
</section>


<!-- REGISTRATION -->
<section
    id="registration"
    class="page"
>

    <div class="form-page">
        <div class="form-card">
            <h1>
                🌿 Create an Account
            </h1>

            <p class="form-subtitle">
                Start your solar journey today.
            </p>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="server-message error">
                    <?php foreach (session()->getFlashdata('errors') as $item): ?>
                        <p><?= esc($item) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form
                id="registrationForm"
                action="/register"
                method="post"
            >
                <?= csrf_field() ?>

                <!-- ACCOUNT TYPE -->
                <input type="hidden" name="AccountType" value="Customer">


                <!-- FIRST NAME / LAST NAME -->
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            First Name
                        </label>
                        <input
                            type="text"
                            id="firstName"
                            class="input"
                            name="Fname"
                            placeholder="Enter first name"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>
                            Last Name
                        </label>
                        <input
                            type="text"
                            id="lastName"
                            class="input"
                            name="Lname"
                            placeholder="Enter last name"
                            required
                        >

                    </div>
                </div>


                <!-- MIDDLE / BIRTHDATE -->
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Middle Name
                        </label>
                        <input
                            type="text"
                            id="middleName"
                            class="input"
                            name="Mname"
                            placeholder="Enter middle name"
                        >
                    </div>


                    <div class="form-group">
                        <label>
                            Birthdate
                        </label>
                        <input
                            type="date"
                            id="birthdate"
                            class="input"
                            name="Bday"
                            required
                        >
                    </div>
                </div>


                <!-- GENDER / PHONE -->
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Gender
                        </label>
                        <select
                            id="gender"
                            name="Gender"
                            required
                        >
                            <option value="">
                                Select gender
                            </option>
                            <option value="Male">
                                Male
                            </option>
                            <option value="Female">
                                Female
                            </option>
                            <option value="Other">
                                Other
                            </option>
                            <option value="Prefer not to say">
                                Prefer not to say
                            </option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>
                            Phone Number
                        </label>
                        <input
                            type="text"
                            id="phone"
                            class="input"
                            name="PhNo"
                            maxlength="11"
                            placeholder="Enter 11-digit number"
                            required
                        >

                        <span
                            id="phoneError"
                            class="error"
                        ></span>
                    </div>
                </div>


                <!-- EMAIL -->
                <div class="form-group">
                    <label>
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        class="input"
                        name="EmAdd"
                        placeholder="Enter email address"
                        required
                    >
                </div>


                <!-- ADDRESS -->
                <div class="form-group">
                    <label>
                        Address
                    </label>
                    <input
                        type="text"
                        id="address"
                        class="input"
                        name="Addrs"
                        placeholder="Enter home / business address"
                        required
                    >
                </div>


                <!-- EMPLOYEE DEPARTMENT -->
                

                <span
                    id="passwordError"
                    class="error"
                ></span>

                <!-- TERMS -->
                <div class="terms">
                    <input
                        type="checkbox"
                        id="terms"
                        name="Terms"
                        value="1"
                        required
                    >
                    I agree to the
                    <a href="#">
                        Terms & Conditions
                    </a>
                </div>

                <!-- REGISTER -->
                <button
                    type="submit"
                    class="main-button"
                >
                    REGISTER →
                </button>

                <span
                    id="registrationMessage"
                    class="success"
                ></span>
            </form>
        </div>
    </div>
</section>


<!-- LOGIN -->
<section
    id="login"
    class="page"
>

    <div class="form-page">
        <div
            class="form-card"
            style="max-width:550px;"
        >
            <h1>
                Welcome Back
            </h1>

            <p class="form-subtitle">
                Login to your Sun Son Solar account.
            </p>

            <?php if (session()->getFlashdata('message')): ?>
                <span class="server-message success">
                    <?= esc(session()->getFlashdata('message')) ?>
                </span>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <span class="server-message error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </span>
            <?php endif; ?>

            <form
                id="loginForm"
                action="/login"
                method="post"
            >
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>
                        Username
                    </label>

                    <input
                        type="text"
                        id="loginUsername"
                        class="input"
                        name="Uname"
                        placeholder="Enter username"
                        required
                    >
                </div>
                

                <div class="form-group">
                    <label>
                        Password
                    </label>

                    <input
                        type="password"
                        id="loginPassword"
                        class="input"
                        name="Pwd"
                        placeholder="Enter password"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="main-button"
                >
                    LOGIN →
                </button>

                <span
                    id="loginMessage"
                    class="error"
                ></span>
            </form>
        </div>
    </div>
</section>


<!-- PRODUCTS -->
<section
    id="products"
    class="page"
>
    <header class="page-header">
        <h1>
            Our Products
        </h1>

        <p>
            Quality solar solutions for your home
            and business.
        </p>
    </header>


    <main class="content">
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    ☀️
                </div>

                <h3>
                    Solar Panels
                </h3>

                <p>
                    Solar panels designed to convert
                    sunlight into clean electrical energy.
                </p>
            </div>


            <div class="card">
                <div class="card-icon">
                    ⚡
                </div>

                <h3>
                    Inverters
                </h3>

                <p>
                    Reliable inverters for converting
                    solar energy into usable electricity.
                </p>
            </div>


            <div class="card">
                <div class="card-icon">
                    🔋
                </div>

                <h3>
                    Batteries
                </h3>

                <p>
                    Battery systems for storing energy
                    and providing backup power.
                </p>
            </div>


            <div class="card">
                <div class="card-icon">
                    🏗️
                </div>
                <h3>
                    Racking
                </h3>
                <p>
                    Strong support structures for
                    solar panel installations.
                </p>
            </div>


            <div class="card">
                <div class="card-icon">
                    🔧
                </div>

                <h3>
                    Mounting
                </h3>

                <p>
                    Mounting systems suitable for
                    different installation locations.
                </p>
            </div>

            <div class="card">
                <div class="card-icon">
                    🔌
                </div>

                <h3>
                    Wires
                </h3>

                <p>
                    Solar electrical wires and
                    connection components.
                </p>
            </div>
        </div>
    </main>
</section>

 
<!-- SERVICES -->
<section
    id="services"
    class="page"
>

    <header class="page-header">
        <h1>
            Our Services
        </h1>

        <p>
            Complete solar services from consultation
            to monitoring.
        </p>
    </header>


    <main class="content">
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">
                    💬
                </div>

                <h3>
                    Consultation
                </h3>

                <p>
                    Discuss your energy requirements
                    with our solar team.
                </p>
            </div>


            <div class="card">
                <div class="card-icon">
                    📐
                </div>

                <h3>
                    Designing
                </h3>

                <p>
                    Solar system planning and
                    system design.
                </p>
            </div>

            <div class="card">
                <div class="card-icon">
                    📄
                </div>

                <h3>
                    Permitting
                </h3>

                <p>
                    Assistance with solar permits
                    and required documentation.
                </p>

            </div>


            <div class="card">

                <div class="card-icon">
                    🔨
                </div>

                <h3>
                    Installation
                </h3>

                <p>
                    Professional installation of
                    solar energy systems.
                </p>

            </div>


            <div class="card">

                <div class="card-icon">
                    🛠️
                </div>

                <h3>
                    Maintenance
                </h3>

                <p>
                    Keep your solar system operating
                    properly through regular maintenance.
                </p>

            </div>


            <div class="card">

                <div class="card-icon">
                    🔧
                </div>

                <h3>
                    Repair
                </h3>

                <p>
                    Troubleshooting and repair
                    services for solar systems.
                </p>
            </div>


            <div class="card">
                <div class="card-icon">
                    📊
                </div>

                <h3>
                    Monitoring
                </h3>

                <p>
                    Monitor your solar system's
                    performance and operation.
                </p>
            </div>
        </div>
    </main>
</section>

<!-- ABOUT -->
<section
    id="about"
    class="page"
>

    <header class="page-header">
        <h1>
            About Sun Son Solar
        </h1>
        <p>
            Powering a brighter future.
        </p>

    </header>
    <main class="content">
        <div class="about-box">
            <h2>
                About Us
            </h2>

            <p>
                <b>Founded:</b> 2016
            </p>
            <p>
                <b>Headquarters:</b> Pasig, Phillippines
            </p>
            <p>
                <b>Industry:</b> Renewable Energy & Smart Infrastructure
            </p>
            <p>
                Sun Son Solar is a solar energy company
                focused on providing clean energy, sustainable solutions, and reliable
                solar services to customers. Our system allows customers to explore
                solar products, learn about available
                services, and create an account online.
            </p>

            <h3>
                Mission
            </h3>
            <p>
                To illuminate a sustainable future by merging
                clean energy with intelligent design.
            </p>


            <div class="people">
                <div class="person">
                    <h3>
                        Katherine "Kat"
                    </h3>
                    <p>
                        Founder
                    </p>
                </div>

                <div class="person">
                    <h3>
                        Santino "Sonny"
                    </h3>
                    <p>
                        Founder’s Father
                    </p>
                </div>

                <div class="person">
                    <h3>
                        Sol Solis
                    </h3>
                    <p>
                        IT Head / Administrator
                    </p>
                </div>
            </div>
        </div>
    </main>
</section>


<!-- EMPLOYEE ATTENDANCE -->
<section
    id="attendance"
    class="page"
>

    <div class="attendance-page">
        <div class="attendance-box">
            <h2>
                📍 Employee Time In
            </h2>

            <p>
                Time in directly from the job site.
            </p>

            <p>
                Employee:
                <strong id="employeeName">
                    Please login first
                </strong>
            </p>

            <button
                id="timeInButton"
                class="time-in-button"
                onclick="timeIn()"
            >
                📍 TIME IN AT SITE
            </button>

            <div
                id="attendanceResult"
                class="attendance-result"
            ></div>
        </div>
    </div>
</section>
<script src="/js/sunson.js"></script>
</body>
</html>
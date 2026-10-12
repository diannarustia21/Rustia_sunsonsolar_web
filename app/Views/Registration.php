<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sun Son Solar</title>

    <link rel="stylesheet" href="assets/css/sunson.css">
</head>

<body>
    <div class="form-page">
        <div class="form-card">
            <h1>
                🌿 Create an Account
            </h1>

            <p class="form-subtitle">
                Start your solar journey today.
            </p>

            <form
                id="registrationForm"
                action="db.php"
                method="POST"
            >

                <!-- ACCOUNT TYPE -->
                <div class="form-group">
                    <label>
                        Account Type
                    </label>

                    <select
                        id="accountType"
                        required
                    >
                        <option value="">
                            Select account type
                        </option>
                        <option value="customer">
                            Customer
                        </option>
                        <option value="employee">
                            Employee
                        </option>
                    </select>
                </div>


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
                <div
                    id="departmentContainer"
                    class="form-group"
                    style="display: none;"
                >
                    <label>
                        Department
                    </label>
            
                    <select
                        id="department"
                        name="Departments"
                    >

                        <option value="">
                            Select department
                        </option>
                        <option value="IT">
                            IT
                        </option>
                        <option value="Technician">
                            Technician
                        </option>
                        <option value="Dispatcher">
                            Dispatcher
                        </option>
                        <option value="Management">
                            Management
                        </option>
                        <option value="Other">
                            Other
                        </option>
                    </select>
                </div>


                <!-- USERNAME -->
                <div class="form-group">
                    <label>
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        class="input"
                        name="Uname"
                        placeholder="Enter username"
                        required
                    >
                </div>


                <!-- PASSWORD -->
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Password
                        </label>
                    
                        <input
                            type="password"
                            id="password"
                            class="input"
                            name="Pwd"
                            placeholder="Enter password"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>
                            Confirm Password
                        </label>
                        <input
                            type="password"
                            id="confirmPassword"
                            class="input"
                            placeholder="Confirm password"
                            required
                        >
                    </div>
                </div>

                <span
                    id="passwordError"
                    class="error"
                ></span>

                <!-- TERMS -->
                <div class="terms">
                    <input
                        type="checkbox"
                        id="terms"
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

        <script>
             const accountType = document.getElementById("accountType");
             const departmentContainer = document.getElementById("departmentContainer");
             const department =  document.getElementById("department");
             accountType.addEventListener(
            "change",
            function() {    
                if (
                    accountType.value ===
                    "employee"
                ) {
                    departmentContainer.style.display =
                        "block";
                    department.required =
                        true;

                } else {
                    departmentContainer.style.display =
                        "none";
                    department.required =
                        false;
                    department.value =
                        "";
                }
            }
        );
        </script>
    
</body>
</html>

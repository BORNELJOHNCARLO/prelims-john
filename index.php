<?php
session_start();

// Clear all session data on initial load
if (!isset($_SESSION['initialized'])) {
    $_SESSION['initialized'] = true;
    $_SESSION['show_results'] = false;
    $_SESSION['student_first_name'] = '';
    $_SESSION['student_last_name'] = '';
    $_SESSION['student_age'] = '';
    $_SESSION['student_gender'] = '';
    $_SESSION['student_course'] = '';
    $_SESSION['student_email'] = '';
    $_SESSION['grade_prelim'] = '';
    $_SESSION['grade_midterm'] = '';
    $_SESSION['grade_finals'] = '';
    $_SESSION['grade_average'] = '';
    $_SESSION['grade_status'] = '';
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitStudent'])) {
        // Store student details in session variables
        $_SESSION['student_first_name'] = htmlspecialchars(trim($_POST['studentFirstName']));
        $_SESSION['student_last_name'] = htmlspecialchars(trim($_POST['studentLastName']));
        $_SESSION['student_age'] = htmlspecialchars(trim($_POST['studentAge']));
        $_SESSION['student_gender'] = htmlspecialchars(trim($_POST['studentGender']));
        $_SESSION['student_course'] = htmlspecialchars(trim($_POST['studentCourse']));
        $_SESSION['student_email'] = htmlspecialchars(trim($_POST['studentEmail']));

        // Hide results display and enable grade form
        $_SESSION['show_results'] = false;
        $_SESSION['show_grade_form'] = true;
    } elseif (isset($_POST['submitGrades'])) {
        // Retrieve grades
        $gradePrelim = isset($_POST['gradePrelim']) ? (float)$_POST['gradePrelim'] : 0;
        $gradeMidterm = isset($_POST['gradeMidterm']) ? (float)$_POST['gradeMidterm'] : 0;
        $gradeFinals = isset($_POST['gradeFinals']) ? (float)$_POST['gradeFinals'] : 0;

        // Calculate average
        $gradeAverage = round(($gradePrelim + $gradeMidterm + $gradeFinals) / 3, 2);
        $gradeStatus = $gradeAverage >= 75 ? "Passed" : "Failed";

        // Store grades and results
        $_SESSION['grade_prelim'] = $gradePrelim;
        $_SESSION['grade_midterm'] = $gradeMidterm;
        $_SESSION['grade_finals'] = $gradeFinals;
        $_SESSION['grade_average'] = $gradeAverage;
        $_SESSION['grade_status'] = $gradeStatus;

        // Show results display
        $_SESSION['show_results'] = true;

        // Reset the grade form flag
        unset($_SESSION['show_grade_form']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if (!isset($_SESSION['show_grade_form'])): ?>
            <h3 class="text-center">Student Enrollment Form</h3>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="studentFirstName" class="form-control" placeholder="First Name" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="studentLastName" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="studentAge" class="form-control" placeholder="Age" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="studentCourse" class="form-control" placeholder="Course" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="studentEmail" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender:</label>
                    <div>
                        <label class="me-3"><input type="radio" name="studentGender" value="male" checked> Male</label>
                        <label><input type="radio" name="studentGender" value="female"> Female</label>
                    </div>
 </div>
                <button type="submit" name="submitStudent" class="btn btn-primary">Submit</button>
            </form>
        <?php endif; ?>

        <?php if ($_SESSION['show_results']): ?>
    <h3 class="text-center">Student Results</h3>
    <p><strong>Name:</strong> <?php echo $_SESSION['student_first_name'] . ' ' . $_SESSION['student_last_name']; ?></p>
    <p><strong>Age:</strong> <?php echo $_SESSION['student_age']; ?></p>
    <p><strong>Course:</strong> <?php echo $_SESSION['student_course']; ?></p>
    <p><strong>Email:</strong> <?php echo $_SESSION['student_email']; ?></p>
    <p><strong>Prelim Grade:</strong> <?php echo $_SESSION['grade_prelim']; ?></p>
    <p><strong>Midterm Grade:</strong> <?php echo $_SESSION['grade_midterm']; ?></p>
    <p><strong>Finals Grade:</strong> <?php echo $_SESSION['grade_finals']; ?></p>
    <p><strong>Average Grade:</strong> <?php echo $_SESSION['grade_average']; ?></p>
    <p><strong>Status:</strong> <span style="color: <?php echo $_SESSION['grade_status'] == 'Passed' ? 'green' : 'red'; ?>;">
        <?php echo $_SESSION['grade_status']; ?></span></p>
        <?php elseif (isset($_SESSION['show_grade_form'])): ?>
            <h3 class="text-center">Grade Submission Form</h3>
            <form method="POST">
                <div class="mb-3">
                    <input type="number" name="gradePrelim" class="form-control" placeholder="Prelim Grade" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="gradeMidterm" class="form-control" placeholder="Midterm Grade" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="gradeFinals" class="form-control" placeholder="Finals Grade" required>
                </div>
                <button type="submit" name="submitGrades" class="btn btn-primary">Submit Grades</button>
            </form>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
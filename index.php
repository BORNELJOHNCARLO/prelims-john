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
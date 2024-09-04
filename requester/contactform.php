<?php
if (isset($_POST['submit'])) {
    // Check for empty fields
    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['email']) || empty($_POST['message'])) {
        // Message displayed if required fields are missing
        $msg = '<div class="alert alert-warning col-sm-6 mt-2" role="alert">Fill All The Fields</div>';
    } else {
        // Sanitize input to prevent security issues
        $name = htmlspecialchars(trim($_POST['name']));
        $subject = htmlspecialchars(trim($_POST['subject']));
        $email = htmlspecialchars(trim($_POST['email']));
        $message = htmlspecialchars(trim($_POST['message']));

        // Prepare the email components
        $mailTo = "pragyamaharjan985@gmail.com";
        $headers = "From: " . $email . "\r\n" .
                   "Reply-To: " . $email . "\r\n" .
                   "MIME-Version: 1.0\r\n" .
                   "Content-Type: text/plain; charset=UTF-8\r\n";
        $txt = "You have received an email from " . $name . ".\n\n" . $message;

        // Send the email
        if (mail($mailTo, $subject, $txt, $headers)) {
            $msg = '<div class="alert alert-success col-sm-6 mt-2" role="alert">Message Sent Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 mt-2" role="alert">Failed to Send Message</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <!-- Add Bootstrap CSS for styling (optional) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Contact Us</h2>

    <?php if (isset($msg)): ?>
        <?php echo $msg; ?>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="message" rows="4" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

<!-- Add Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

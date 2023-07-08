<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Home Cleaning Services</title>
  <!-- Rest of your head section -->

  <!-- Custom CSS -->
  <link href="css/feedback.css" rel="stylesheet">
</head>
<!-- <style>
  .feedback-form {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #f2f2f2;
  padding: 20px;
  width: 300px;
  border-radius: 5px;
  z-index: 9999;
}

.close-button {
  float: right;
  cursor: pointer;
}

button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

form {
  margin-top: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea {
  width: 100%;
  padding: 5px;
  border-radius: 4px;
  border: 1px solid #ccc;
  resize: vertical;
}

input[type="submit"] {
  margin-top: 10px;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

</style> -->

<body class="bg-dark">
  <!-- Rest of your body section -->

  <!-- Feedback Form Start -->
  <!-- <div id="feedbackForm" class="feedback-form">
    <h2>Feedback Form</h2>
    <span id="closeButton" class="close-button" onclick="closeForm()">&times;</span>
    <form action="submit_feedback.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message:</label>
      <textarea id="message" name="message" required></textarea>

      <input type="submit" value="Submit">
    </form>
  </div>

  <!-- Open Feedback Form Button -->
  <button id="openFormButton" onclick="openForm()">Give Feedback</button>

  <!-- JavaScript -->
  <script src="js/feedback.js"></script>
  <script>
  function openForm() {
  document.getElementById("feedbackForm").style.display = "block";
}

function closeForm() {
  document.getElementById("feedbackForm").style.display = "none";
}
</script> -->
</body>

</html>

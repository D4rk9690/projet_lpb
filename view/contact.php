<?php
require '../libs/PHPMailer/src/PHPMailer.php';
require '../libs/PHPMailer/src/Exception.php';
require '../libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start(); // Start the session

// Define variables and set to empty values
$firstName = $lastName = $email = $message = $captcha = "";


// Process the form when it's submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = testInput($_POST["firstName"]);
    $lastName = testInput($_POST["lastName"]);
    $email = testInput($_POST["email"]);
    $message = testInput($_POST["message"]);

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Configure SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alister.huysmans@gmail.com'; // Replace with your Elastic Email SMTP username
            $mail->Password = 'otgbqlguqwghoyzr'; // Replace with your Elastic Email SMTP password
            $mail->Port = 587; // Replace with your Elastic Email SMTP port

            // Enable TLS encryption
            $mail->SMTPSecure = 'tls';

            // Set email parameters
            $mail->setFrom($email);
            $mail->addAddress('alister.huysmans@gmail.com'); // Replace with your recipient email address
            $mail->Subject = 'Contact Form Submission';
            $mail->Body = "Name: $firstName $lastName\nEmail: $email\nMessage: $message";

            // Send the email
            $mail->send();

            // Display a success message
            echo "
            <div id='message-container' style='position: fixed; width:100vw; height:100vh; background-color: hsla(206, 15%, 9%, 0.85); z-index: 5;'>
                <div style='display: flex; height: 100vh; justify-content: center; align-items: center; flex-direction: column;'>
                    <h2 style='margin:0;'>Merci pour votre soumission!</h2>
                    <p>Votre message a été envoyé avec succès.</p>
                </div>
            </div>
            <script>
                var messageContainer = document.getElementById('message-container');
                messageContainer.addEventListener('click', function() {
                messageContainer.style.display = 'none';
                });
            </script>";
        } catch (Exception $e) {
            // Display an error message
            echo "Votre message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }
    }

// Function to sanitize input values
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
    include_once './header.php'
?>
    <section id="contact">
        <div class="contact-container">
            <form id="contact-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Contact</h1>
                <p>Besoin de renseignements ? <br> Nous répondons à toutes vos questions</p>
                <label for="firstName">Prénom</label>
                <input type="text" name="firstName" required>
    
                <label for="lastName">Nom</label>
                <input type="text" name="lastName" required>

                <label for="email">Email</label>
                <input type="email" name="email" required>

                <label for="message">Message</label>
                <textarea name="message" rows="5" required></textarea>
                <div class="btn-container">
                    <button class="btn-contact" type="submit" value="Envoyer">Envoyer</button>
                </div>
            </form>
        </div>
    </section>    
<?php
    include_once './footer.php'
?>
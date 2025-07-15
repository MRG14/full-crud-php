use PHPMailer\PHPMailer\PHPMailer;
//load composer autoloader
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
//server setting
$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'user@example.com';
$mail->Password = 'secret';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;

if (isset($_POST['kirim'])) {
    //receipents
    $mail->setFrom('tutormubatkno@gmail.com', 'Tutorial Muba Teknologi');
    $mail->addAddress($_POST['email_penerima']); //penerima
    $mail->addReplyTo('tutormubatekno@gmail.com', 'Tutor Muba Teknologi');

    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['pesan'];

    if ($mail->send()) {
        echo "<script>
                alert('Email Berhasil Terkirim');
                document.location.href = 'email.php'; 
                </script>";
    } else {
        echo "<script>
                alert('Email Gagal Terkirim');
                document.location.href = 'email.php';
                </script>";
    }
}
<?php
require_once("../../stripe/init.php"); 

\Stripe\Stripe::setApiKey("sk_test_51MS6goLwcdkoHZOtKOvrSCJh4T6HbpurRPlmbHVwLk2rR3kZaORXLVQ9hKaHdJW9E1k6082seOwqWH63C0UdAWQb00e9LEXGmW");

$token  = 'pk_test_51MS6goLwcdkoHZOt2KK1rotu8dEsbqiIgrN03b7OUwmunNrput0GP1T369gQXKbwp9yk3s6mFkMMkzXCe2godwnO00EwvZBKOO';
$email  = 'conilmarvin@gmail.com';

$customer = \Stripe\Customer::create(array(
    'email' => $email,
    'source'  => $token
));

$charge = \Stripe\Charge::create(array(
    'customer' => $customer->id,
    'amount'   => 500,
    'currency' => 'eur',
    'description' => 'Test de paiement Manga-K',
    'receipt_email' => $email  
));

echo '<h1>Payment accepted!</h1>';
?>
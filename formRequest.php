<?php

// use Aleksey\DeliveryService\Request\Request;
use Aleksey\DeliveryService\Orders\Orders;

// $request = new Request();
$now = new DateTime();
$connection = new mysqli('localhost', 'root', '', 'delivery_service');

// $name = $request->getRequest('FullName');
// $phone = $request->getRequest('phone');
// $orderDate = $now->format('Y-m-d H:i:s');
// $dietName = $request->getRequest('dietName');
// $deliveryStartDate = $request->getRequest('deliveryStartDate');
// $deliveryEndDate = $request->getRequest('deliveryEndDate');
// $deliverySchedule = $request->getRequest('deliverySchedule');
// $monday = $request->getRequest('monday');
// $tuesday = $request->getRequest('tuesday');
// $wednesday = $request->getRequest('wednesday');
// $thursday = $request->getRequest('thursday');
// $friday = $request->getRequest('friday');
// $saturday = $request->getRequest('saturday');
// $sunday = $request->getRequest('sunday');
// $comment = $request->getRequest('comment');

$name = $_POST['FullName'];
$phone = $_POST['phone'];
$orderDate = $now->format('Y-m-d H:i:s');
$dietName = $_POST['dietName'];
$deliveryStartDate = $_POST['deliveryStartDate'];
$deliveryEndDate = $_POST['deliveryEndDate'];
$deliverySchedule = $_POST['deliverySchedule'];
$monday = $_POST['monday'] ?? 'off';
$tuesday = $_POST['tuesday'] ?? 'off';
$wednesday = $_POST['wednesday'] ?? 'off';
$thursday = $_POST['thursday'] ?? 'off';
$friday = $_POST['friday'] ?? 'off';
$saturday = $_POST['saturday'] ?? 'off';
$sunday = $_POST['sunday'] ?? 'off';
$comment = $_POST['comment'];

$selectedDays = [];

$days = [
    'monday' => $monday, 
    'tuesday' => $tuesday,
    'wednesday' => $wednesday,
    'thursday' => $thursday,
    'friday' => $friday,
    'saturday' => $saturday,
    'sunday' => $sunday
];
foreach($days as $day => $value) {
    $value === 'on' ? array_push($selectedDays, $day) : $value;
}

$selectedDays = implode(', ', $selectedDays);

print_r("Выбранные дни: $selectedDays");

$result = $connection->query("INSERT INTO `subscriptions_history` (
    full_name,
    phone_num,
    order_creation_date,
    name_of_the_diet,
    start_of_delivery,
    end_of_delivery,
    delivery_schedule,
    selected_days,
    comment) VALUES (
        '$name',
        '$phone',
        '$orderDate',
        '$dietName',
        '$deliveryStartDate',
        '$deliveryEndDate',
        '$deliverySchedule',
        '$selectedDays',
        '$comment')");

if ($result) {
    echo json_encode(array('result' => 'success'));
    header("Refresh:0; url=success_order");
    exit();
} else {
    echo json_encode(array(
        'result' => 'failed',
        'error' => mysqli_error($connection)
    ));
}
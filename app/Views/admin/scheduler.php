<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2;URL='<?= base_url('/scheduler'); ?>'">
    <title>Scheduler Running...</title>
</head>
<body>
    Scheduler Currently Running.
    <hr>
    Frequently Sync: 10 Second.
    <hr>
    Last Sync On: <?= date('Y-m-d H:i:s'); ?>
    <hr>
    schedule configuration can only be changed on code
</body>
</html>
<!DOCTYPE html>

<body>

    <form action="<?= base_url('testlogic/export-coaching/process') ?>" method="POST">
        <input type="date" name="startdate" id="startdate" value="<?= date('Y-m-d'); ?>" required> -
        <input type="date" name="enddate" id="enddate" value="<?= date('Y-m-d', strtotime('tomorrow')); ?>" required>
        <button type="submit">Download Data </button>
    </form>

</body>

</html>
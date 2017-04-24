<?php if (!empty($notification)): ?>
<script>
    $(function () {
        $('.user-notification').slideDown(800).delay(6500).slideUp(800);
    });
</script>
<?php echo $notification['message'] ?>
<?php endif ?>

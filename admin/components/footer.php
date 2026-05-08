</div>
</div>

<script src="<?php echo ADMIN_URL; ?>dist/js/scripts.js"></script>
<script src="<?php echo ADMIN_URL; ?>dist/js/custom.js"></script>

<script src="<?php echo BASE_URL; ?>dist/js/iziToast.min.js"></script>
<!-- IZI TOAST/CUSTOM ALERT -->
<?php if (isset($_SESSION['error_message'])): ?>
    <script type="text/javascript">
        iziToast.error({
            message: '<?php echo $_SESSION['error_message']; ?>',
            position: 'topRight',
            timeout: 4000,
            color: 'red',
            icon: 'fa fa-times'
        });
    </script>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success_message'])): ?>
    <script type="text/javascript">
        iziToast.success({
            message: '<?php echo $_SESSION['success_message']; ?>',
            position: 'topRight',
            timeout: 3000,
            color: 'green',
            icon: 'fa fa-check'
        });
    </script>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
</body>

</html>
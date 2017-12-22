    <!-- Script JS-->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <?php if(isset($_SESSION) && isset($_SESSION['loggedin']) && $_SESSION['role'] == 1) { ?>
	<script type="text/javascript" src="js/customadmin.js"></script>
    <?php } ?>
</body>

</html>
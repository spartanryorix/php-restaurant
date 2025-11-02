<br><br><div class="card footer">
    <div class="row">
        <div class="col">
            <div>
                <h2><i class="bi bi-clock"></i></h2><h2 class="display-5">Store Hours</h2><br>
                <h5>Saturday - Thursday</h5>
                <p class="lead">10am - 10pm</p><br>
                <h5>Friday</h5>
                <p class="lead">Closed</p><br>
            </div>
        </div>
        <div class="col">
            <h2><i class="bi bi-geo-alt"></i></h2><h2 class="display-5">Address</h2><br>
            <p class="lead">6664, 4944 حرب بن ميمون الانصاري, Al Jisr, Al Khobar 34714</p>
        </div>
        <div class="col">
            <h2><i class="bi bi-telephone"></i></h2><h2 class="display-5">Phone</h2><br>
            <p>+966 50 996 2317</p>
        </div>
    </div>

    <?php include('store_hours/index.php') ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let bookedDates = <?php echo json_encode($bookedDates); ?>;
        flatpickr("#dateInput", {
            dateFormat: "Y-m-d H:i",
            enableTime: true,
            minDate: new Date().fp_incr(1)

        });
    });
</script>
</body>
</html>
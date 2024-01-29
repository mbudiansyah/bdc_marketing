<link rel="stylesheet" href="<?php echo base_url('assets/css/style_login.css') ?>">
<div class="container">
    <div class="">

        <div class="position-absolute top-50 start-50 translate-middle">

            <div class="card border-0 shadow">
                <span class="title fw-bold" style="color: #012970;">Bank Data Centre (BDC)</span>
                <div class="message fw-semibold text-danger" style="display: none;">

                </div>
                <form class="form" id="login" method="post" action="">
                    <div class="group">
                        <input placeholder="‎" type="text" required="" id="username" name="username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="group">
                        <input placeholder="‎" type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <button type="submit" class="fw-semibold" style="background-color: #012970;">Login</button>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#login').submit(function(e) {
            $(".message").html(``);

            e.preventDefault();
            // Menonaktifkan tombol submit
            $(this).find(':submit').prop('disabled', true);
            var t = $(this);
            var formData = new FormData(this);
            // formData.append('aa', 'xx');
            $.ajax({
                url: `<?php echo base_url('auth/login') ?>`,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $(this).find(':submit').prop('disabled', false);
                    if (response.listdata.redirect_url) {
                        window.location.href = response.listdata.redirect_url;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    t.find(':submit').prop('disabled', false);
                    var errorResponse = jqXHR.responseJSON;
                    console.log(errorResponse);
                    $(".message").show().append(`${errorResponse.message}`)
                }
            });
        });
    });
</script>
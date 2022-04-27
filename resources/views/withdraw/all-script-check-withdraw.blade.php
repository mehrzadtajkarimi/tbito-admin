<script>
    $(document).ready(function() {
        $('.form-check-wallet-btn').click(function(event) {
            event.preventDefault();

            var form = $(this).closest('.form-check-wallet');

            var resultsTagWithdraw = $('.ajax-check-wallet-withdraw-text');
            var resultHtmlWithdraw = "";

            resultsTagWithdraw.html("<img  class=' m-auto' width='5%' src='{{ asset('/admin/dist/img/loading-black.svg') }}' >");
            $.ajax({
                url: form.data('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    var status = response.data.status == true ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';

                    resultHtmlWithdraw +=
                        "<div>" +
                        "<span><i class='fas fa-caret-left fa-2x vertical-align m-3 '></i> بررسی وضعیت درخواست برداشت </span>" +
                        "<span>" + response.data.code + "</span>" +
                        "<span><sub class='text-muted'>/" + response.data.id + "</sub> :</span>" +
                        "<span> " + status + "</span>" +
                        "</div> " ;
                        if (response.data.status == false) {
                            resultHtmlWithdraw +=
                                "<div class='row '>" +
                                "<div class='col-12 mb-2'>" +
                                "<h5 class='ltr text-left'></h5>" +
                                "</div> " +
                                "<div class='col-12'>" +
                                "<div class='row'>" +
                                "<div class='col-2'>" +
                                "<label class='d-block mt-3'>مقــــدار رمز گشایی شده  : </label>" +
                                "</div> " +
                                "<div class='col-10'>" +
                                "<input type='text' class='form-control mt-2 ltr' value=" + response.data.decoded + " disabled>" +
                                "</div> " +
                                "</div> " +
                                "<div class='row'>" +
                                "<div class='col-2'>" +
                                "<label class='d-block mt-3'>مقــــدار فـــعلی : </label>" +
                                "</div> " +
                                "<div class='col-10'>" +
                                "<input type='text' class='form-control mt-2 ltr' value=" + response.data.plain + " disabled>" +
                                "</div> " +
                                "</div> " +
                                "</div> " +
                                "</div> ";
                        }

                    resultsTagWithdraw.html(resultHtmlWithdraw);

                    $('#checkWallet').modal('show')
                }
            });
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="checkWallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ajax-check-wallet-address">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.form-check-wallet-btn').click(function(event) {
            event.preventDefault();

            var self = $(this);
            self.addClass('btn-loading-black');
            var form = $(this).closest('.form-check-wallet');

            var resultsTagWithdraw = $('.ajax-check-wallet-address');
            var resultHtmlWithdraw = "";

            resultsTagWithdraw.html("<img  class=' m-auto' width='5%' src='{{ asset('/admin/dist/img/loading-black.svg') }}' >");
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {

                    resultsTagWithdraw.html('resultHtmlWithdraw');

                    $('#checkWallet').modal('show')
                },
                complete: function() {
                    self.removeClass('btn-loading-black');
                }
            });
        });
    });
</script>
<!-- مدال بررسی حساب -->
<div class="modal fade " id="checkWallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog   modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="ajax-check-wallet-withdraw-text"></div>
      <div class="modal-body">
        <div class="card-body">
          <table class="table table-bordered text-center shadow-sm table--vertical_middle ">
            <thead>
              <tr>
                <th>رمز ارز</th>
                <th>موجودی</th>
                <th>بلوکه</th>
                <th>رمز کیف پول</th>
                <th>رمز تراکنش ها</th>
              </tr>
            </thead>
            <tbody class="ltr ajax-check-wallet">


            </tbody>
          </table>
          <div class="list-group text-right  mt-4 ajax-check-wallet-text ">

          </div>
        </div>
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
      var form = self.closest('.form-check-wallet');
      var resultsTag = $('.ajax-check-wallet');
      var resultsTagText = $('.ajax-check-wallet-text');
      var resultHtml = "";
      var resultHtmlText = "";
      $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
          for (wallet in response.data.wallets) {
            // alert(response.data.wallets[1])
            var walletContent = response.data.wallets[wallet];
            var trColor = walletContent.status == true ? '#d6ffd6' : '#ffd5d5';
            var balanceCheck = walletContent.total_balance_check == true ? '<i class="fas fa-check text-success"></i>' : '<div><i class="fas fa-times text-danger"></i></div>';
            var blockedBalanceCheck = walletContent.blocked_balance_check == true ? '<i class="fas fa-check text-success"></i>' : '<div><i class="fas fa-times text-danger"></i></div>';
            var walletHashCheck = walletContent.wallet_hash_check == true ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
            var transactionHashCheck = walletContent.transaction_hash_check == true ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';

            resultHtml +=
              "<tr style='background-color:" + trColor + "'>" +


              "<td>" + walletContent.currency + "</td>" +

              "<td>" +
              "<div class='row '>" +
              "<div class='col-2 d-flex align-items-center justify-content-end'>" + balanceCheck + "</div>" +
              "<div class='col-7 text-right'>" +
              "<div>" + walletContent.total_balance + "</div>" +
              "<div>" + walletContent.tradable_balance + "</div>" +
              "<div>" + walletContent.blocked_balance + "</div>" +
              "<div>" + walletContent.total_balance_difference + "</div>" +
              "</div>" +
              "<div class='col-3 text-right'>" +
              "<div>: کــل </div>" +
              "<div>: آزاد </div>" +
              "<div>: بلوکه </div>" +
              "<div>: مغایرت </div>" +
              "</div>" +
              "</div>" +
              "</td>" +

              "<td>" +
              "<div class='row '>" +
              "<div class='col-2 d-flex align-items-center justify-content-end'>" + blockedBalanceCheck + "</div>" +
              "<div class='col-6 text-right'>" +
              "<div>" + walletContent.order_blocked_balance + "</div>" +
              "<div>" + walletContent.withdraw_blocked_balance + "</div>" +
              "<div>" + walletContent.total_blocked_balance + "</div>" +
              "<div>" + walletContent.blocked_balance_difference + "</div>" +
              "</div>" +
              "<div class='col-4 text-right'>" +
              "<div>: سفارش </div>" +
              "<div>: برداشت </div>" +
              "<div>: بلوکه </div>" +
              "<div>: مغایـرت </div>" +
              "</div>" +
              "</div>" +
              "</td>" +

              "<td>" + walletHashCheck + "</td>" +

              "<td>" + transactionHashCheck + "</td>" +


              "</tr>";



          }
          for (text in response.data.text) {
            resultHtmlText += "<div class='list-group-item shadow-sm'><bdi>" + response.data.text[text] + "</bdi></div>";
          }
          if (response.data.hash_errors) {
            resultHtmlText += "<span><i class='fas fa-caret-left fa-2x vertical-align m-3'></i>مغایرت رمزها</span>";
            for (text in response.data.hash_errors) {
              resultHtmlText +=
                "<div class='row'>" +
                "<div class='col-12 mt-4'>" +
                "<h5 class='ltr text-left '>" + text + "</h5>" +
                "</div> " +
                "<div class='col-12'>" +
                "<div class='row'>" +
                "<div class='col-2'>" +
                "<label class='d-block mt-3'>مقدار رمز گشایی شده : </label>" +
                "</div> " +
                "<div class='col-10'>" +
                "<input type='text' class='form-control mt-2 ltr' placeholder=" + response.data.hash_errors[text].decrypted + " disabled>" +
                "</div> " +
                "<div class='col-2'>" +
                "<label class='d-block mt-3'>مقــــدار فـــعلی : </label>" +
                "</div> " +
                "<div class='col-10'>" +
                "<input type='text' class='form-control mt-2 ltr' placeholder=" + response.data.hash_errors[text].plain + " disabled>" +
                "</div> " +
                "</div> " +
                "</div> " +
                "</div> ";
            }
          }
          resultsTag.html(resultHtml);
          resultsTagText.html(resultHtmlText);

          $('#checkWallet').modal('show')
        },
        complete: function() {
          self.removeClass('btn-loading-black');
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('.form-show-trade-btn').click(function(event) {
      event.preventDefault();
      var form = $(this).closest('.form-show-trade');
      var marketImage = form.closest("tr").find(".market_image").html();
      var resultsTag = $('#ajax-show-trade');
      var resultsTagImage = $('#ajax-show-trade-image');
      var resultHtml = "";
      var resultHtmlImage = "";

      resultsTag.html("<img  class='rounded mx-auto d-block' src='{{ asset('/admin/dist/img/loading-black.svg') }}' >");
      $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
          for (item in response) {
            var tradeContent = response[item];
            resultHtml += "<tr>";
            resultHtml += "<td><a href=" + tradeContent.user_buyer_profile + "  target='_blank' >" + tradeContent.user_buyer + "</a></td>";
            resultHtml += "<td>" + tradeContent.amount + "</td>";
            resultHtml += "<td>" + tradeContent.price + "</td>";
            resultHtml += "<td>" + tradeContent.created_at + "</td>";
            resultHtml += "<td><a href=" + tradeContent.user_seller_profile + "  target='_blank'>" + tradeContent.user_seller + "</a></td>";
            resultHtml += "</tr>";
          }
          // resultHtmlImage += "<img class='ml-2 position-relative ' style='right: 11px;' src='{{ asset('/admin/dist/img/currency_photo/"+response[1][0]+".png') }}>" +
          // "<img class='ml-2 position-relative ' style='left: 11px;' src='{{ asset('/admin/dist/img/currency_photo/"+response[1][1]+".png') }}>"
          // console.log(resultHtmlImage);

          resultsTag.html(resultHtml);
          resultsTagImage.html(marketImage);
        },
      });
    });
  });
</script>
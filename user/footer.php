<div class="py-2">
  <div class="container">
    
    <div class="row"></div>
  </div>
</div>

<footer class="page-footer font-small pt-4 pb-0 footer-border">

  <div class="container text-center text-md-left">
    <div class="row">
      <div class="col-md-5 col-lg-2 text-center mx-auto my-4">
          <ul class="list-unstyled mt-5">
            <li>
              <p><i class="fa fa-map-marker" aria-hidden="true" style="font-size:30px;"></i><br> Tokyo, JAPAN</p>
            </li><br>
            <li>
              <p><i class="fas fa-envelope mr-3" style="font-size:30px;"></i><br>xxxxxx@gmail.com</p>
            </li><br>
            <li>
              <p><i class="fas fa-phone mr-3" style="font-size:30px;"></i><br> + 01 234 567 88</p>
            </li><br>
          </ul>
      </div>

      <div class="">
        <img src="images/jenny_footer.png" alt="footer" style="width:500px; height:500px;">
      </div>

      <div class="col-md-5 col-lg-2 text-center mx-auto my-4">
        <div class="container mt-5">
          <!--twitter-->
          <a class="btn-social-square btn-social-square--twitter" href="https://twitter.com/jenny_kaori" target="_blank">
              <i class="fab fa-twitter"></i>
          </a><br><br><br>
          <!--instagram-->
          <a class="btn-social-square btn-social-square--instagram" href="https://www.instagram.com/jenny_kaori/" target="_blank">
              <span class="insta">
                  <i class="fab fa-instagram"></i>
              </span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
  Copyright © Jennyhouse / Jennykaori  All Rights Reserved.
  </div>

</footer>
<!-- Footer -->


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- edit profile photo -->
  <script>
    $("#edit-profile-photo").click(function(e){
      var id = $(this).data('id');
      $.get(
        'edit.php?id=' + id,
        function(data) {
          $("#editProfilePhoto").html(data);
        }
      )
    })

    $("#quantity").change(function(e){
      var max_quantity = $("#quantity").attr("max");
      if($("#quantity").val() < max_quantity) {
        $(this).val(max_quantity);
      }
      else if($("#quantity").val() < 1) {
        $(this).val("1");
      } else {
        console.log();
      }
    })

    $("#quantity").change(function(e){
      var quantity = $(this).val();
      // console.log(quantity)
      $("#get_qty").val(quantity);
    })


    $(".cartitem_qty").change(function(e){
      var cart_id = $(this).data('id');
      var quantity = $(this).val();
      var cartitem_id = $(".cartitem_id_" + cart_id).val();
      var item_id = $(".item_id_" + cart_id).val();
      $.ajax({
        type: "POST",
        url: "action.php?action=CHANGE_QTY",
        data: {qty: quantity, ci_id: cartitem_id, item_id: item_id},
      }).done(function(data) {
        // console.log(data);
        window.location.reload();
      })
    })

  </script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1b7941b15e.js"></script>

</html>
<!-- Début code pour message de validation -->
<div id="message" data-aos="fade-left" data-aos-duration="500">
  <button type="button" class="btn-close" onclick="CloseMsg()"></button>
  <p id="ParaMess">...</p>
</div>

<script>
  const div = document.getElementById('message');


  if (<?php echo isset($_COOKIE['message']) ? 'true' : 'false'; ?>) {
    div.style.display = "flex";

    if (<?php echo isset($_GET['e']) ? 'true' : 'false'; ?>) {
      div.style.background = "#d34d4d";
    } else {
      div.style.background = "#50B141";

    }


    document.getElementById('ParaMess').innerHTML = "<?php echo $_COOKIE['message'] ?>";

  } else {
    div.style.display = "flex";

    document.getElementById('ParaMess').innerHTML = "vvv";

  }


  function CloseMsg() {
    document.cookie = "message= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
    div.style.display = "none";

  }
</script>
<!--  Fin code pour message de validation -->
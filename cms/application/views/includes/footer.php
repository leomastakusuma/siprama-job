<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $js;?>jquery.cookie.js"></script>
<script>
var notifsukses = "<?php echo  $this->session->userdata("notifsukses"); ?>";
var notiferror = "<?php echo  $this->session->userdata("notiferror"); ?>";
function addusers()
{
	$( "#panel1" ).toggle();
	$( "#panel2" ).toggle();
}

// A $( document ).ready() block.
$( document ).ready(function() {
  $('form').prepend('<input type="hidden"  name="<?=$this->csrf['name'];?>" value="'+$.cookie('csrf_cookie_name')+'">');
	if(notifsukses)
	{
		Command: toastr["success"](notifsukses)

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
<?php unset($_SESSION['notifsukses']); ?>
	}
	if(notiferror)
	{
		Command: toastr["error"](notiferror)

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
<?php unset($_SESSION['notiferror']); ?>
	}
});

function konfirmasi_cancel(halaman) {
    var txt;
    var r = confirm("Data yang anda input belum tersimpan.\nAnda yakin ingin keluar?");
    if (r == true) {
        window.location = halaman;
    } else {
//akutes
    }
    document.getElementById("demo").innerHTML = txt;
}

function konfirmasi_hapus() {

    var r = confirm("Data yang dihapus tidak dapat ditampilkan lagi.\nAnda yakin ingin menghapus?");
    if (r == true) {
		return true;
    } else {
return false;
    }
}
function konfirmasi_reset(user) {

    var r = confirm("Anda akan mereset password user "+user+".\nLanjutkan?");
    if (r == true) {
		return true;
    } else {
				return false;
    }
}

</script>
<footer class="site-footer">
    <div class="text-center">
         2016&copy; Recruitment System Siprama Cakrawala<br>Powered&reg; by MYR Inc.
        <a href="#" class="go-top">
            <i class="icon-angle-up"></i>
        </a>
    </div>
</footer>

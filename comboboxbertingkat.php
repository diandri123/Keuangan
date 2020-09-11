<?php
    include "conn.php";
?>

<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
Provinsi : <select name="provinsi" id="provinsi">
    <option value="">- Pilih Tempat -</option>
   
    <!-- looping data provinsi -->
    <?php
    $sel_prov="select * from provinsi";
    $q=mysql_query($sel_prov);
    while($data_prov=mysql_fetch_array($q)){
   
    ?>
        <option value="<?php echo $data_prov["id_prov"] ?>"><?php echo $data_prov["nm_prov"] ?></option>
   
    <?php
    }
    ?>
</select>

    &nbsp;&nbsp;&nbsp;<img src="loader.gif" width="10px" height="10px" id="imgLoad" style="display:none">
    <br>
    <br>
Kota : <select name="kota" id="kota">
    <!-- hasil data dari cari_kota.php akan ditampilkan disini -->
</select>

<script>
   
    $("#provinsi").change(function(){
   
        // variabel dari nilai combo box provinsi
        var id_provinsi = $("#provinsi").val();
       
        // tampilkan image load
        $("#imgLoad").show("");
       
        // mengirim dan mengambil data
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "cari_kota.php",
            data: "prov="+id_provinsi,
            success: function(msg){
               
                // jika tidak ada data
                if(msg == ''){
                    alert('Tidak ada data Kota');
                }
               
                // jika dapat mengambil data,, tampilkan di combo box kota
                else{
                    $("#kota").html(msg);                                                     
                }
               
                // hilangkan image load
                $("#imgLoad").hide();
            }
        });    
    });
</script>
<?php
    function MyleaBaglog($KodeProduksi, $MyleaBaglog){
    ?>
        <td>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightBaglog<?php echo $KodeProduksi;?>" aria-controls="offcanvasRight">Baglog</button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightBaglog<?php echo $KodeProduksi;?>" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Baglog <?php echo $KodeProduksi;?></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php
                foreach($MyleaBaglog[$KodeProduksi] as $data){
                    echo $data['KodeBaglog']. ' :'. $data['Jumlah'];
                }
                ?>
            </div>
            </div>
        </td>
<?php
    }

?>
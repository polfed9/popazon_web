<div class="row">
    <h2 class="text-center col-12 mt-2">Notifiche</h2>
</div>
<div class="row">
    <div class="col-12 col-md-3 border-right border-dark ">
        <div class="tab-content m-3 bg-white">
            <div class="panel panel-default shadow">
                <div class="panel-body" data-type="nGenerale">
                    <div class="list-group">
                        <?php foreach($templateParams["notifiche"] as $notifica): ?>
                            <button type="button" class="list-group-item text-left <?php if($notifica["stato"]==1){echo "text-secondary";}?>" data-id="<?php echo $notifica["id"]?>" aria-label="notifica">
                                <div class="text-truncate font-weight-bold">Mittente: <?php echo $notifica["mittente"]?></div>
                                <div>Oggetto: <?php echo $notifica["oggetto"]?></div>
                                <div>Preview: <?php echo $notifica["preview"]?></div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9 border-dark d-none d-md-block ">
    <span class='fas d-md-none d-block mb-4' title="torna alla lista di notifiche">&#xf104;</span>
        <div class="tab-content m-3 bg-white">
            <div class="panel panel-default shadow">
                <div class="panel-body text-center text-muted p-3"  data-type="nSpecifica">
                    <span class="fa"> &#xf0f3;</span>
                    <h4 class="mb-3">Seleziona una notifica per aprirla</h4>
                </div>
            </div>
        </div>
    </div>
</div>
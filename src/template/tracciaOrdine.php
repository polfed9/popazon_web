<div class="container py-5 ">

    <?php foreach ($templateParams["statiRimanenti"] as $prodotti) : ?>
        <?php $exp_id = explode(",", $prodotti); ?>
    <?php endforeach ?>
    <article class="card-order bg-light shadow">
        <header class="card-header"> Tracciamento dell'ordine </header>
        <div class="card-body">
            <h3>Ordine Numero: <?php echo "#" . $templateParams["nOrdine"] ?></h3>
            <article class="card">
                <div class="card-body row">
                    <div class="col-12 col-md-4"> <strong>Consegna Stimata per il:</strong> <br><?php echo (new DateTime(substr_replace($templateParams["track"][0]["data"],"",-9)))->add(new DateInterval('P10D'))->format('d-m-Y');?> </div>
                    <div class="col-12 col-md-4"> <strong>Inviato da:</strong> <br>admin@email.com </div>
                    <div class="col-12 col-md-4"> <strong>Stato Attuale:</strong> <br> <?php echo $templateParams["stato"] ?> </div>
                </div>
            </article>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <article class="card-track no-border">
                        <table class="table track_tbl no-border p-0 m-0">
                            <thead>
                                <tr class="" data-visible="false">
                                    <th scope="col" id="pallino" class="w-10"></th>
                                    <th scope="col" id="stato" class="w-45"></th>
                                    <th scope="col" id="data" class="w-45"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($templateParams["track"] as $info) : ?>
                                    <tr class="">
                                        <td class="track_dot_active">
                                            <span class="track_line"></span>
                                        </td>
                                        <td class="font-weight-bold" headers="stato ordine <?php echo $info["nome"] ?> "><?php echo $info["nome"] ?></td>
                                        <td class="font-weight-bold" headers="data ordine<?php echo $info["data"] ?> "><?php echo (new DateTime(substr_replace($info["data"],"",-9)))->format('d-m-Y') ?></td>
                                    </tr>
                                <?php endforeach ?>

                                <?php foreach ($exp_id as $stato) : ?>
                                    <tr>
                                        <td class="track_dot">
                                            <span class="track_line"></span>
                                        </td>
                                        <td><?php echo $stato ?></td>
                                        <td></td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    </article>
                </div>
            </div>
        </div>
    </article>
    <br></br>
    <table class="table table-bordered shadow">
        <thead class="thead-dark">
            <tr>
                <th class="w-30" id="nome">Nome prodotto</th>
                <th class="w-10" id="quantita">Quantità</th>
                <th class="w-30" id="prezzo">Prezzo</th>
                <th class="w-30" id="totale">Totale</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <?php if (!empty($templateParams["prodotti"])) {
                $total = 0;
                foreach ($templateParams["prodotti"] as $prodotti) { ?>
                    <tr>
                        <td><?php echo $prodotti["nome"]; ?></td>
                        <td><?php echo $prodotti["qt"]; ?></td>
                        <td><?php echo $prodotti["prezzo"]; ?> €</td>
                        <td><?php echo number_format($prodotti["qt"] *  $prodotti["prezzo"], 2); ?> €</td>
                    </tr>
                <?php $total = $total + ($prodotti["qt"] * $prodotti["prezzo"]);
                } ?>
                <tr>
                    <td colspan="3" align="right">Totale</td>
                    <td align="right"><?php echo number_format($total, 2); ?> €</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
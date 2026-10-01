<div class="row">
    <div class="col-12 col-md-6 border-right border-dark ">
        <h2 class="text-center mt-2">Categorie principali</h2>
        <div class="tab-content m-3 bg-white p-3 shadow">
            <div class="panel panel-default ">
                <div class="panel-body" data-cat-type="P">
                    <label for="categoriaPselezionata">Cat. selezionata: </label>
                    <input type="text" name="categoriaPselezionata" id="categoriaPselezionata" data-cat-type="P"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Edit-icon.png" alt="modifica" data-catP-type="modifica"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Save-As-icon.png" alt="salva modifiche" data-catP-type="salva"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Editing-Delete-icon.png" alt="elimina" data-catP-type="elimina"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Programming-Show-Property-icon.png" alt="mostra categorie specifiche" data-catP-type="mostraS" class="d-md-none"/>
                    <div class="list-group my-4" data-cat-type="P">
                        <?php foreach($templateParams["catP"] as $catP):?>
                            <button type="button" class="list-group-item list-group-item-action" data-cat-type="P"><?php echo $catP["titolo"]; ?></button>
                        <?php endforeach ?>
                    </div>
                    <label for="nuovaCatP">Nuova cat: </label>
                    <input type="text" name="nuovaCatP" id="nuovaCatP"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Add-icon.png" alt="aggiungi" data-catP-type="aggiungi" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 border-left border-dark d-none d-md-block">
        <h2 class="text-center mt-2">Categorie specifiche</h2>
        <div class="tab-content m-3 bg-white p-3 shadow">
            <div class="panel panel-default">
                <div class="panel-body"  data-cat-type="S">
                    <label for="categoriaSselezionata">Cat. selezionata: </label>
                    <input type="text" name="categoriaSselezionata" id="categoriaSselezionata"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Edit-icon.png" alt="modifica" data-catS-type="modifica"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Save-As-icon.png" alt="salva modifiche" data-catS-type="salva"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Editing-Delete-icon.png" alt="elimina" data-catS-type="elimina"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Programming-Show-Property-icon.png" alt="mostra categorie principali" data-catP-type="mostraP" class="d-md-none"/>
                    <div class="list-group my-4" data-cat-type="S">
                        <!--ajax-->
                    </div>
                    <label for="nuovaCatS">Nuova cat: </label>
                    <input type="text" name="nuovaCatS" id="nuovaCatS"/>
                    <img src="<?php echo UPLOAD_DIR;?>icone/Add-icon.png" alt="aggiungi" data-catS-type="aggiungi"/>
                </div>
            </div>
        </div>
    </div>
</div>
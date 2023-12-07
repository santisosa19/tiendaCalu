<div class="container is-fluid mb-6">
    <h1 class="title">Ventas</h1>
    <h2 class="subtitle"><i class="fas fa-search-dollar fa-fw"></i> &nbsp; Buscar ventas por código</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    
        use app\controllers\saleController;
        $insVenta = new saleController();

        if(!isset($_SESSION["fechaDesde"]) && empty($_SESSION["fechaDesde"])&&!isset($_SESSION["fechaHasta"]) && empty($_SESSION["fechaHasta"])){
    ?>
    <div class="columns">
        <div class="column">
            <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/buscadorAjax.php" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="buscar">
                <input type="hidden" name="modulo_url" value="<?php echo $url[0]; ?>">
                <div class="columns ml-6">
                    <div class="column">
                        <!-- <input class="input is-rounded" type="text" name="txt_buscador" placeholder="Código de venta" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\- ]{1,30}" maxlength="30"> -->
                        <div class="control">
                            <input class="input is-rounded" type="date" name="fechaDesde" id="fechaDesde">
                        </div>
                    </div>
                    <div class="column">
                        <div class="control">
                            <input class="input is-rounded" type="date" name="fechaHasta" id="fechaHasta">
                        </div> 
                    </div>
                    <div class="column">
                        <div class="control">
                            <button class="button is-info" type="submit" >Buscar</button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6 FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/buscadorAjax.php" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="eliminar">
                <input type="hidden" name="modulo_url" value="<?php echo $url[0]; ?>">
                <p><i class="fas fa-search fa-fw"></i> &nbsp; Estas buscando por fecha de: <strong>“<?php echo $_SESSION["fechaDesde"]; ?> a <?php echo $_SESSION["fechaHasta"]; ?>”</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded"><i class="fas fa-trash-restore"></i> &nbsp; Eliminar busqueda</button>
            </form>
        </div>
    </div>
    <?php
            echo $insVenta->listarVentaControlador($url[1],15,$url[0],$_SESSION["fechaDesde"],$_SESSION["fechaHasta"]);

            include "./app/views/inc/print_invoice_script.php";
        }
    ?>
</div>
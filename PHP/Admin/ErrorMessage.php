<!-- Modal pour les messages d'erreur d'ajout-->
<div class="modal fade" id="errorModalAdd" tabindex="-1" aria-labelledby="errorModalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalAddLabel">Error in adding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorMessagesAdd">
                <!-- Les messages d'erreur seront injectés ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#">Close</button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal">Return</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if (!empty($_SESSION['errorsAdd'])): ?>
            // Convertit les messages d'erreur PHP en HTML
            var errorsHtml = "<?php echo implode('<br>', $_SESSION['errorsAdd']); ?>";
            document.getElementById('errorMessagesAdd').innerHTML = errorsHtml;

            // Affiche la modal d'erreur
            var errorModaladd = new bootstrap.Modal(document.getElementById('errorModalAdd'));
            errorModaladd.show();

            // Efface les messages d'erreur de la session pour éviter l'affichage répétitif
            <?php unset($_SESSION['errorsAdd']); ?>
        <?php endif; ?>
    });
</script>




<!-- Modal pour les messages d'erreur de changements -->
<div class="modal fade" id="errorModalchange" tabindex="-1" aria-labelledby="errorModalchangeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="errorModalchangeLabel">Error in changes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="errorMessageschange">
            <!-- Les messages d'erreur sont affichés ici -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#">Close</button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modifyModal">Return</button>
        </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if (!empty($_SESSION['errorschange'])): ?>
            // Convertit les messages d'erreur PHP en HTML
            var errorsHtml = "<?php echo implode('<br>', $_SESSION['errorschange']); ?>";
            document.getElementById('errorMessageschange').innerHTML = errorsHtml;

            // Affiche la modal d'erreur
            var errorModalChange = new bootstrap.Modal(document.getElementById('errorModalchange'));
            errorModalChange.show();

            // Efface les messages d'erreur de la session pour éviter l'affichage répétitif
            <?php unset($_SESSION['errorschange']); ?>
        <?php endif; ?>
    });
</script>
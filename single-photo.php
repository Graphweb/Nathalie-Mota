<?php
// Récupérer les valeurs des champs SCF
$type = SCF::get('type'); // Champ "Type"
$reference = SCF::get('reference'); // Champ "Référence"

// Afficher les valeurs
?>
<p>Type : <?php echo esc_html($type); ?></p>
<p>Référence : <?php echo esc_html($reference); ?></p>

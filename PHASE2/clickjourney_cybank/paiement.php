<h2>Redirection vers CYBank</h2>
<form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
  <input type="hidden" name="transaction" value="<?= $transaction ?>">
  <input type="hidden" name="montant" value="<?= $montant ?>">
  <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
  <input type="hidden" name="retour" value="<?= $retour ?>">
  <input type="hidden" name="control" value="<?= $control ?>">
  <input type="submit" value="Payer avec CYBank">
</form>

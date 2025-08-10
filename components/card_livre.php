<div class="card border-0 shadow hvr-shadow-radial"  style="width: 18rem;">
  <img src="<?= BASE_URL . $value['image']; ?>" class="card-img-top card-img" 
  alt="<?= $value['nom']; ?>" style="height: 200px; object-fit: cover;" usemap="#map<?= $value['id']; ?>">
  <map name="map<?= $value['id']; ?>">
    <area shape="rect" coords="0,0,300,200" href="<?= BASE_URL ?>livre_one.php?id=<?= $value['id']; ?>"
     <?= $value['status'] == "0" ? 'aria-disabled="true" onclick="return false;"' : "" ?>>
  </map>
  <div class="card-body">
      <h5 class="card-title"><?= $value['nom']; ?></h5>
      <p class="card-text"><?= $value['nom_categorie']; ?> </p>
      <p class="card-text"><?= $value['nom_s_categorie']; ?></p>
        <p class="card-text"><?= $value['nom_s_s_categorie']; ?></p>
        <p class="card-text"><?= $value['nom_s_s_s_categorie']; ?></p>
  </div>
</div>
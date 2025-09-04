<div class="card border-0 shadow hvr-shadow-radial"  style="width: 18rem;">
  <img src="<?= BASE_URL . 'uploads/' . $value['nom_path'] . '/' . $value['image']; ?>" class="card-img-top 
  card-img" alt="<?= $value['titre'];?>" style="height: 200px; object-fit: cover;" usemap="#map<?= $value['id'];?>">
  <map name="map<?= $value['id']; ?>">
    <area shape="rect" coords="0,0,300,200" href="<?= BASE_URL ?>livre_one.php?id=<?= $value['id']; ?>">
  </map>
  <div class="card-body">
      <h4 class="card-title"><?= $value['titre']; ?></h5>
      <h5 class=""><?= $value['nom_categorie']; ?> </h5>
      <p class="card-text"><?= $value['nom_s_categorie']; ?></p>
        <p class="card-text"><?= $value['nom_s_s_categorie']; ?></p>
        <p class="card-text"><?= $value['nom_s_s_s_categorie']; ?></p>
  </div>
</div>
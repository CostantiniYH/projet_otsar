<?php
require_once __DIR__ . '/../controllers/session.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../class/navbar.php';
require_once __DIR__ . '/../class/carousel.php';

//require_login();


$navbar = new Navbar();
$navbar->AddItem(' אוצר','index.php', 'left', '', 'bi bi-book-half rounded-5 text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-left" title="אוצר הספרים');
$navbar->AddItem('','index.php','center', '', 'bi bi-house-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Accueil');
if (isLoggedIn()) {
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','dropdown');    
    $navbar->AddItem('גמרא','Talmud/1_talmud.php','dropdown');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'dropdown', true);
    $navbar->AddItem('מוסר', 'Agada-moussar/3_mousar.php', 'dropdown');    
    $navbar->AddItem('', 'Admin/dashboard.php', 'center', '', 'bi bi-kanban" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Tableau de bord');
    $navbar->AddItem('', 'Form/Create-Update/image.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Form/Create-Update/categorie.php', 'center', '', 'bi bi-image" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter une image');
    $navbar->AddItem('', 'Form/Create-Update/livre.php', 'center', '', 'bi bi-book-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Ajouter un livre');
    $navbar->AddItem('', 'javascript:location.replace(BASE_URL + "logout.php")', 'right', '', 'bi bi-door-open-fill rounded-5" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-red" title="Déconnexion');
} else {
    $navbar->AddItem('תורה', 'Torah/0-1_torah.php', 'dropdown');
    $navbar->AddItem('נך', 'Torah/0-2_nak.php', 'dropdown');
    $navbar->AddItem('תלמוד בבלי', 'Talmud/1-1_babli.php', 'dropdown');
    $navbar->AddItem('תלמוד ירושלמי', 'Talmud/1-2_yerouchalmi.php', 'dropdown');
    $navbar->AddItem('','livres.php','center', '', 'bi bi-book" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip" title="Liste des livres');
    $navbar->AddItem('תנ"ך','Torah/0_tanak.php','center');
    $navbar->AddItem('גמרא','Talmud/1_talmud.php','center');
    $navbar->AddItem('הלכה', 'Halakha/2_halaka.php', 'center', true);
    $navbar->AddItem('מוסר', 'Agada-Moussar/3_mousar.php', 'center');
    $navbar->AddItem('','Form/Compte/login.php','right', '', 'bi bi-person-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="super-tooltip-right" title="Connexion');
    $navbar->AddItem('Inscription','Form/Compte/register.php', 'right');
    }
$navbar->render() ;
?>
<div class="container mb-5 mt-5">
    <?php
        require_once __DIR__ . '/../components/alerts.php';
    ?>

    <h1 class="shadow rounded-4 border border-bottom-0 border-3 border-primary"
     data-aos="fade-up" data-aos-duration="1500">הלכה</h1>    

    <div class="row">     
        <div class="col-md-6  img-map d-flex mt-5" data-aos="fade-up" data-aos-duration="1500">
            <img src="<?= BASE_URL ?>uploads/Halakha/choulhan-arouk.jpg" class="card-img rounded-4 shadow size-img" alt="שולחן ערוך" usemap="#map_4">
            <map name="map_4">
                <area shape="rect" coords="0, 0, 600,400" alt="שולחן ערוך" href="<?= BASE_URL ?>Halakha/choulhanAroukh.php">
            </map>
        </div>
        <div class="col-md-6  img-map d-flex mt-5" data-aos="fade-up" data-aos-duration="1500">
            <img src="<?= BASE_URL ?>uploads/Halakha/tour.jpg" class="card-img rounded-4 shadow  size-img" alt="טור" usemap="#map_5">
            <map name="map_5">
                <area shape="rect" coords="0, 0, 600,400" alt="טור" href="<?= BASE_URL ?>Halakha/tour.php">
            </map>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12 img-map mt-5" data-aos="fade-up" data-aos-duration="1500">
            <img src="<?= BASE_URL ?>uploads/Halakha/michnei-torah.jpg" class="card-img rounded-4 shadow  size-img" alt="רמב''ם" usemap="#map_6">
            <map name="map_6">
                <area shape="rect" coords="0, 0, 1200,400" alt="רמב''ם" href="<?= BASE_URL ?>Halakha/rambam.php">
            </map>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 d-flex" data-aos="fade-right" data-aos-duration="1500">
            <div class="card shadow rounded-4 border border-3 border-primary mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center">רמב"ם</h3>
                    <p class="card-text">הוא רבי משה בן מימון, אחד מגדולי הפוסקים והפילוסופים היהודים של ימי הביניים. נולד בקורדובה שבספרד בשנת 1135 ונפטר בקהיר בשנת 1204. רמב"ם היה רב, רופא, פילוסוף ומדען, וכתב מספר יצירות חשובות בתחומים שונים.</p>
                    <p class="card-text">היצירה המפורסמת ביותר של רמב"ם היא "משנה תורה", שהיא קודקס הלכתי מקיף המכסה את כל תחומי ההלכה היהודית. היצירה מחולקת ל-14 ספרים, וכל ספר עוסק בנושא מסוים, כגון תפילה, שבת, כשרות, נישואין ועוד. "משנה תורה" נחשבת לאחת היצירות המרכזיות בהלכה היהודית ומשמשת בסיס ללימוד והלכה עד היום.</p>
                    <p class="card-text">מלבד "משנה תורה", רמב"ם כתב גם את "מורה נבוכים", יצירה פילוסופית שמטרתה להסביר את עקרונות האמונה היהודית ולהתמודד עם שאלות פילוסופיות ותיאולוגיות. היצירה נכתבה בספרדית יהודית (לאדינו) ומיועדת לקהל רחב של קוראים.</p>
                    <p class="card-text">רמב"ם השפיע רבות על ההלכה היהודית והפילוסופיה היהודית, והשפעתו ניכרת עד היום. הוא נחשב לאחד מהפוסקים הגדולים ביותר בהיסטוריה היהודית, ויצירותיו ממשיכות להיות נלמדות ומוערכות בקהילות יהודיות ברחבי העולם.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex" data-aos="fade-left" data-aos-duration="1500">
            <div class="card shadow rounded-4 border border-3 border-primary mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center">שולחן ערוך</h3>
                    <p class="card-text">הוא קודקס הלכתי יהודי שנכתב על ידי רבי יוסף קארו במאה ה-16. היצירה מחולקת לארבעה חלקים עיקריים, שכל אחד מהם עוסק בתחום מסוים של ההלכה היהודית:</p>
                    <ul>
                        <li><strong>אורח חיים:</strong> עוסק בדיני התפילה, השבת, החגים, הכשרות והמנהגים היומיומיים</li>
                        <li><strong>יורה דעה:</strong> עוסק בדיני טהרה, נידה, ברית מילה, נישואין וגירושין</li>
                        <li><strong>אבן העזר:</strong> עוסק בדיני בית הדין, עדות, גזירות והלכות שונות הקשורות לחברה ולמשפט</li>
                        <li><strong>חושן משפט:</strong> עוסק בדיני ממונות, חוזים, ירושות ודיני מסחר</li>
                    </ul>
                    <p class="card-text">השולחן ערוך נחשב לאחת היצירות המרכזיות בהלכה היהודית ומשמש בסיס ללימוד והלכה עד היום. היצירה
                    נכתבה בספרדית יהודית (לאדינו) ומיועדת לקהל רחב של קוראים. השולחן ערוך זכה לפרשנויות והערות רבות לאורך השנים, והפך לכלי חשוב בלימוד ההלכה בקהילות יהודיות ברחבי העולם.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12 d-flex" data-aos="fade-up" data-aos-duration="1500">
            <div class="card shadow rounded-4 border border-3 border-primary mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center">טור</h3>
                    <p class="card-text">הוא קודקס הלכתי יהודי שנכתב על ידי רבי יעקב בן אשר במאה ה-14. היצירה מחולקת לארבעה חלקים עיקריים, שכל אחד מהם עוסק בתחום מסוים של ההלכה היהודית:</p>
                    <ul>
                        <li><strong>אורח חיים:</strong> עוסק בדיני התפילה, השבת, החגים, הכשרות והמנהגים היומיומיים</li>
                        <li><strong>יורה דעה:</strong> עוסק בדיני טהרה, נידה, ברית מילה, נישואין וגירושין</li>
                        <li><strong>אבן העזר:</strong> עוסק בדיני בית הדין, עדות, גזירות והלכות שונות הקשורות לחברה ולמשפט</li>
                        <li><strong>חושן משפט:</strong> עוסק בדיני ממונות, חוזים, ירושות ודיני מסחר</li>
                    </ul>
                    <p class="card-text">הטור נחשב לאחת היצירות המרכזיות בהלכה היהודית ומשמש בסיס ללימוד והלכה עד היום. היצירה נכתבה בארמית ומיועדת לקהל רחב של קוראים. הטור זכה לפרשנויות והערות רבות לאורך השנים, והפך לכלי חשוב בלימוד ההלכה בקהילות יהודיות ברחבי העולם.</p>
                </div>
            </div>  
        </div>
    </div>


</div>
<?php
require_once __DIR__ . '/../components/footer.php';
?>
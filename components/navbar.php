<!-- <nav class="navbar navbar-expand-lg shadow"  data-aos="fade-down" data-aos-duration="1000">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>';     


        <div class="navbar-brand">
        $this->renderItems($this->leftItems);
        </div>

        if ($this->dropdownItems) {
            <div class="center rounded-4 bg-white dropdown collapse navbar-collapse" id="navbarNav">
            <button class="dropdown-toggle btn btn-white border-0" type="button" id="dropdownMenuButton"
            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">';
            Menu
            </button>
            $this->renderDrops($this->dropdownItems);
            </div>
        }
            
        <div class="navbar-section center collapse navbar-collapse" id="navbarNav">
            $this->renderItems($this->centerItems);        
        </div>

        <div class="navbar-section right collapse navbar-collapse" id="navbarNav">
            $this->renderItems($this->rightItems);
        </div>

        </nav>
    }        

    // Générer les items d'une section
    private function renderItems($items) {
        <ul class="navbar-nav" >
        foreach ($items as $item) {
            $activeClass = $item['active'] ? 'active' : '';
            <li class="navbar-item ' . $activeClass . '" data-aos="flip-up" data-aos-delay="500" data-aos-duration="1000">
            
                // Vérifier si un onclick est défini            
                // Et des classes aux liens
                $itemClass = $item['class'];
                if ($item['onclick']) {
                    <a class="p-2 rounded-5 ' . $itemClass .'" href="#" onclick="' . htmlspecialchars($item['onclick']) . '">' . $item['name'] . '</a>
                } else {
                    <a class="p-2 rounded-5 ' . $itemClass .'"  href="' . BASE_URL . htmlspecialchars($item['link']) . '">' . $item['name'] . '</a>
                }
            
            </li>
        }
        </ul>
    }
    private function renderDrops($itemDrops) {
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        foreach ($itemDrops as $itemDrop) {
            $activeClass = $itemDrop['active'] ? 'active' : '';
            <li class=" ' . $activeClass . '">
            
                // Vérifier si un onclick est défini
                $itemClass = $itemDrop['class'];
                if ($itemDrop['onclick']) {
                    <a class="p-2 rounded-2 dropdown-item ' . $itemClass .'" href="#" onclick="' . htmlspecialchars($itemDrop['onclick']) . '">' . $itemDrop['name'] . '</a>
                } else {
                    <a class="p-2 rounded-2 dropdown-item ' . $itemClass .'"  href="' . BASE_URL .  htmlspecialchars($itemDrop['link']) . '">' . $itemDrop['name'] . '</a>
                }
            
            </li>
        }
        </ul>
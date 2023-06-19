<?php
class PublicationController extends Publication {

    public function insertPublicationController($title, $date, $category, $userid) {
        return $this->insertPublication($title, $date, $category, $userid);
    }

    public function getPublicationCotroller($userid) {
        return $this->getPublication($userid);
    }

    public function updatePublicationController($publicationId, $title, $category) {
        return $this->updatePublication($publicationId, $title, $category);
    }

}

?>
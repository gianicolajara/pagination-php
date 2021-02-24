<?php

include_once 'db.php';

class Pagination extends DB
{

    private $numberOfImagesPerPage;
    private $index;
    private $numberOfPages;
    private $numberOfImages;

    public function __construct($numberOfImagesPerPage)
    {
        parent::__construct();
        $this->numberOfImagesPerPage = $numberOfImagesPerPage;
    }

    public function calculatedTotalPages()
    {
        $sth = $this->connect()->query("SELECT COUNT(*) AS total FROM slots");
        $this->numberOfImages = $sth->fetch(PDO::FETCH_OBJ)->total;
        $this->numberOfPages = round($this->numberOfImages / $this->numberOfImagesPerPage);
    }

    public function calculatedSelectPage()
    {
        if (isset($_GET['pages']) && !empty($_GET['pages'])) {
            $index = $_GET['pages'];
            if (is_numeric($index)) {
                if ($index >= 1 && $index <= $this->numberOfPages) {
                    $this->index = $index;
                } else {
                    echo 'error';
                }
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function showMenu()
    {
        echo '<ul>';
        for ($i = 1; $i <= $this->numberOfPages; $i++) {
            if ($i == $this->index) {
                echo '<li><a class="now" href="?pages=' . $i . '">' . $i . '</a></li>';
            } else {
                echo '<li><a href="?pages=' . $i . '">' . $i . '</a></li>';
            }
        }
        echo '</ul>';
    }

    public function showImages()
    {
        $sth = $this->connect()->prepare("SELECT * FROM slots LIMIT :i, :f");
        $sth->execute(['i' => ($this->index * $this->numberOfImagesPerPage) - ($this->numberOfImagesPerPage), 'f' => $this->numberOfImagesPerPage]);
        foreach ($sth as $movies) {
            include './views/movie.php';
        }
    }

}
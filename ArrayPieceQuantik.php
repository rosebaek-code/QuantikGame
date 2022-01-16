<?php
/**
 * Classe permettante de créer un tableau de pièces.
 * @author Munkhdorj ERDENEBAATAR
 * @author Hajar RAHMOUNI
 * @date 14/01/2022
 * @version 1.1
 */
include_once("PieceQuantik.php");
class ArrayPieceQuantik{
    /**
     * un tableau de pièces.
    */
    protected array $piecesQuantiks;

    /**
     * la taille du tableau.
    */
    protected int $taille;

    /**
     * constructeur par défaut.
    */
    public function __construct()
    {
        $this->piecesQuantiks = array();
        $this->taille = 0;
    }

    /**
     * affichage du tableau.
     * @return string la chaîne contenant l'affichage.
    */
    public function __toString() : string
    {
        $s = "<br>"."la taille : ".$this->taille."<br>";
        for($i =0 ; $i < 4 ; $i++){
            if(!empty($this->piecesQuantiks[$i]))
                $s .= $this->piecesQuantiks[$i]->__toString()."<br>";
        }
        return $s;
    }

    /**
     * méthode pour récupérer une pièce à la position passée en paramètre.
     * @param int $pos l'indice de la pièce.
     * @return PieceQuantik pièce trouvée à la position.
    */
    public function getPieceQuantik(int $pos) : PieceQuantik {
        return $this->piecesQuantiks[$pos];
    }

    /**
     * méthode pour insérer une pièce à la position passée en paramètre
     * @param int $pos l'indice de la position
     * @param PieceQuantik $piece la pièce à insérer
     * @return void
    */
    public function setPieceQuantik(int $pos,PieceQuantik $piece) : void{
        for($i = 0 ; $i < $this->taille ; $i++){
            if($i == $pos){
                $this->piecesQuantiks[$i] = $piece;
            }
        }
    }

    /**
     * méthode pour ajouter une pièce à la fin du tableau
     * @param PieceQuantik $piece pièce à insérer
     * @return void
    */
    public function addPieceQuantik(PieceQuantik $piece) : void {
        array_push($this->piecesQuantiks,$piece);
        if($piece->getForme()!=0)
            $this->taille++;
    }

    /**
     * méthode pour retirer une pièce
     * @param l'indice de la pièce à retirer
     * @return void
    */
    public function removePieceQuantik(int $pos) : void {
        unset($this->piecesQuantiks[$pos]);
        if($this->piecesQuantiks[$pos]->getForme()!=0)
            $this->taille--;
    }

    /**
     * méthode pour récupérer la taille d'un tableau de pièces
     * @return int la taille du tableau
    */
    public function getTaille() : int {
        return $this->taille;
    }

    /**
     * méthode pour modifier la taille du tableau
     * @return void
    */
    public function setTaille(int $taille) : void {
        $this->taille = $taille;
    }

    /**
     * méthode pour créer un tableau de pièces noires
     * @return ArrayPieceQuantik le tableau de pièces crée
    */
    public static function initPiecesNoires() : ArrayPieceQuantik {
        $piecesNoires = new ArrayPieceQuantik();
        for($i = 0; $i < 2; $i++){
            $piecesNoires->addPieceQuantik(PieceQuantik::initBlackCube());
            $piecesNoires->addPieceQuantik(PieceQuantik::initBlackCone());
            $piecesNoires->addPieceQuantik(PieceQuantik::initBlackCylindre());
            $piecesNoires->addPieceQuantik(PieceQuantik::initBlackSphere());
        }
        return $piecesNoires;
    }

    /**
     * méthode pour créer un tableau de pièces blanches
     * @return ArrayPieceQuantik le tableau de pièces crée
     */
    public static function initPiecesBlanches() : ArrayPieceQuantik {
        $piecesBlanches = new ArrayPieceQuantik();
        for($i = 0; $i < 2; $i++){
            $piecesBlanches->addPieceQuantik(PieceQuantik::initWhiteCube());
            $piecesBlanches->addPieceQuantik(PieceQuantik::initWhiteCone());
            $piecesBlanches->addPieceQuantik(PieceQuantik::initWhiteCylindre());
            $piecesBlanches->addPieceQuantik(PieceQuantik::initWhiteSphere());
        }
        return $piecesBlanches;
    }
}

    /*Test des méthodes statiques*/
    echo "TEST ArrayPieceQuantik"."<br/>";
    $tab = new ArrayPieceQuantik();
    $tab->addPieceQuantik(PieceQuantik::initWhiteCone());
    $tab->addPieceQuantik(PieceQuantik::initWhiteCylindre());
    $tab->addPieceQuantik(PieceQuantik::initWhiteSphere());
    echo $tab;
    echo "piece à la position 0 : ".$tab->getPieceQuantik(0)."<br>";
    $tab->setPieceQuantik(0,PieceQuantik::initBlackCone());
    echo "après modification de la position 0".$tab;
    echo "Affichage de la taille : ". $tab->getTaille();
    echo ArrayPieceQuantik::initPiecesNoires();
    echo ArrayPieceQuantik::initPiecesBlanches();
    echo"===================================================================="."<br/>";
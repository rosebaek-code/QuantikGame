<?php
/**
 * Classe permettante de gérer les actions du jeu.
 * @author Munkhdorj ERDENEBAATAR
 * @author Hajar RAHMOUNI
 * @date 16/01/2022
 * @version 1.1
 */
include_once("PlateauQuantik.php");

class ActionQuantik{
    /**
     * plateau du jeu
    */
    protected PlateauQuantik $plateau;

    /**
     * constructeur par défaut
     * @param PlateauQuantik $plateau le plateau du jeu
    */
    public function __construct(PlateauQuantik $plateau){
        $this->plateau = $plateau;
    }

    /**
     * méthode pour récupérer le plateau
     * @return PlateauQuantik
    */
    public function getPlateau():PlateauQuantik{return $this->plateau;}

    /**
     * permet de vérifier que la ligne contient des formes différentes pour réunir une condition de victoire.
     * @param int $numRow le numéro de la ligne à vérifier
     * @return bool si la condition de victoire est valide retourne vrai sinon faux.
    */
    public function isRowWin(int $numRow):bool{
        $line = $this->plateau->getRow($numRow);
        if(!ActionQuantik::isComboWin($line))
            return false;
        return true;
    }

    /**
     * permet de vérifier que la colonne contient des formes différentes pour réunir une condition de victoire.
     * @param int $numCol le numéro de la colonne à vérifier
     * @return bool si la condition de victoire est valide retourne vrai sinon faux.
     */
    public function isColWin(int $numCol):bool{
        $col = $this->plateau->getCol($numCol);
        if(!ActionQuantik::isComboWin($col))
            return false;
        return true;
    }

    /**
     * permet de vérifier que le coin contient des formes différentes pour réunir une condition de victoire.
     * @param int $dir la direction du coin à vérifier
     * @return bool si la condition de victoire est valide retourne vrai sinon faux.
     * @throws Exception
     */
    public function isCornerWin(int $dir):bool{
        $coin = $this->plateau->getCorner($dir);
        if(!ActionQuantik::isComboWin($coin))
            return false;
        return true;
    }

    /**
     * permet de vérifier que la position recherchée sur le plateau est valide.
     * @param int $rowNum l'indice de la ligne.
     * @param int $colNum l'indice de la colonne.
     * @param PieceQuantik $piece pièce à insérer.
     * @return bool si la position est valide, retourne vrai sinon faux.
     * @throws Exception
     */
    public function isValidePose(int $rowNum,int $colNum, PieceQuantik $piece):bool{
        $line = $this->plateau->getRow($rowNum);
        if(!ActionQuantik::isPieceValide($line,$piece))
            return false;
        $col = $this->plateau->getCol($colNum);
        if(!ActionQuantik::isPieceValide($col,$piece))
            return false;
        $corner = $this->plateau->getCorner($this->plateau->getCornerFromCoord($rowNum, $colNum));
        if(!ActionQuantik::isPieceValide($corner,$piece))
            return false;
        return true;
    }

    /**
     * permet de poser une pièce sur le plateau.
     * @param int $rowNum l'indice de la ligne.
     * @param int $colNum l'indice de la colonne.
     * @param PieceQuantik $piece pièce à insérer.
     * @throws Exception
     */
    public function posePiece(int $rowNum,int $colNum, PieceQuantik $piece):void{
        if($this->isValidePose($rowNum, $colNum, $piece))
            $this->plateau->setPiece($rowNum, $colNum, $piece);
    }

    /**
     * permet de vérifier si on fait une victoire en combo.
     * @param ArrayPieceQuantik $pieces tableau à vérifier.
     * @return bool si les condtions sont réunis, on retourne vrai sinon faux.
    */
    private static function isComboWin(ArrayPieceQuantik $pieces):bool{
        for ($i = 0; $i < 4; $i++) {
            $couleur = $pieces->getPieceQuantik($i)->getCouleur();
            for ($j = 0; $j < 4; $j++) {
                if (empty($pieces->getPieceQuantik($i)))
                    return false;
                if ($pieces->getPieceQuantik($i)->getForme() == 0)
                    return false;
                if ($j != $i && $couleur != $pieces->getPieceQuantik($j)->getCouleur()) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * permet de vérifier qu'on peut poser une forme parmi un tableau.
     * @param ArrayPieceQuantik $pieces tableau de pièces.
     * @param PieceQuantik $p pièce à vérifier.
     * @return bool retourne vrai si la pièce est posable sinon retourne faux.
     */
    private static function isPieceValide(ArrayPieceQuantik $pieces, PieceQuantik $p):bool{
        for($i=0;$i<4;$i++){
            if($pieces->getPieceQuantik($i)->getForme()==$p->getForme())
                return false;
        }
        return true;
    }

    public function __toString():string{
        return $this->plateau->__toString();
    }
}

    echo "<br> TEST ActionQuantik <br>"."<br/>";
    $tab = new PlateauQuantik();
    $tab->setPiece(0,0,PieceQuantik::initWhiteCube());
    $tab->setPiece(0,1,PieceQuantik::initWhiteCylindre());
    $tab->setPiece(0,2,PieceQuantik::initWhiteSphere());
    $tab->setPiece(0,3,PieceQuantik::initWhiteCone());
    $tab->setPiece(1,0,PieceQuantik::initVoid());
    $tab->setPiece(1,1,PieceQuantik::initWhiteCone());
    $tab->setPiece(1,2,PieceQuantik::initVoid());
    $tab->setPiece(1,3,PieceQuantik::initVoid());
    $tab->setPiece(2,2,PieceQuantik::initVoid());
    $tab->setPiece(2,0,PieceQuantik::initVoid());
    $tab->setPiece(2,1,PieceQuantik::initVoid());
    $tab->setPiece(2,3,PieceQuantik::initVoid());
    $tab->setPiece(3,0,PieceQuantik::initVoid());
    $tab->setPiece(3,1,PieceQuantik::initVoid());
    $tab->setPiece(3,2,PieceQuantik::initVoid());
    $tab->setPiece(3,3,PieceQuantik::initVoid());
    $action = new ActionQuantik($tab);
    echo $action;
    echo "isRowWin 0: ".$action->isRowWin(0)."<br>";
    echo "isRowWin 1: ".$action->isRowWin(1)."<br>";
    echo "posePiece noir cone à la ligne 1 et col 0".$action->posePiece(1,0,PieceQuantik::initBlackCone())."<br>";
    echo "posePiece noir cube à la ligne 2 et col 1".$action->posePiece(2,1,PieceQuantik::initBlackCube())."<br>";
    echo "posePiece noir cylindre à la ligne 3 et col 1".$action->posePiece(3,1,PieceQuantik::initBlackSphere())."<br>";
    echo $action;
    echo "isColWin col 1: ".$action->isColWin(1)."<br>";
    echo "posePiece noir cone à la ligne 2 et col 0".$action->posePiece(2,0,PieceQuantik::initBlackCone())."<br>";
    echo "posePiece noir cylindre à la ligne 3 et col 0".$action->posePiece(3,0,PieceQuantik::initBlackCylindre())."<br>";
    echo $action;
    echo "isCorner 2: ".$action->isCornerWin(2)."<br>";

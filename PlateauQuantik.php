<?php
/**
 * Classe permettante de créer un tableau de tableaux de pièces (plateau de pièces).
 * @author Munkhdorj ERDENEBAATAR
 * @author Hajar RAHMOUNI
 * @date 16/01/2022
 * @version 1.1
 */
include_once("PieceQuantik.php");
include_once("ArrayPieceQuantik.php");
class PlateauQuantik{
    /**
     * Attributs
     */
    public const NBROWS = 4;
    public const NBCOLS = 4;
    public const NW = 0;
    public const NE = 1;
    public const SW = 2;
    public const SE = 3;
    protected $cases = array();

    /**
     * PlateauQuantik constructor(initialiser le tableau des pièces Quantiks).
     */
    public function __construct(){
        $cases = [
          new SplFixedArray(3),
          new SplFixedArray(3),
          new SplFixedArray(3),
          new SplFixedArray(3),
        ];
    }

    /**
     * méthode pour récupérer une pièce
     * @param int $rowNumle le numèro de la ligne
     * @param int $colNum le numèro de la colonne
     * @return PieceQuantik la pièce qu'on veut retourner
     */
    public function getPiece(int $rowNum, int $colNum) : PieceQuantik{
        return $this->cases[$rowNum][$colNum];
    }

    /**
     * méthode pour placer une pièce sur le plateau
     * @param int $rowNum le numèro de la ligne
     * @param int $colNum le numèro de la colonne
     * @param PieceQuantik $piece la pièce à insérer
     */
    public function setPiece(int $rowNum, int $colNum, PieceQuantik $piece) : void{
        $this->cases[$rowNum][$colNum] = $piece;
    }
    /**
     * méthode pour récupérer les pièces d'une ligne
     * @param int $numRow le numéro de la ligne qu'on veut retourner ses valeurs
     * @return ArrayPieceQuantik tableau de pièces Quantiks representant la ligne.
     */
    public function getRow(int $numRow) : ArrayPieceQuantik{
        $piecesRow = new ArrayPieceQuantik();
        for($i = 0; $i < self::NBROWS ;$i++){
            $piecesRow->addPieceQuantik($this->cases[$numRow][$i]);
        }
        return $piecesRow;
    }

    /**
     * méthode pour récupérer les pièces d'une colonne
     * @param int $numCol L'indice du coin
     * @return ArrayPieceQuantik tableau de pièces Quantiks associées au coin.
     */
    public function getCol(int $numCol) : ArrayPieceQuantik{
        $piecesCol = new ArrayPieceQuantik();
        for($i = 0; $i < self::NBCOLS ;$i++){
            $piecesCol->addPieceQuantik($this->cases[$i][$numCol]);
        }
        return $piecesCol;
    }
    /**
     * Méthode retournant le tableau de pièces Quantiks associées au coin.
     * @return ArrayPieceQuantik tableau de pièces quantiks
     * @param int $dir l'indice du coin
     */
    public function getCorner(int $dir) : ArrayPieceQuantik{
        $piecesCOR = new ArrayPieceQuantik();
        switch ($dir){
            case self::NW :
                for($i=0;$i<=1;$i++){
                    for($j=0;$j<=1;$j++){
                        $piecesCOR->addPieceQuantik($this->cases[$i][$j]);
                    }
                }
                return $piecesCOR;
                break;
            case self::NE :
                for($i=0;$i<=1;$i++){
                    for($j=2;$j<=3;$j++){
                        $piecesCOR->addPieceQuantik($this->cases[$i][$j]);
                    }
                }
                return $piecesCOR;
                break;
            case self::SW :
                for($i=2;$i<=3;$i++){
                    for($j=0;$j<=1;$j++){
                        $piecesCOR->addPieceQuantik($this->cases[$i][$j]);
                    }
                }
                return $piecesCOR;
                break;
            case self::SE :
                for($i=2;$i<=3;$i++){
                    for($j=2;$j<=3;$j++){
                        $piecesCOR->addPieceQuantik($this->cases[$i][$j]);
                    }
                }
                return $piecesCOR;
                break;
            default :
                throw new Exception('numéro de corner inexistant');
        }
    }
    /**
     * affichage du plateau.
     * @return string la chaîne contenant l'affichage du plateau.
     */
    public function __toString() : string{
        $s = "<br>";
        for($i=0;$i<=self::NBROWS-1;$i++){
            for($j=0;$j<=self::NBCOLS-1;$j++){
                $s.=" |".$this->cases[$i][$j]."| ";
            }
            $s.="<br>";
        }
        return $s;
    }
    /**
     * méthode pour récupérer l'indice d'un coin
     * @return int l'indice du Corner.
     * @param int $colNum le numéro de la colonne
     * @param int $rowNum le numéro de la ligne
     */
    public function getCornerFromCoord(int $rowNum, int $colNum) : int{
        if($rowNum <= 1 && $colNum <= 1){
            return self::NW;
        }
        else if($rowNum <=1 && $colNum >= 2){
            return self::NE;
        }
        else if($rowNum >=2 && $colNum <= 1){
            return self::SW;
        }
        else if($rowNum >=2 && $colNum >=2){
            return self::SE;
        }
        else
            throw new Exception('indices non existants');
    }
}
    //Test

    echo "<br> TEST PlateauQuantik <br>"."<br/>";
    $tab = new PlateauQuantik();
    $tab->setPiece(0,0,PieceQuantik::initVoid());
    $tab->setPiece(0,1,PieceQuantik::initVoid());
    $tab->setPiece(0,2,PieceQuantik::initWhiteSphere());
    $tab->setPiece(0,3,PieceQuantik::initVoid());
    $tab->setPiece(1,0,PieceQuantik::initVoid());
    $tab->setPiece(1,1,PieceQuantik::initWhiteCone());
    $tab->setPiece(1,2,PieceQuantik::initVoid());
    $tab->setPiece(1,3,PieceQuantik::initVoid());
    $tab->setPiece(2,2,PieceQuantik::initBlackCone());
    $tab->setPiece(2,0,PieceQuantik::initVoid());
    $tab->setPiece(2,1,PieceQuantik::initVoid());
    $tab->setPiece(2,3,PieceQuantik::initVoid());
    $tab->setPiece(3,0,PieceQuantik::initVoid());
    $tab->setPiece(3,1,PieceQuantik::initVoid());
    $tab->setPiece(3,2,PieceQuantik::initVoid());
    $tab->setPiece(3,3,PieceQuantik::initVoid());
    echo $tab;//Affiche le plateau (matrice)
    echo "----------------------";
    echo $tab->getCorner(1);//affiche les 4 pieces du Corner NE
    echo "----------------------<br>";
    echo "getCornerFromCoord de ligne 2 et colonne 2 :".$tab->getCornerFromCoord(2,2); //affiche 3
    echo "<br>----------------------";
    echo $tab->getCol(2);//Affiche les 4 pieces de la colonne 2
    echo"===================================================================="."<br/>";


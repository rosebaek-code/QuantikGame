<?php
/**
 * Classe permettante de créer une pièce.
 * @author Munkhdorj ERDENEBAATAR
 * @author Hajar RAHMOUNI
 * @date 14/01/2022
 * @version 1.1
*/
class PieceQuantik {
    /**
     * @const couleur blanc utilisée pour une pièce.
    */
    public const WHITE = 0;
    /**
     * @const couleur noir utilisée pour une pièce.
     */
    public const BLACK = 1;
    /**
     * @const forme vide utilisée pour une pièce.
     */
    public const VOID = 0;
    /**
     * @const forme cubique utilisée pour une pièce.
     */
    public const CUBE = 1;
    /**
     * @const forme conique utilisée pour une pièce.
     */
    public const CONE = 2;
    /**
     * @const forme cylindrique utilisée pour une pièce.
     */
    public const CYLINDRE = 3;
    /**
     * @const forme sphérique utilisée pour une pièce.
     */
    public const SPHERE = 4;
    /**
     * forme la forme d'une pièce.
     */
    protected int $forme;
    /**
     * couleur la couleur d'une pièce.
     */
    protected int $couleur;

    /**
     * constructeur d'une pièce.
     * @param int $forme la forme à créer.
     * @param int $couleur la couler de la forme.
     */
    private function __construct(int $forme, int $couleur){
        $this->forme = $forme;
        $this->couleur = $couleur;
    }

    /**
     * méthode pour récupérer la forme d'une pièce.
     * @return int la forme de la pièce.
    */
    public function getForme():int{return $this->forme;}

    /**
     * méthode pour récupérer la couleur d'une pièce.
     * @return int la couleur de la pièce.
    */
    public function getCouleur():int{return $this->couleur;}

    /**
     * affichage par défaut d'une pièce.
     * @return string la chaîne contenant l'affichage de la pièce.
    */
    public function __toString(): string{return $this-> forme.",".$this->couleur;}

    /**
     * créer une pièce vide.
     * @return PieceQuantik pièce crée.
    */
    public static function initVoid():PieceQuantik{return new PieceQuantik( self::VOID,self::VOID);}

    /**
     * créer une pièce cubique de couleur blanche.
     * @return PieceQuantik pièce crée.
     */
    public static function initWhiteCube():PieceQuantik{return new PieceQuantik(self::CUBE,self::WHITE);}

    /**
     * créer une pièce cubique de couleur noire.
     * @return PieceQuantik pièce crée.
     */
    public static function initBlackCube():PieceQuantik{return new PieceQuantik(self::CUBE,self::BLACK);}

    /**
     * créer une pièce conique de couleur blanche.
     * @return PieceQuantik pièce crée.
     */
    public static function initWhiteCone():PieceQuantik{return new PieceQuantik(self::CONE,self::WHITE);}

    /**
     * créer une pièce conique de couleur noire.
     * @return PieceQuantik pièce crée.
     */
    public static function initBlackCone():PieceQuantik{return new PieceQuantik(self::CONE,self::BLACK);}

    /**
     * créer une pièce cylindrique de couleur blanche.
     * @return PieceQuantik pièce crée.
     */
    public static function initWhiteCylindre():PieceQuantik{return new PieceQuantik(self::CYLINDRE,self::WHITE);}

    /**
     * créer une pièce cylindrique de couleur noire.
     * @return PieceQuantik pièce crée.
     */
    public static function initBlackCylindre():PieceQuantik{return new PieceQuantik(self::CYLINDRE,self::BLACK);}

    /**
     * créer une pièce sphérique de couleur blanche.
     * @return PieceQuantik pièce crée.
     */
    public static function initWhiteSphere():PieceQuantik{return new PieceQuantik(self::SPHERE,self::WHITE);}

    /**
     * créer une pièce sphérique de couleur noire.
     * @return PieceQuantik pièce crée.
     */
    public static function initBlackSphere():PieceQuantik{return new PieceQuantik(self::SPHERE,self::BLACK);}
}
    /*Test des méthodes statiques et les getters*/
    echo "TEST PieceQunatik"."<br/>";
    echo "Piece vide : ".PieceQuantik::initVoid()."<br/>";
    echo "White Cube : ".PieceQuantik::initWhiteCube()."<br/>";
    echo "Black Cube : ".PieceQuantik::initBlackCube()."<br/>";
    echo "White Cone : ".PieceQuantik::initWhiteCone()."<br/>";
    echo "Black Cone : ".PieceQuantik::initBlackCone()."<br/>";
    echo "White Cylindre : ".PieceQuantik::initWhiteCylindre()."<br/>";
    echo "Black Cylindre : ".PieceQuantik::initBlackCylindre()."<br/>";
    echo "White Sphere : ".PieceQuantik::initWhiteSphere()."<br/>";
    echo "White Sphere : ".PieceQuantik::initBlackSphere()."<br/>";
    $piece = PieceQuantik::initWhiteSphere();
    echo "piece de forme ".$piece->getForme()." et de couleur ". $piece->getCouleur()."<br/>";
    echo"===================================================================="."<br/>";

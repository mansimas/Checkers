<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class CheckersMoves {

	private $letter;
	private $color;
	private $nones;
	private $blacks;
	private $whites;
	private $player;
	private $opponent;
	private $turn;
	private $movedCompulsory;
	private $lastMoves;
	private $doubleHitPossible;
	private $doubleHitPossibleMoves = [];
	private $blackDames = [];
	private $whiteDames = [];

	public function __construct($arr, $entity){
		$this->lastMoves = $arr;
		$this->turn = $entity->getTurn();
		$this->setValuesAndKeys($arr, $entity);
	}

	private function setValuesAndKeys($arr, $entity){
		// $arr is the changed values of Form, the getEntityChangeSet() from controller.
		// $arr example: {a1 => { 1 => 'black'} { 2 => 'rblack'}}
		foreach($arr as $key=>&$value) {
			$this->letter = $key;		// set $letter as "a1"
			$colors = $value;			// left { 1 => 'black'} { 2 => 'rblack'}
			foreach($colors as $key=>&$value){
				$this->color = $value;	// get the last value "rblack", set it as $color
			}
		}	



		$entityArray = (array) $entity;		// $entity is Object, parse it as array
		$newEntity = [];					// look at next foreach()
		foreach($entityArray as $key=>&$value) {
			// from long "/.../.../..a1 => 'black'" get only "a1 => 'black'"
			$newEntity [substr ( $key,-2 )] = $value;
		}
		foreach($newEntity as $key=>&$value) {
			if($value == "none"){
				$this->nones [] = $key;		// if "'a1' => 'none'", push 'a1' to array of 'nones'
			}
			elseif($value == "black"){
				$this->blacks [] = $key;
			}
			elseif($value == "white"){
				$this->whites [] = $key;
			}
			elseif($value == "whiteDame"){
				$this->whiteDames [] = $key;
				$this->whites [] = $key;
			}
			elseif($value == "blackDame"){
				$this->blackDames [] = $key;
				$this->blacks [] = $key;
			}
			elseif($value == "rwhite"){
				$this->letter = $key;
				$this->color = $value;
				$this->turn = "whites";

			}
			elseif($value == "rblack"){
				$this->letter = $key;
				$this->color = $value;
				$this->turn = "blacks";
			}
			elseif($value == "rwhiteDame"){
				$this->letter = $key;
				$this->color = $value;
				$this->turn = "whites";

			}
			elseif($value == "rblackDame"){
				$this->letter = $key;
				$this->color = $value;
				$this->turn = "blacks";
			}
			elseif($value == "player"){
				if($key=="es"){
					// "whites" last 2 letters is "es", parsed from entityArray
					$this->player = "whites";
				}
				elseif($key=="ks"){
					// "blacks" last 2 letters is "ks", parsed from entityArray
					$this->player = "blacks";
				}
			}
			elseif($value == "AI"){
				if($key=="es"){
					$this->opponent = "whites";
				}
				elseif($key=="ks"){
					$this->opponent = "blacks";
				}
			}
		}	
	}


	public function getPossibleMoves(){
		$availableLetters = range('a', 'h');
		$possibleMoves = [];
		$compulsoryMoves = [];
		$doubleHitMoves = [];
		$onlyLetter = substr($this->letter, 0, 1);
		$index = array_search($onlyLetter, $availableLetters);

		if( $this->color == "rwhite" || $this->color == "rblack"){

			if($this->color == "rblack" && $this->player == "blacks"){
				$theValue = 1;
				$hittingChecker = $this->whites;
			} 
			elseif($this->color == "rblack" && $this->player == "whites"){
				$theValue = -1;
				$hittingChecker = $this->whites;
			} 
			elseif($this->color == "rwhite" && $this->player == "whites"){
				$theValue = 1;
				$hittingChecker = $this->blacks;
			}
			elseif($this->color == "rwhite" && $this->player == "blacks"){
				$theValue = -1;
				$hittingChecker = $this->blacks;
			} 

			$nextNumber = intval(substr($this->letter, 1, 1)) + $theValue;
			foreach(array(-1, 1) as $indexNumber){
				if (isset($availableLetters[$index+$indexNumber])){
					$nextField = "{$availableLetters[$index+$indexNumber]}{$nextNumber}";
					if( in_array($nextField, $this->nones)){
						$possibleMoves [] = $nextField;
					}
					$doubleIndexNumber = $indexNumber*2;
					if (isset($availableLetters[$index+$doubleIndexNumber])){
						// first hit
						if( in_array($nextField, $hittingChecker)){
							$overNextNumber = $nextNumber+$theValue;
							$overNextField = "{$availableLetters[$index+$doubleIndexNumber]}{$overNextNumber}";
							if( in_array($overNextField, $this->nones)){
								$overOverNextNumber = $overNextNumber+$theValue;
								$doubleIndexNumber2 = $doubleIndexNumber*2;
								// second hit same direction
								if( isset($availableLetters[$index+$doubleIndexNumber2])){
									$tribleIndexNumber = $indexNumber*3;
									$overOverLeftField = "{$availableLetters[$index+$tribleIndexNumber]}{$overOverNextNumber}";
									if( in_array($overOverLeftField, $hittingChecker)){
										$overOverOverNextNumber = $overOverNextNumber+$theValue;
										$overOverOverNextField = "{$availableLetters[$index+$doubleIndexNumber2]}{$overOverOverNextNumber}";
										if( in_array($overOverOverNextField, $this->nones)){
											$doubleHitMoves [] =  $overNextField;
										}
									}
								}
								// second hit opposite direction
								$overOverRightField = "{$availableLetters[$index+$indexNumber]}{$overOverNextNumber}";
								if( in_array($overOverRightField, $hittingChecker)){
									$overOverOverNextNumber = $overOverNextNumber+$theValue;
									$overOverOverNextField = "{$availableLetters[$index]}{$overOverOverNextNumber}";
									if( in_array($overOverOverNextField, $this->nones)){
										$doubleHitMoves [] =  $overNextField;
									}
								}
								$compulsoryMoves [$nextField] = $overNextField;
							}
						}
					}
				}
			}
		}
		elseif( $this->color == "rwhiteDame" || $this->color == "rblackDame"){

			if($this->color == "rblackDame" && $this->player == "blacks"){
				$hittingChecker = $this->whites;
			} 
			elseif($this->color == "rblackDame" && $this->player == "whites"){
				$hittingChecker = $this->whites;
			} 
			elseif($this->color == "rwhiteDame" && $this->player == "whites"){
				$hittingChecker = $this->blacks;
			}
			elseif($this->color == "rwhiteDame" && $this->player == "blacks"){
				$hittingChecker = $this->blacks;
			} 

			foreach(array(-1, 1) as $theValue){
				$nextNumber = intval(substr($this->letter, 1, 1)) + $theValue;
				foreach(array(-1, 1) as $indexNumber){
					if (isset($availableLetters[$index+$indexNumber])){
						$nextField = "{$availableLetters[$index+$indexNumber]}{$nextNumber}";
						if( in_array($nextField, $this->nones)){
							$possibleMoves [] = $nextField;
						}
						$doubleIndexNumber = $indexNumber*2;
						if (isset($availableLetters[$index+$doubleIndexNumber])){
							// first hit
							if( in_array($nextField, $hittingChecker)){
								$overNextNumber = $nextNumber+$theValue;
								$overNextField = "{$availableLetters[$index+$doubleIndexNumber]}{$overNextNumber}";
								if( in_array($overNextField, $this->nones)){
									$overOverNextNumber = $overNextNumber+$theValue;
									$overNextDameNumber = $overNextNumber-$theValue;
									$doubleIndexNumber2 = $doubleIndexNumber*2;
									// second hit same direction
									if( isset($availableLetters[$index+$doubleIndexNumber2])){
										$tribleIndexNumber = $indexNumber*3;
										$overOverLeftField = "{$availableLetters[$index+$tribleIndexNumber]}{$overOverNextNumber}";
										$overOverLeftDameField = "{$availableLetters[$index+$tribleIndexNumber]}{$overNextDameNumber}";
										if( in_array($overOverLeftField, $hittingChecker)){
											$overOverOverNextNumber = $overOverNextNumber+$theValue;
											$overOverOverNextField = "{$availableLetters[$index+$doubleIndexNumber2]}{$overOverOverNextNumber}";
											if( in_array($overOverOverNextField, $this->nones)){
												$doubleHitMoves [] =  $overNextField;
											}
										}
										if( in_array($overOverLeftDameField, $hittingChecker)){
											$overOverOverNextNumber = $overNextDameNumber-$theValue;
											$overOverOverNextField = "{$availableLetters[$index+$doubleIndexNumber2]}{$overOverOverNextNumber}";
											if( in_array($overOverOverNextField, $this->nones)){
												$doubleHitMoves [] =  $overNextField;
											}
										}
									}
									// second hit opposite direction
									$overOverRightField = "{$availableLetters[$index+$indexNumber]}{$overOverNextNumber}";
									$overOverRightDameField = "{$availableLetters[$index+$indexNumber]}{$overNextDameNumber}";
									if( in_array($overOverRightField, $hittingChecker)){
										$overOverOverNextNumber = $overOverNextNumber+$theValue;
										$overOverOverNextField = "{$availableLetters[$index]}{$overOverOverNextNumber}";
										if( in_array($overOverOverNextField, $this->nones)){
											$doubleHitMoves [] =  $overNextField;
										}
									}
									if( in_array($overOverRightDameField, $hittingChecker)){
										$overOverOverNextNumber = $overNextDameNumber-$theValue;
										$overOverOverNextField = "{$availableLetters[$index]}{$overOverOverNextNumber}";
										if( in_array($overOverOverNextField, $this->nones)){
											$doubleHitMoves [] =  $overNextField;
										}
									}
									$compulsoryMoves [$nextField] = $overNextField;
								}
							}
						}
					}
				}
			}
		}

		// searching for valid moves
		else{

			if($this->player == "blacks" && $this->turn == "blacks"){
				$theValue = -1;
				$thisChecker = $this->blacks;
				$thisDameChecker = $this->blackDames;
				$hittingChecker = $this->whites;
			} 
			elseif($this->player == "whites" && $this->turn == "whites"){
				$theValue = -1;
				$thisChecker = $this->whites;
				$thisDameChecker = $this->whiteDames;
				$hittingChecker = $this->blacks;
			} 
			elseif($this->player == "blacks" && $this->turn == "whites"){
				$theValue = 1;
				$thisChecker = $this->whites;
				$thisDameChecker = $this->whiteDames;
				$hittingChecker = $this->blacks;
			} 
			elseif($this->player == "whites" && $this->turn == "blacks"){
				$theValue = 1;
				$thisChecker = $this->blacks;
				$thisDameChecker = $this->blackDames;
				$hittingChecker = $this->whites;
			}
			// scan every clear field backwards and forwards
			foreach($this->nones as $none){
				$nonesNumber = intval(substr($none, 1, 1)) + $theValue;
				$nonesDameNumber = intval(substr($none, 1, 1)) - $theValue;
				$nonesLetter = substr($none, 0, 1);
				$nonesIndex = array_search($nonesLetter, $availableLetters);
				foreach(array(-1, 1) as $indexNumber){
					if (isset($availableLetters[$nonesIndex+$indexNumber])){
						// valid simple moves for non-dames
						$nextField = "{$availableLetters[$nonesIndex+$indexNumber]}{$nonesNumber}";
						if( in_array($nextField, $thisChecker)){
							$possibleMoves [] = $nextField;
						}
						// valid simple moves for dames
						$nextDameField = "{$availableLetters[$nonesIndex+$indexNumber]}{$nonesDameNumber}";
						if( in_array($nextDameField, $thisDameChecker)){
							$possibleMoves [] = $nextDameField;
						}
					}
					$doubleValue = $indexNumber*2;
					if (isset($availableLetters[$nonesIndex+$doubleValue])){
						$nextField = "{$availableLetters[$nonesIndex+$indexNumber]}{$nonesNumber}";
						// valid possible hits for non-dames
						if (in_array($nextField, $hittingChecker)){
							$overNonesNumber = $nonesNumber + $theValue;
							$overNextField = "{$availableLetters[$nonesIndex+$doubleValue]}{$overNonesNumber}";
							if( in_array($overNextField, $thisChecker)){
								$compulsoryMoves [] = $overNextField;
							}
						}
						//valid possible hits for dames
						$nextDameField = "{$availableLetters[$nonesIndex+$indexNumber]}{$nonesDameNumber}";
						if (in_array($nextDameField, $hittingChecker)){
							$overNonesNumber = $nonesDameNumber - $theValue;
							$overNextField = "{$availableLetters[$nonesIndex+$doubleValue]}{$overNonesNumber}";
							if( in_array($overNextField, $thisDameChecker)){
								$compulsoryMoves [] = $overNextField;
							}
						}
					}
				}
			}
		}
			

		// if next move is a single move
		if(empty($compulsoryMoves)){
			$this->movedCompulsory = false;
			$this->doubleHitPossible = false;

			return array_unique($possibleMoves);	// returns unique [0 => "b4", 1 => "d4"].
		}

		// if next move is a hit move. This is a must.
		else{
			// if this is a simple one-hit move
			if(empty($doubleHitMoves)){
				$this->doubleHitPossible = false;
			}
			// if this is a double-hit move
			else{
				$this->doubleHitPossible = true;
				$this->doubleHitPossibleMoves = $doubleHitMoves;
			}
			$this->movedCompulsory = true;
			return $compulsoryMoves;  // cant return unique, possible ["b4" => "c5""d4" => "c5"]

		}
	}

	public function getLetter(){
		return $this->letter;
	}

	public function doubleHitPossible(){
		return $this->doubleHitPossible;
	}

	public function doubleHitPossibleMoves(){
		return $this->doubleHitPossibleMoves;
	}

	public function getTurn(){
		return $this->turn;
	}

	public function getOppositeTurn(){
		if ($this->turn == "whites"){
			return "blacks";
		}
		if ($this->turn == "blacks"){
			return "whites";
		}
	}

	public function getLastMoves(){
		return $this->lastMoves;
	}

	public function getMovedCompulsory(){
		return $this->movedCompulsory;
	}

	public function getColor(){
		// this is only for double-hits

		// no need to change this for dames.
		// It's not possible so double-hit when first hit goes to dame and next hit goes elsewhere
		return $this->color;
	}

	public function getRealColor($clearFieldId){
		// if checker clicked, after pressing on field where it goes, checker becomes unclicked.

		$whiteDameRow = ['a1', 'c1', 'e1', 'g1'];  // lower dame row
		$blackDameRow = ['b8', 'd8', 'f8', 'h8'];  // upped dame row

		if ($this->color == "rwhite"){
			if ($this->player == "whites"){
				if( in_array($clearFieldId, $blackDameRow)){
					return "whiteDame";
				}
				else {
					return "white";
				}
			}
			if ($this->opponent == "whites"){
				if( in_array($clearFieldId, $whiteDameRow)){
					return "whiteDame";
				}
				else {
					return "white";
				}
			}
		}

		elseif ($this->color == "rblack"){
			if ($this->player == "blacks"){
				if( in_array($clearFieldId, $blackDameRow)){
					return "blackDame";
				}
				else {
					return "black";
				}
			}
			if ($this->opponent == "blacks"){
				if( in_array($clearFieldId, $whiteDameRow)){
					return "blackDame";
				}
				else {
					return "black";
				}
			}
		}		

		elseif ($this->color == "rwhiteDame"){
			return "whiteDame";
		}
		elseif ($this->color == "rblackDame"){
			return "blackDame";
		}
		else {
			return "none";
		}
	}

	public function getWhites(){
		return $this->whites;
	}

	public function getWhiteDames(){
		return $this->whiteDames;
	}
	public function getBlackDames(){
		return $this->blackDames;
	}

	public function getBlacks(){
		return $this->blacks;
	}

	public function getNones(){
		return $this->nones;
	}

	public function getPlayer(){
		return $this->player;
	}

	public function getOpponent(){
		return $this->opponent;
	}

}
<?php

class Deck {

    /**
     * Input Cards
     * Array of cards received when instantiating the method.
     *
     * @var array $inputCards
     */
    private $inputCards = null;

    /**
     * Naipe Cards Array map.
     * Map: "c" : clubs/paus; "d" : diamonds/ouros; "h" : hearts/copas; "s": spades/espadas; "j": joker
     *
     * @var array $naipeCardsMap
     */
    private $naipeCardsMap = array("c", "d", "h", "s");

    /**
     * Total Deck
     * Total number of cards in a complete deck.
     *
     * @var int $totalDeck
     */
    private $totalDeck = 52;

    /**
     * Calculated Total Deck
     * Caltculated Total of complete decks.
     *
     * @var int $calculatedTotalDeck
     */
    private $calculatedTotalDeck = 0;

    /**
     * Total Cards Naipe
     * Total number of cards in each naipe.
     *
     * @var int $totalCardsNaipe
     */
    private $totalCardsNaipe = 13;


    /**
     * Start and proccess the count decks.
     *
     * @param  array   $cards
     */
    public function __construct($cards)
    {
        $this->setInputCards($cards);
        $this->proccessDeck();
    }

    /**
     * Stores the input cards sent by the system in a private array.
     *
     * @param $cards
     */
    public function setInputCards($cards)
    {
        $this->inputCards = ($cards) ? $cards : null;
    }


    /**
     * Proccess the input decks.
     *
     * Proccess Steps:
     *
     *   + Check is multi array cards.
     *   + Filter out array elements with keys of the array map.
     *   + Loop in filtered elements for check is array and count itens group by naipe type.
     *
     *
     */
    private function proccessDeck()
    {
        if ($this->isMultiCards())
        {
            $filter = array_filter($this->inputCards, function($item) {
                if (in_array($item["naipe"], $this->naipeCardsMap))
                {
                    return true;
                }
                return false;
            });

            $groupCards = $this->getGroupNaipesAndCount($filter);
            $this->setTotalDeck($groupCards);
        }
    }

    /**
     * Set Total Deck group by naipes type.
     *   + Loop in each naipes and apply division per total cards in single naipes.
     *
     * @param $groupCards
     * @return int
     */
    public function setTotalDeck($groupCards)
    {
        $deckCount = array();
        foreach($groupCards as $key => $groupCard)
        {
            $division = ($groupCard / $this->totalCardsNaipe);

            if (!in_a($key, $deckCount))
            {
                $deckCount[$key] = intval($division);
            }
        }
        $this->calculatedTotalDeck = $deckCount;

        return $this->calculatedTotalDeck;
    }


    public function getTotalDeck()
    {
        return $this->calculatedTotalDeck;
    }

    /**
     * Filter and group cards by naipe type.
     *
     * @param $filteredCards
     * @return array
     */
    private function getGroupNaipesAndCount($filteredCards)
    {
        $groupCards = array();
        foreach($filteredCards as $k=> $v) {
            (!isset($groupCards[$filteredCards[$k]['naipe']])) ?
                $groupCards[$filteredCards[$k]['naipe']]=1:
                $groupCards[$filteredCards[$k]['naipe']]++;
        }

        return $groupCards;
    }

    /**
     * Check is input cards is multidimensional array.
     * Count recursive is useful for recursively checking all subitems of the arryay sent by the system.
     *
     * @param $cards
     * @return bool
     */
    private function isMultiCards() {
        return count($this->inputCards) !== count($this->inputCards, COUNT_RECURSIVE);
    }
}


$inputCards = array(
    array(
        "naipe" => "c",
        "value" => 1
    ),
    array(
        "naipe" => "c",
        "value" => 3
    ),
    array(
        "naipe" => "c",
        "value" => 2
    ),
    array(
        "naipe" => "j",
        "value" => 999
    ),
    array(
        "naipe" => "c",
        "value" => 4
    ),
    array(
        "naipe" => "c",
        "value" => 6
    ),
    array(
        "naipe" => "h",
        "value" => 1
    ),
    array(
        "naipe" => "h",
        "value" => 3
    ),
    array(
        "naipe" => "h",
        "value" => 2
    ),
    array(
        "naipe" => "h",
        "value" => 4
    ),
    array(
        "naipe" => "h",
        "value" => 6
    ),
    array(
        "naipe" => "j",
        "value" => 888
    ),
    array(
        "naipe" => "h",
        "value" => 5
    ),
    array(
        "naipe" => "h",
        "value" => 7
    ),
    array(
        "naipe" => "h",
        "value" => 8
    ),
    array(
        "naipe" => "h",
        "value" => 10
    ),
    array(
        "naipe" => "c",
        "value" => 5
    ),
    array(
        "naipe" => "c",
        "value" => 7
    ),
    array(
        "naipe" => "c",
        "value" => 8
    ),
    array(
        "naipe" => "c",
        "value" => 10
    ),
    array(
        "naipe" => "c",
        "value" => 9
    ),
    array(
        "naipe" => "c",
        "value" => 11
    ),
    array(
        "naipe" => "c",
        "value" => 12
    ),
    array(
        "naipe" => "c",
        "value" => 13
    ),
    array(
        "naipe" => "h",
        "value" => 9
    ),
    array(
        "naipe" => "h",
        "value" => 11
    ),
    array(
        "naipe" => "h",
        "value" => 12
    ),
    array(
        "naipe" => "h",
        "value" => 13
    )
);

$test = new Deck($inputCards);

print_r($test->getTotalDeck());
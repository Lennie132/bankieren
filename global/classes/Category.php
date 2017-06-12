<?php

class Category {

    private $id;
    private $name;
    private $colour;
    private $goal_description;
    private $goal_amount;
    private $goal_date;

    function __construct() {

    }

    /**
     * @return int
     */
    public function getId():int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function setId($id):self {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName():string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName($name):self {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getColour():string {
        return $this->colour;
    }

    /**
     * @param string $colour
     * @return Category
     */
    public function setColour($colour):self {
        $this->colour = $colour;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoalDescription():string {
        return $this->goal_description;
    }

    /**
     * @param string $goal_description
     * @return Category
     */
    public function setGoalDescription($goal_description):self {
        $this->goal_description = $goal_description;
        return $this;
    }

    /**
     * @return double
     */
    public function getGoalAmount() {
        $amount = str_replace(".", ",", $this->goal_amount);
        return $amount;
    }

    /**
     * @param double $goal_amount
     * @return Category
     */
    public function setGoalAmount($goal_amount):self {
        $this->goal_amount = $goal_amount;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getGoalDate() {
        return $this->goal_date;
    }

    /**
     * @param DateTime $goal_date
     * @return Category
     */
    public function setGoalDate($goal_date):self {
        $this->goal_date = $goal_date;
        return $this;
    }

    /**
     * @return Category[]
     */
    static function get_all():array {
        $db = new Database();
        $db->query("SELECT * FROM `categories`");
        $db->execute();
        $results = $db->resultset();
        $items = array();
        if (!empty($results)) {
            foreach ($results as $item) {
                $category = new Category();
                $category
                    ->setId($item['id'])
                    ->setName($item['name'])
                    ->setColour($item['colour'])
                    ->setGoalDescription($item['goal_description'])
                    ->setGoalAmount($item['goal_amount'])
                    ->setGoalDate($item['goal_date']);

                $items[] = $category;
            }
        }
        return $items;
    }

}
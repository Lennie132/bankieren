<?php

class Category {

    private $id = 0;
    private $name = "";
    private $colour = "";
    private $amount;
    private $goal_description = "";
    private $goal_amount;
    private $goal_date = "";
    private $transactions;

    function __construct() {

    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getColour(): string {
        return $this->colour;
    }

    /**
     * @param string $colour
     * @return Category
     */
    public function setColour(string $colour): self {
        $this->colour = $colour;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount(): string {
        return  "€ " . str_replace(".", ",", $this->amount);
    }

    /**
     * @param mixed $amount
     * @return Category
     */
    public function setAmount(string $amount): self {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoalDescription(): string {
        return $this->goal_description;
    }

    /**
     * @param string $goal_description
     * @return Category
     */
    public function setGoalDescription(string $goal_description): self {
        $this->goal_description = $goal_description;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoalAmount(): string {
        $amount = "€ " . str_replace(".", ",", $this->goal_amount);
        return $amount;
    }

    /**
     * @param float $goal_amount
     * @return Category
     */
    public function setGoalAmount(float $goal_amount): self {
        $this->goal_amount = $goal_amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoalDate(): string {
        return $this->goal_date;
    }

    /**
     * @param string $goal_date
     * @return Category
     */
    public function setGoalDate(string $goal_date): self {
        $this->goal_date = $goal_date;
        return $this;
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions(): array {
        return $this->transactions;
    }

    /**
     * @param array $transactions
     * @return Category
     */
    public function setTransactions(array $transactions): self {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * @return Category[]
     */
    static function get_all(): array {
        $db = new Database();
        $db->query('SELECT * FROM `categories`');
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
                    ->setAmount($item['amount'])
                    ->setGoalDescription($item['goal_description'])
                    ->setGoalAmount(floatval($item['goal_amount']))
                    ->setGoalDate($item['goal_date']);

                $items[] = $category;
            }
        }
        return $items;
    }

    static function get_single(int $id): Category {
        $db = new Database();
        $db->query('SELECT * FROM `categories` WHERE `id`=:id');
        $db->bind(':id', $id, PDO::PARAM_INT);
        $db->execute();
        $item = $db->single();
        if (!empty($item)) {
            $category = new Category();
            $category
                ->setId($item['id'])
                ->setName($item['name'])
                ->setColour($item['colour'])
                ->setAmount($item['amount'])
                ->setGoalDescription($item['goal_description'])
                ->setGoalAmount($item['goal_amount'])
                ->setGoalDate($item['goal_date']);

            $category->setTransactions(Transaction::get_all_by_category($category->getId()));
            return $category;
        }
        return null;
    }

}
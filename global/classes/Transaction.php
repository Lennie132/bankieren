<?php

class Transaction {

    private $id;
    private $amount;
    private $store;
    private $date;
    private $combination = 0;

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Transaction
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount(): string {
        return "€ " . str_replace(".", ",", $this->amount);

    }

    /**
     * @param float $amount
     * @return Transaction
     */
    public function setAmount(float $amount): self {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getStore(): string {
        return $this->store;
    }

    /**
     * @param string $store
     * @return Transaction
     */
    public function setStore($store): self {
        $this->store = $store;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Transaction
     */
    public function setDate(DateTime $date): self {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getCombination(): int {
        return $this->combination;
    }

    /**
     * @param int $combination
     * @return Transaction
     */
    public function setCombination(int $combination): self {
        $this->combination = $combination;
        return $this;
    }

    /**
     * @param int $id
     * @return Transaction[]
     */
    static function get_all_by_category(int $id): array {
        $db = new Database();
        $db->query('SELECT * FROM `transactions` WHERE `category_id`=:category_id ORDER BY `datetime` DESC');
        $db->bind(':category_id', $id, PDO::PARAM_INT);
        $db->execute();
        $results = $db->resultset();
        $items = array();
        if (!empty($results)) {
            foreach ($results as $item) {
                $transaction = new Transaction();
                $transaction
                    ->setId($item['id'])
                    ->setAmount($item['amount'])
                    ->setStore($item['store'])
                    ->setDate(DateTime::createFromFormat("Y-m-d H:i:s", $item['datetime']));

                $items[] = $transaction;
            }
            return $items;
        }
        return array();
    }

    /**
     * @return Transaction[]
     */
    static function get_all_unsigned(): array {
        $db = new Database();
        $db->query('SELECT * FROM `transactions` WHERE `category_id`=0');
        $db->execute();
        $results = $db->resultset();
        $items = array();
        if (!empty($results)) {
            foreach ($results as $item) {
                $transaction = new Transaction();
                $transaction
                    ->setId($item['id'])
                    ->setAmount($item['amount'])
                    ->setStore($item['store'])
                    ->setDate(DateTime::createFromFormat("Y-m-d H:i:s", $item['datetime']));


                $transaction->setCombination(self::getCommonCombination($transaction->getStore()));
                $items[] = $transaction;
            }
            return $items;
        }
        return array();
    }

    static function getCommonCombination(string $store): int {
        $db = new Database();
        $db->query('SELECT `category_id`, COUNT(`category_id`) AS `count` FROM `combinations` WHERE `store`=:store GROUP BY `category_id` ORDER BY `count` DESC');
        $db->bind(':store', $store, PDO::PARAM_STR);
        $db->execute();
        $result = $db->single();
        if (!empty($result)) {
            if ($result['count'] >= 3) {
                return $result['category_id'];
            }
        }
        return 0;
    }


    /**
     * @param int $id
     * @param $category_id
     */
    static function sign(int $id, int $category_id) {
        $db = new Database();
        $db->query('UPDATE `transactions` SET `category_id`=:category_id WHERE `id`=:id');
        $db->bind(':category_id', $category_id, PDO::PARAM_INT);
        $db->bind(':id', $id, PDO::PARAM_INT);
        $db->execute();
        $db->query("SELECT `store`, `amount` FROM `transactions` WHERE `id`=:id");
        $db->bind(':id', $id, PDO::PARAM_INT);
        $db->execute();
        $transaction = $db->single();
        $db->query("INSERT INTO `combinations` (`store`, `category_id`) VALUES (:store, :category_id)");
        $db->bind(':store', $transaction['store'], PDO::PARAM_STR);
        $db->bind(':category_id', $category_id, PDO::PARAM_INT);
        $db->execute();
        $db->query('UPDATE `categories` SET `amount` = `amount` - :amount WHERE `id` = :id');
        $db->bind(':amount', $transaction['amount'], PDO::PARAM_STR);
        $db->bind(':id', $category_id, PDO::PARAM_INT);
        $db->execute();
    }
}
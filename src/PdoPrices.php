<?php
namespace Germania\Prices;

use Interop\Container\ContainerInterface;


class PdoPrices implements PricesInterface
{
    public $table = 'germania_prices';

    public $pdo;
    public $pdo_stmt;

    /**
     * @param \PDO   $pdo   PDO Handler
     * @param string $table Prices table name, default: "germania_prices"
     *
     * @uses  $table
     */
    public function __construct( \PDO $pdo, $table = null)
    {
        $this->pdo = $pdo;

        $table = $table ?: $this->table;

        $sql = "SELECT
        amount,
        price,
        description

        FROM $table
        WHERE article_id = :id";

        $this->pdo_stmt = $pdo->prepare( $sql );
    }

    /**
     * @param  mixed $article_id
     * @return array
     */
    public function __invoke( $article_id )
    {
        try {
            return $this->get( $article_id );
        }
        catch (NoPriceFoundException $e) {
            return array();
        }

    }

    /**
     * @param  mixed $article_id
     * @return boolean
     */
    public function has( $article_id )
    {
        $this->pdo_stmt->execute([
            'table' => static::$table,
            'id' => $article_id
        ]);
        return (bool) $this->pdo_stmt->fetchColumn();
    }


    /**
     * @param  mixed $article_id
     * @return array
     */
    public function get( $article_id )
    {
        $this->pdo_stmt->execute([
            'id' => $article_id
        ]);

        if ($prices = $this->pdo_stmt->fetchAll( \PDO::FETCH_OBJ )) {
            return $prices;
        }
        throw new NoPriceFoundException;
    }
}

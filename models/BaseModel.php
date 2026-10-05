<?php

/**
 * Classe de base pour tous les modèles
 * Centralise la logique PDO pour éviter la duplication de code
 */
class BaseModel
{
    /**
     * Exécute une requête préparée et retourne un seul résultat
     * 
     * @param string $query Requête SQL
     * @param array $params Tableau associatif des paramètres [':param_name' => $value]
     * @return array|false Un seule ligne ou false si aucun résultat
     */
    protected function executeQuery($query, $params = [])
    {
        $statement = Database::getConnection()->prepare($query);
        $statement->execute($params);
        return $statement->fetch();
    }

    /**
     * Exécute une requête préparée et retourne tous les résultats sous forme de tableau
     * 
     * @param string $query Requête SQL
     * @param array $params Tableau associatif des paramètres [':param_name' => $value]
     * @return array Tableau indexé contenant des tableaux associatifs
     */
    public function executeQueryAll($query, $params = [])
    {
        $statement = Database::getConnection()->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll();
    }

    /**
     * Exécute une requête d'insertion, mise à jour ou suppression
     * Retourne true si succès, false sinon
     * 
     * @param string $query Requête SQL
     * @param array $params Tableau associatif des paramètres [':param_name' => $value]
     * @return bool Succès ou non
     */
    protected function executeModify($query, $params = [])
    {
        $statement = Database::getConnection()->prepare($query);
        return $statement->execute($params);
    }
}
